const mqtt = require('mqtt');
const db = require('./db'); // Assuming db.js contains your MySQL connection

const brokerHost = '91.121.93.94'; // MQTT broker host
const brokerPort = 1883; // MQTT broker port

const client = mqtt.connect(`mqtt://${brokerHost}:${brokerPort}`);

client.on('connect', () => {
    console.log('Connected to MQTT broker');
    client.subscribe('aswar', (err) => {
        if (!err) {
            console.log('Subscribed to topic "aswar"');
        }
    });
});

function extractValueFromMessage(messageString, key) {
    // Assuming messageString is in the format "{key1: value1, key2: value2, ...}"
    const keyIndex = messageString.indexOf(key);
    if (keyIndex === -1) {
        return undefined; // Key not found
    }

    // Find the start and end of the value for the key
    let startIndex = messageString.indexOf(':', keyIndex) + 1;
    let endIndex = messageString.indexOf(',', startIndex);
    if (endIndex === -1) {
        endIndex = messageString.indexOf('}', startIndex);
    }

    // Extract the substring containing the value
    let valueString = messageString.substring(startIndex, endIndex).trim();

    // Remove surrounding quotes if present
    if (valueString.startsWith('"') && valueString.endsWith('"')) {
        valueString = valueString.substring(1, valueString.length - 1);
    }

    // Return the parsed value
    return parseFloat(valueString); // Assuming numeric values like tempC and sensor_value
}

function saveToDatabase(jsonString, now) {
    // Check if the message already exists in the database
    const selectQuery = `SELECT COUNT(*) AS count FROM save_logs WHERE message = ?`;
    const selectValues = [jsonString];

    db.query(selectQuery, selectValues, (selectError, selectResults, selectFields) => {
        if (selectError) {
            console.error('Error checking for existing message:', selectError);
            return;
        }

        const existingCount = selectResults[0].count;

        if (existingCount > 0) {
            console.log('Message already exists in the database. Skipping insertion.');
            return;
        }

        // If message doesn't exist, proceed with insertion
        const insertQuery = `INSERT INTO save_logs (message, created_at)
                             VALUES (?, ?)`;
        const insertValues = [jsonString, now];

        db.query(insertQuery, insertValues, (insertError, insertResults, insertFields) => {
            if (insertError) {
                console.error('Error inserting into MySQL:', insertError);
            } else {
                console.log('Data saved to MySQL');
            }

            // Wait for 1 minute before attempting to save again
         
        });
    });
}

client.on('message', (topic, message) => {
    const data = message.toString();

    const tempC = extractValueFromMessage(data, 'tempC');
    const humi = extractValueFromMessage(data, 'humi');
    const dsm_consentrate = extractValueFromMessage(data, 'dsm_consentrate');
    const dsm_particle = extractValueFromMessage(data, 'dsm_particle');
    const sensor_value = extractValueFromMessage(data, 'sensor_value');

    // Check if all required fields are extracted
    if (tempC === undefined || humi === undefined || dsm_consentrate === undefined || dsm_particle === undefined || sensor_value === undefined) {
        console.log('Not all required fields extracted. Skipping database insertion.');
        return;
    }

    const messageJsonString = {
        tempC: tempC,
        humi: humi,
        dsm_consentrate: dsm_consentrate,
        dsm_particle: dsm_particle,
        air_quality_label: "Excellent", // Ensure "Excellent" is in double quotes
        sensor_value: sensor_value
    };

    const jsonString = JSON.stringify(messageJsonString);

    // Insert into MySQL database
    const now = new Date().toISOString().slice(0, 19).replace('T', ' '); // Get current timestamp
    setTimeout(() => {
        saveToDatabase(jsonString, now);
        console.log('Waiting for 1 minute before next save...');


    }, 60000); // 60000 milliseconds = 1 minute
});

client.on('error', (error) => {
    console.error('MQTT client error:', error);
});

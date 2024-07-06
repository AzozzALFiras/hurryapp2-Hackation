const mysql = require('mysql');

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'hurryapp2',
    password: 'x2sBYyLeSJ4rAneD',
    database: 'hurryapp2'
});

connection.connect((err) => {
    if (err) {
        console.error('Error connecting to MySQL: ' + err.stack);
        return;
    }
    console.log('Connected to MySQL as id ' + connection.threadId);
});

module.exports = connection;

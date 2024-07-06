<?php

// app/Providers/MqttServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use PhpMqtt\Client\Facades\Mqtt;

class MqttServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $client = Mqtt::connection();

        $client->subscribe('aswar', function ($topic, $message) {
            // Handle the incoming message
            // You can dispatch a job or event here to process the message
            echo $message;
        });

        // Start the MQTT client loop
        $client->loop(true);
    }
}

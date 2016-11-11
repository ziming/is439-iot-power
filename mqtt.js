var mqtt = require('mqtt');
var url = require('url');

// Parse
var mqtt_url = url.parse('mqtt://m13.cloudmqtt.com:10423');
var auth = (mqtt_url.auth || ':').split(':');
var url = "mqtt://" + mqtt_url.host;

var options = {
    port: mqtt_url.port,
    clientId: 'mqttjs_' + Math.random().toString(16).substr(2, 8),
    username: 'isjllfuu', // just a demo
    password: 'xluNw49O64v6' // just a demo
};

// mysql related
var mysql = require('mysql');
var pool = mysql.createPool({
    connectionLimit: 1, // The max number of connections to create at once. (Default: 10)
    host: '127.0.0.1',
    user: 'root', // just a demo
    password: 'root', // just a demo
    database: 'is439' // just a demo
});

// Create a client connection
var client = mqtt.connect(url, options);

client.on('connect', function () { // When connected

    // subscribe to a topic
    client.subscribe('sbs-power', function () {
        // when a message arrives, do something with it
        client.on('message', function (topic, message, packet) {

            message = message.toString().trim();

            if (message.length > 1) {
                message = message.split(',');
            } else {
                return;
            }


            pool.getConnection(function (err, connection) {

                if (err) throw err;

                // Use the connection

                // "2016-09-19 20:15:03"
                var timestamp = Number(message[2]) * 1000
                var datetime = new Date(timestamp).toISOString().slice(0, 19).replace('T', ' ');
                // console.log(datetime);
                // power_sensor_id,measurement_taken_datetime,amp_value
                var power_sensor_log = {
                    power_sensor_id: message[0],
                    amp_value: message[1],
                    measurement_taken_datetime: datetime,
                    created_at: datetime,
                    updated_at: datetime
                };

                connection.query('INSERT INTO power_sensor_logs SET ?', power_sensor_log, function (err, result) {
                    if (err) throw err;

                    // for testing only
                    // console.log(result.insertId);

                    connection.release();

                    // Don't use the connection here, it has been returned to the pool.
                });
            });
        });
    });

    // publish a message to a topic
    // client.publish('hello/world', 'my message', function() {
    //     console.log("Message is published");
    //     client.end(); // Close the connection when published
    // });

});


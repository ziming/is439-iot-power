var mqtt_config_file = 'mqtt-config.json';
var fs = require('fs');

var mqtt_config = JSON.parse(
    fs.readFileSync(mqtt_config_file)
);

var mysql = require('mysql');
var pool = mysql.createPool({
    connectionLimit: 2, // The max number of connections to create at once. (Default: 10)
    host: '127.0.0.1',
    user: mqtt_config.mysql_username,
    password: mqtt_config.mysql_password,
    database: mqtt_config.mysql_db_name
});

var mqtt_connect_config = {
    port: 10423,
    username: mqtt_config.mqtt_broker_username,
    password: mqtt_config.mqtt_broker_password,

    // these 2 are only needed if the broker is not MQTT 3.1.1 compliant.
    // I only include them to play safe.
    protocolId: 'MQIsdp',
    protocolVersion: 3
};

var mqtt = require('mqtt');
var client = mqtt.connect(mqtt_config.mqtt_broker_server, [mqtt_connect_config]);

// for debugging on error
client.on('error', function (err) {
    console.log(err);
});


client.on('connect', function () {
    client.subscribe('sbs-power')
});

client.on('message', function (topic, msg) {

    console.log('haha');
    // message is Buffer, so need to convert to string
    msg = msg.toString();

    if (msg.length > 1) {
        msg = msg.split(',');
    } else {
        return;
    }


    pool.getConnection(function (err, connection) {

        if (err) throw err;

        // Use the connection

        // power_sensor_id,measurement_taken_datetime,amp_value
        var power_sensor_log = {
            power_sensor_id: msg[0],
            measurement_taken_datetime: msg[1],
            amp_value: msg[2]
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


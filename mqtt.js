var mqtt = require('mqtt');

var client  = mqtt.connect('mqtt://broker.hivemq.com',  [{ port: 1883 }]);

client.on('connect', function () {
    client.subscribe('sbs-power')
});

var mysql = require('mysql');

client.on('message', function (topic, message) {
    // message is Buffer
    console.log(message.toString())
    // client.end()

    /*
    for inserting to db here which i comment out
     var connection = mysql.createConnection({
     host     : 'localhost',
     user     : 'me',
     password : 'secret',
     database : 'my_db'
     });

     connection.connect();

     connection.query('SELECT 1 + 1 AS solution', function(err, rows, fields) {
     if (err) throw err;

     console.log('The solution is: ', rows[0].solution);
     });

     connection.end();
     */
});


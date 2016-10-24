var mqtt = require('mqtt')
var client  = mqtt.connect('mqtt://broker.hivemq.com',  [{ port: 1883 }])

client.on('connect', function () {
    client.subscribe('sbsp')
});

client.on('message', function (topic, message) {
    // message is Buffer
    console.log(message.toString())
    // client.end()
});
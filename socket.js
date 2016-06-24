var
    app = require('express')(),
    http = require('http').Server(app),
    io = require('socket.io')(http),
    Redis = require('ioredis'),
    redis = new Redis();

redis.subscribe('qso', function (err, count) { });

redis.on('message', function (channel, message) {
    console.log('Message Received: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

http.listen(3002, function(){
    console.log('Listening on Port 3002');
});

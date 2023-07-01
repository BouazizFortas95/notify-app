// how to create webSocketServer with nodejs ?
var webSocketServer = require('websocket').server;
var http = require('http');
var htmlEntity = require('html-entities');
var PORT = 3280;

// list of currently coonected clients
var clients = [];

// create http server
var server = http.createServer();

server.listen(PORT, function () {
    console.log("Server is lestening on PORT : " + PORT);
});

// create the websoket server
var wsServer = new webSocketServer({
    httpServer: server
});

/**
 * The websoker server
 */
wsServer.on("request", function (request) {
    var connection = request.accept(null, request.origin);

    // Pass each connection instance to each client
    var index = clients.push(connection) - 1;
    console.log('Client', index, "connected");

    /**
     * this where the send message to all the clients connected
     */
    connection.on("message", function (message) {
        var utf8Data = JSON.parse(message.utf8Data);

        if (message.type === 'utf8') {
            // Prepare the json data to be sent to all clients that are connected
            var obj = JSON.stringify({
                eventName: htmlEntity.decode(utf8Data.eventName),
                eventMessage: htmlEntity.decode(utf8Data.eventMessage),
            });

            // send them to all clients
            for (let i = 0; i < clients.length; i++) {
                clients[i].sendUTF(obj);
            }
        } else {

        }
    });

    /**
     * this where the client its connection to the websocket server
     */
    connection.on("close", function (connection) {
        clients.splice(index, 1);
        console.log('Client', index, "was disconnected");
     });
});















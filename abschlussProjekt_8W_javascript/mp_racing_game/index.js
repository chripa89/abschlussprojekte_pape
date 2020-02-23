'use strict';

// VARIABLEN
let players = {};

// Express
const express = require ( 'express' );
let expressServer = express();
expressServer.use ( express.static('public') );

// HTTP
const http = require ( 'http' );
let httpServer = http.Server( expressServer );

// Websocket
const socketIo = require ( 'socket.io' );
let io = socketIo ( httpServer );

// FUNKTIONEN
const zufallErzeugen = (min=0, max=1) => Math.floor ( Math.random() * (max - min + 1) + min );


const updateClient = () => {
    // Variable für eine vereinfachte Kopie des players-Objektes
    let playersToSend = {};
    for ( let player in players ){
        // Zur vereinfachung wird das Objekt in eine Variable p gemappt
        let p = players[player];

        playersToSend[p.socket.id] = {
            x: p.x,
            y: p.y,
            speed: p.speed,
            angle:p.angle
        }

    }
    io.emit ( 'updateClient', JSON.stringify ( playersToSend ) );
    socket.on('updateServer', richtung => {
        richtung = JSON.parse(richtung);
        players[socket.id].posX += richtung.x * players[socket.id].speed;
        players[socket.id].posY += richtung.y * players[socket.id].speed;
    })
    
}

// KLASSEN
class Player {
    constructor(socket){
        this.socket = socket;
        // id ist im socket-Objekt: this.socket.id 
        this.x = zufallErzeugen(0,500);
        this.y = zufallErzeugen(0,500);
        this.angle =0;
        this.speed = 0;

        }
       
}


// Socket Eventlistener
io.on ( 'connect', socket => {
    // console.log( 'Neuer Spieler: ', socket.id );

    players[socket.id] = new Player ( socket );
    
    let connectionsLimit = 3

    io.on('connection', function (socket) {
      
        if (io.engine.clientsCount > connectionsLimit) {
         
          socket.disconnect()
          
          return console.log("Du kommst hier nicht rein!");
          
        }
      
      })




    socket.on ( 'disconnect', () => {
        delete players[socket.id];
    })



})

// Clients regelmäßig aktualisieren
setInterval ( updateClient, 30 );


httpServer.listen ( 80, err => console.log ( err || 'Läuft bei mir.' ) );
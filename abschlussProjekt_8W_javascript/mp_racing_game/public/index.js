'use strict';
{

    // DOM-Elemente

    let canvas = document.getElementById("spielfeld");
    let context = canvas.getContext("2d");
    let car = document.querySelector('#auto');
    let socket = io.connect();
    let players;
  
    let mod = 1;

    /**/
    let richtung = {
        x:0,
        y:0
    }


    // FUNKTIONEN
   


    function draw() {
        context.clearRect(0, 0, canvas.width, canvas.height);
        for (let player in players) {
            player = players[player]
            player.x += richtung.x * Math.cos(Math.PI / 180 * player.angle);

            player.y +=richtung.y * Math.sin(Math.PI / 180 * player.angle);

            context.save();

            context.translate(player.x, player.y);

            context.rotate(Math.PI / 180 * player.angle);

            context.drawImage(car, -(car.width / 2), -(car.height / 2));

            context.restore();
            document.onkeydown = evt => {
                if ( evt.key == 'ArrowLeft' ) richtung.x = -1;
                if ( evt.key == 'ArrowRight' ) richtung.x = 1;
                if ( evt.key == 'ArrowUp' ) richtung.y = -1;
                if ( evt.key == 'ArrowDown' ) richtung.y = 1;   
            }
            
            document.onkeyup = evt => {
                if ( evt.key == 'ArrowLeft' ) richtung.x = 0;
                if ( evt.key == 'ArrowRight' ) richtung.x = 0;
                if ( evt.key == 'ArrowUp' ) richtung.y = 0;
                if ( evt.key == 'ArrowDown' ) richtung.y = 0;   
            }
        }


    }

    










    // Socket EVENTLISTENER


    socket.on('connect', () => {

        console.log(socket.id);

    })

    socket.on('updateClient', spieler => {
        players = JSON.parse(spieler);


        draw()
        
        
    })

    // Socket Emit
    setInterval(() => {

        socket.emit('updateServer', richtung => {
            richtung = JSON.parse(richtung);

        });
    }, 30);






}


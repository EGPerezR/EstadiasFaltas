var reproductor = document.getElementById('audioo');

var source = document.createElement('source');
var seleccion;

function cargarCancion(numero) {
    seleccion = numero;
    // Cargamos la canción de forma dinámica

    source.src = lista[numero][0];
    source.type = "audio/ogg";

    reproductor.appendChild(source);

    reproductor.load();
    reproductor.play();

    var texto = document.getElementById("texto");
    texto.innerHTML = lista[numero][1];

}

function previus() {
    if (seleccion == 0) {
        seleccion = lista.length - 1;
        reproductor.pause();
        reproductor.removeChild(source);
        cargarCancion(seleccion);
    } else {
        seleccion--;
        reproductor.pause();
        reproductor.removeChild(source);
        cargarCancion(seleccion);
    }
}

function selector() {
    if (seleccion >= lista.length - 1) {
        seleccion = 0;
        reproductor.pause();
        reproductor.removeChild(source);
        cargarCancion(seleccion);
    } else {
        seleccion++;
        reproductor.pause();
        reproductor.removeChild(source);
        cargarCancion(seleccion);
    }
}

function aleatorio() {
    return Math.round(Math.random() * (lista.length - 1));
}

var lista = [
    ['Cancion/R.E.M. - Losing My Religion - Subtitulada en español e inglés.mp3', 'R.E.M - Losing My Religion'],
    ['Cancion/a-ha - Take On Me (Official Video).mp3', 'a-ha - Take On Me'],
    ['Cancion/Berlin - Take My Breath Away.mp3', 'Berlin - Take My Breath Away'],
    ['Cancion/lionel richie-say you say me.mp3', 'Richie - Say you Say me'],
    ['Cancion/Kansas - Dust in the Wind (Official Video).mp3', 'Kansas - Dust in the Wind'],
    ['Cancion/Another one bites the dust  Queen  Letra en español  inglés.mp3', 'Queen - Another one bites the Dust'],
];


var listado = document.getElementById("listado");
for (x = 0; x < lista.length; x++) {
    var item = document.createElement("li");
    item.innerHTML = lista[x][1];
    listado.appendChild(item);
}

cargarCancion(aleatorio());

reproductor.addEventListener("ended", function() {
    if (seleccion >= lista.length - 1) {
        seleccion = 0;
        reproductor.pause();
        reproductor.removeChild(source);
        cargarCancion(seleccion);
    } else {
        seleccion++;
        reproductor.pause();
        reproductor.removeChild(source);
        cargarCancion(seleccion);
    }
});






setVolume = function() {
    reproductor.volume = document.getElementById('volume1').value;
}
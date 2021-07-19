function abilitagrado() {
    var combo = document.getElementById("espe");
    var selected = combo.options[combo.selectedIndex].text;
    if (selected == '...') {
        document.getElementById('gra').disabled = true;
        return false;
    } else {
        document.getElementById('gra').disabled = false;
    }
}

function abilitaseccion() {
    var combo = document.getElementById("gra");
    var selected = combo.options[combo.selectedIndex].text;
    if (selected == '...') {
        document.getElementById('se').disabled = true;
        return false;
    } else {
        document.getElementById('se').disabled = false;
    }
}




var x = 1;

function crearDin() {


    var padre = document.getElementById("mosdate");
    var fecha = document.createElement("INPUT");
    var label = document.createElement("label");
    fecha.type = 'date';
    fecha.name = 'fecha[]';
    fecha.id = 'fecha' + x;
    fecha.style.padding = "12px 15px";
    fecha.style.width = "90%";
    fecha.style.margin = "8px 0";
    fecha.style.border = "1px solid #ccc";
    fecha.style.borderRadius = "4px";
    fecha.style.boxSizing = "border-box"
    fecha.style.display = "inline-block"
    fecha.className = 'fechajus';
    label.innerHTML = "Justificante " + x;
    label.className = "fehcai";
    label.id = "label" + x;
    label.style.backgroundColor = "black";
    label.style.color = "white";

    label.style.fontSize = "20px"
    label.style.fontWeight = "bolder";
    padre.appendChild(label);
    padre.appendChild(fecha);

    x++;

}
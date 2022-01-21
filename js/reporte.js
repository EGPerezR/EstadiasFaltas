function enablegrado() {
    var combo = document.getElementById("especialidad");
    var selected = combo.options[combo.selectedIndex].text;
    if (selected == '...') {
        document.getElementById('grado').disabled = true;
        return false;
    } else {
        document.getElementById('grado').disabled = false;
    }
}

function enableseccion() {
    var combo = document.getElementById("grado");
    var selected = combo.options[combo.selectedIndex].text;
    if (selected == '...') {
        document.getElementById('seccion').disabled = true;
        return false;
    } else {
        document.getElementById('seccion').disabled = false;
    }
}
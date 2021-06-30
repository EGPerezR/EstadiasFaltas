function enablegradoa() {
    var combo = document.getElementById("especialidad");
    var selected = combo.options[combo.selectedIndex].text;
    if (selected == '...') {
        document.getElementById('grado').disabled = true;
        return false;
    } else {
        document.getElementById('grado').disabled = false;
    }
}

function enablesecciona() {
    var combo = document.getElementById("grado");
    var selected = combo.options[combo.selectedIndex].text;
    if (selected == '...') {
        document.getElementById('seccion').disabled = true;
        return false;
    } else {
        document.getElementById('seccion').disabled = false;
    }
}


function enablegradoc() {
    var combo = document.getElementById("especialidadc");
    var selected = combo.options[combo.selectedIndex].text;
    if (selected == '...') {
        document.getElementById('gradoc').disabled = true;
        return false;
    } else {
        document.getElementById('gradoc').disabled = false;
    }
}

function enableseccionc() {
    var combo = document.getElementById("gradoc");
    var selected = combo.options[combo.selectedIndex].text;
    if (selected == '...') {
        document.getElementById('seccionc').disabled = true;
        return false;
    } else {
        document.getElementById('seccionc').disabled = false;
    }
}
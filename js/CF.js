function faltgra() {
    var valor1 = document.getElementById('espe').value;
    var parametros = {
        "especialidad": valor1
    };

    $.ajax({
        type: "POST",
        url: "Controllers/especialidad.php",
        data: parametros,
        beforeSend: function() {
            $('#resultado').html("Procesando, Espere...");
        },
        success: function(response) {
            $('#resultado').html(response)
            document.getElementById('resultado').disabled = false

        }
    });
}



function faltsec() {
    var valor1 = document.getElementById('espe').value;
    var valor2 = document.getElementById('resultado').value;
    var parametros = {
        "especialidad": valor1,
        "grado": valor2
    };

    $.ajax({
        type: "POST",
        url: "Controllers/grado.php",
        data: parametros,
        success: function(response) {
            $('#result').html(response)
            document.getElementById('result').disabled = false

        }
    });
}

function faltmater() {
    var valor1 = document.getElementById('espe').value;
    var valor2 = document.getElementById('resultado').value;
    var parametros = {
        "especialidad": valor1,
        "grado": valor2
    };

    $.ajax({
        type: "POST",
        url: "Controllers/materia.php",
        data: parametros,
        success: function(response) {
            $('#mate').html(response)
            document.getElementById('mate').disabled = false

        }
    });
}

function resultadofinal() {
    var valor1 = document.getElementById('espe').value;
    var valor2 = document.getElementById('resultado').value;
    var valor3 = document.getElementById('result').value;
    var valor3 = document.getElementById('mate').value;
    var parametros = {
        "especialidad": valor1,
        "grado": valor2,
        "seccion": valor3,
        "materia": valor4
    };

    $.ajax({
        type: "POST",
        url: "Controllers/CF.php",
        data: parametros,
        success: function(response) {
            $('#faltt').html(response)


        }
    });
}
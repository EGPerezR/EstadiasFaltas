<?php

require 'conexion.php';

function guardausuario($usuario)
{
	global $usuarios;
	$usuarios = $usuario;
}

function regresaUsuario()
{
	global $usuarios;
	return $usuarios;
}

function isNullRegistro($matricula, $nombre, $usuario, $pass1, $pass2, $correo)
{
	if (strlen(trim($matricula)) < 1	|| strlen(trim($nombre)) < 1	|| strlen(trim($usuario)) < 1	|| strlen(trim($pass1)) < 1	|| strlen(trim($pass2)) < 1	|| strlen(trim($correo)) < 1) {
		return true;
	} else {
		return false;
	}
}



function isNullesp($especialidad)
{
	if (strlen(trim($especialidad)) < 1) {
		return true;
	} else {
		return false;
	}
}
function isNullgrad($grad)
{
	if (strlen(trim($grad)) < 1) {
		return true;
	} else {
		return false;
	}
}
function isNullsec($secc)
{
	if (strlen(trim($secc)) < 1) {
		return true;
	} else {
		return false;
	}
}
function isNullfe($fe)
{
	if (strlen(trim($fe)) < 1) {
		return true;
	} else {
		return false;
	}
}

function isNullfecha($fecha)
{
	if (strlen(trim($fecha)) < 1) {
		return true;
	} else {
		return false;
	}
}

function isEmail($email)
{
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return true;
	} else {
		return false;
	}
}

function validaPassword($var1, $var2)
{
	if (strcmp($var1, $var2) !== 0) {
		return false;
	} else {
		return true;
	}
}

function minMax($min, $max, $valor)
{
	if (strlen(trim($valor)) < $min) {
		return true;
	} else if (strlen(trim($valor)) > $max) {
		return true;
	} else {
		return false;
	}
}

function usuarioExiste($usuario)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT usuario FROM profesores WHERE usuario = ? LIMIT 1");
	$stmt->bind_param("s", $usuario);
	$stmt->execute();
	$stmt->store_result();
	$num = $stmt->num_rows;
	$stmt->close();

	if ($num > 0) {
		return true;
	} else {
		return false;
	}
}

function alumnoExiste($alumno)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT nombres FROM alumnos WHERE nombres = ? LIMIT 1");
	$stmt->bind_param("s", $alumno);
	$stmt->execute();
	$stmt->store_result();
	$num = $stmt->num_rows;
	$stmt->close();

	if ($num > 0) {
		return true;
	} else {
		return false;
	}
}

function matriculaExiste($matricula)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT matricula FROM profesores WHERE matricula = ? LIMIT 1");
	$stmt->bind_param("s", $matricula);
	$stmt->execute();
	$stmt->store_result();
	$num = $stmt->num_rows();
	$stmt->close();

	if ($num > 0) {
		return true;
	} else {
		return false;
	}
}

function emailExiste($email)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT matricula FROM profesores WHERE correo = ? LIMIT 1");
	$stmt->bind_param("s", $email);
	$stmt->execute();
	$stmt->store_result();
	$num = $stmt->num_rows;
	$stmt->close();

	if ($num > 0) {
		return true;
	} else {
		return false;
	}
}

function generateToken()
{
	$gen = md5(uniqid(mt_rand(), false));
	return $gen;
}

function hashPassword($password)
{
	$hash = password_hash($password, PASSWORD_DEFAULT);
	return $hash;
}

function encriptar($string)
{
	$output = false;
	$key = hash('sha256', '$emma@2021sv');
	$iv = substr(hash('sha256', '101712'), 0, 16);
	$output = openssl_encrypt($string, 'AES-256-CBC', $key, 0, $iv);
	$output = base64_encode($output);
	return $output;
}

function desencriptar($string)
{
	$key = hash('sha256', '$emma@2021sv');
	$iv = substr(hash('sha256', '101712'), 0, 16);
	$output = openssl_decrypt(base64_decode($string), 'AES-256-CBC', $key, 0, $iv);
	return $output;
}

function resultBlock($errors)
{
	if (count($errors) > 0) {
		echo "<div id='error' class='alert alert-danger' role='alert'>
			
			<ul>";
		foreach ($errors as $error) {
			echo "<li>" . $error . "</li>";
		}
		echo "</ul>";
		echo "</div>";
	}
}

function resultBlock2($mensajes)
{
	if (count($mensajes) > 0) {
		echo "<div class='alert alert-info' role='alert'>
			
			<ul>";
		foreach ($mensajes as $mensaje) {
			echo "<li>" . $mensaje . "</li>";
		}
		echo "</ul>";
		echo "</div>";
	}
}

function registraMaestro($matricula, $nombre, $usuario, $pass_hash, $email,  $token, $tipo_usuario)
{

	global $mysqli;

	$stmt = $mysqli->prepare("INSERT INTO profesores (matricula, nombre, usuario, contrasena, correo, token, tipo_usuario) VALUES(?,?,?,?,?,?,?)");
	$stmt->bind_param('ssssssi', $matricula, $nombre, $usuario, $pass_hash, $email,  $token, $tipo_usuario);

	if ($stmt->execute()) {
		return $mysqli->insert_id;
	} else {
		return 0;
	}
}



function validaIdToken($id, $token)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT activacion FROM profesores WHERE matricula = ? AND token = ? LIMIT 1");
	$stmt->bind_param("is", $id, $token);
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;

	if ($rows > 0) {
		$stmt->bind_result($activacion);
		$stmt->fetch();

		if ($activacion == 1) {
			$msg = "La cuenta ya se activo anteriormente.";
		} else {
			if (activarUsuario($id)) {
				$msg = 'Cuenta activada.';
			} else {
				$msg = 'Error al Activar Cuenta';
			}
		}
	} else {
		$msg = 'No existe el registro para activar.';
	}
	return $msg;
}

function activarUsuario($id)
{
	global $mysqli;

	$stmt = $mysqli->prepare("UPDATE profesores SET activacion=1 WHERE matricula = ?");
	$stmt->bind_param('s', $id);
	$result = $stmt->execute();
	$stmt->close();
	return $result;
}

function isNullLogin($usuario, $password)
{
	if (strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1) {
		return true;
	} else {
		return false;
	}
}


function login($matricula, $password)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT matricula, usuario, contrasena FROM profesores WHERE usuario = ? || matricula = ?  LIMIT 1");
	$stmt->bind_param('ss', $matricula, $matricula);
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;

	if ($rows > 0) {

		$stmt->bind_result($matri, $usu, $passwd);
		$stmt->fetch();

		

		if (123 == $passwd) {


			$_SESSION['matricula'] = $matri;
			$_SESSION['usuairo'] = $usu;

			header("location: welcome.php");
		} else {

			echo "<div class='fondo' id='fondo'><div class='log' id='log'><a onclick='login()'>X</a><br>La contrase&ntilde;a es incorrecta</div></div>";
		}
	} else {
		echo "<div class='fondo' id='fondo'><div class='log' id='log'><a onclick='login()'>X</a><br>El nombre de usuario o matricula no existe</div></div>";
	}
	
}

function lastSession($id)
{
	global $mysqli;

	$stmt = $mysqli->prepare("UPDATE profesores SET last_session=NOW(), token_password='', password_request=0 WHERE matricula = ?");
	$stmt->bind_param('s', $id);
	$stmt->execute();
	$stmt->close();
}

function isActivo($usuario)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT activacion FROM profesores WHERE usuario = ? || correo = ? LIMIT 1");
	$stmt->bind_param('ss', $usuario, $usuario);
	$stmt->execute();
	$stmt->bind_result($activacion);
	$stmt->fetch();

	if ($activacion == 1) {
		return true;
	} else {
		return false;
	}
}

function generaTokenPass($user_id)
{
	global $mysqli;

	$token = generateToken();

	$stmt = $mysqli->prepare("UPDATE profesores SET token_password=?, password_request=1 WHERE matricula = ?");
	$stmt->bind_param('ss', $token, $user_id);
	$stmt->execute();
	$stmt->close();

	return $token;
}

function getValor($campo, $campoWhere, $valor)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT $campo FROM profesores WHERE $campoWhere = ? LIMIT 1");
	$stmt->bind_param('s', $valor);
	$stmt->execute();
	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num > 0) {
		$stmt->bind_result($_campo);
		$stmt->fetch();
		return $_campo;
	} else {
		return null;
	}
}

function getPasswordRequest($id)
{
	global $mysqli;

	$stmt = $mysqli->prepare("SELECT password_request FROM profesores WHERE matricula = ?");
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$stmt->bind_result($_id);
	$stmt->fetch();

	if ($_id == 1) {
		return true;
	} else {
		return null;
	}
}

function verificaTokenPass($user_id, $token)
{

	global $mysqli;

	$stmt = $mysqli->prepare("SELECT activacion FROM profesores WHERE matricula = ? AND token_password = ? AND password_request = 1 LIMIT 1");
	$stmt->bind_param('is', $user_id, $token);
	$stmt->execute();
	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num > 0) {
		$stmt->bind_result($activacion);
		$stmt->fetch();
		if ($activacion == 1) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function cambiaPassword($password, $user_id, $token)
{

	global $mysqli;

	$stmt = $mysqli->prepare("UPDATE profesores SET password = ?, token_password='', password_request=0 WHERE matricula = ? AND token_password = ?");
	$stmt->bind_param('sis', $password, $user_id, $token);

	if ($stmt->execute()) {
		return true;
	} else {
		return false;
	}
}

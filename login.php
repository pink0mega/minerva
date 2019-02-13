<?php

session_start();  //inicia la sesión del navegador en el servidor PHP
//o la continúa si ya estuviera iniciada

include ('misFunciones.php');

function limpiaPalabra($palabra) {
    //filtro muy básico para evitar la inyeccion SQL
    $palabra = trim($palabra, "'");
    $palabra = trim($palabra, " ");
    $palabra = trim($palabra, "-");
    $palabra = trim($palabra, "`");
    $palabra = trim($palabra, '"');
    return $palabra;
}

$mysqli = conectaBBDD();

$cajaNombre = limpiaPalabra($_POST['cajaNombre']);

$cajaPassword = limpiaPalabra($_POST['cajaPassword']);

echo 'Has escrito el usuario: ' . $cajaNombre . ' y la contraseña: ' . $cajaPassword;
$elHash = '$2y$10$4t5es.iMgHYtm1UZqNriv.ojqO9YtRcQL7uxkigviW8F2hElaOzKq';

echo password_hash($cajaPassword, PASSWORD_BCRYPT);

if (password_verify($cajaPassword, $elHash)) {
    echo "Contraseña correcta";
} else {
    echo "Contraseña es inválida";
}

$resultadoQuery = $mysqli->query("SELECT * FROM usuarios ");


$numUsuarios = $resultadoQuery->num_rows;

if ($numUsuarios > 0) {
    $r = $resultadoQuery->fetch_array();
    //en la variable de sesión "nombreUsuario" guardo el nombre de usuario
    $_SESSION['nombre_usuario'] = $cajaNombre;

    //en la variable de sesión idUsuario guardo el id de usuario leido de la BBDD
    $_SESSION['id_usuario'] = $r['id_usuario'];

    //muestro la pantalla de la aplicación
    require 'ventanaPrincipal.php';
} else {
    //muestro una pantalla de error
    require 'error.php';
}
 
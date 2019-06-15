<?php
$usuario = $_POST['user'];
$pass = $_POST['pass'];
$rol = $_POST['rol'];
$nombre = $_POST['nom'];
$apeP = $_POST['apeP'];
$apeM = $_POST['apeM'];
$iduser = $_POST['iduser'];

session_start();
$_SESSION['usuario'] = $usuario;
$_SESSION['pass'] = $pass;
$_SESSION['rol'] = $rol;
$_SESSION['nombre'] = $nombre;
$_SESSION['apeP'] = $apeP;
$_SESSION['apeM'] = $apeM;
$_SESSION['iduser'] = $iduser;
?>

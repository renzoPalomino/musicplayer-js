<?php
 const host_db = "localhost";
 const user_db = "root";
 const pass_db = "";
 const db_name = "db_renzmer";
 
 /*const host_db = "sql311.eshost.com.ar";
 const user_db = "eshos_28161459";
 const pass_db = "Canelita";
 const db_name = "eshos_28161459_db_renzmer";*/
 
 //Controlador de conexión de base de datos
const SGBD="mysql:host=".host_db.";dbname=".db_name;
const METHOD="AES-256-CBC";
const SECRET_KEY='$BP@2017';
CONST SECRET_IV='101712';

 $conexion = new mysqli(host_db, user_db, pass_db, db_name);

 if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}
?>
<?php
// Definições de host, database, usuário e senha
$host = "localhost:3355";
$db =  "pi3";
$user = "root";
$pass = "";
// Conecta ao banco de dados
try {
    $con = mysqli_connect($host, $user, $pass)
        or trigger_error(
            mysqli_error(),
            E_USER_ERROR
        );
} catch (TypeError $e) {
    echo 'Error: ', $e->getMessage();
}

// Seleciona a base de dados em que vamos trabalhar
mysqli_select_db($con, $db);
// Checagem da conexão
if (!$con) {
    die("Conexão falhou: " .
        mysqli_connect_error());
}
//echo "<H1><font color=green>Conectado com sucesso!</font></H1>";
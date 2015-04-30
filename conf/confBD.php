<?php

function conn_mysql() {

    $servidor = 'us-cdbr-azure-west-b.cleardb.com';

    $porta = 3306;

    $banco = "daw_yearbook";

    $usuario = "b270e675edf94d";

    $senha = "e8a1bff1";


    $conn = new PDO("mysql:host=$servidor;
	                   
	port=$porta;
					   
	dbname=$banco", $usuario, $senha, array(PDO::ATTR_PERSISTENT => true));

    return $conn;
}

?>


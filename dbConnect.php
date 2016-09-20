<?php
function db_connect()
{
	$servername = 'localhost';
	$dbname = 'vagrant';
	$username = 'root';
	$password = 'root';
	try 
	{
    	$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	} 
	catch (PDOException $e) 
	{
    	echo 'No connection: ' . $e->getMessage();
	}
	return $pdo;
}
?>
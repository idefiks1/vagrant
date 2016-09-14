
<?php
include ('header.php');


ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1); 
	
function db_connect()
{
	
	$servername = 'localhost';
	$dbname = 'vagrant';
	$username = 'root';
	$password = 'root';

	try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	} 
	catch (PDOException $e) {
    echo 'No connection: ' . $e->getMessage();
	}

	return $pdo;
}


function get_data()
{
	$pdo = db_connect();
	$stmt = $pdo->prepare("SELECT * FROM comments ");//join users
    $stmt->execute();
    $rowsArray = $stmt->fetchAll();
	return $rowsArray;
	
}

?>

<?php


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

$pdo = db_connect();

$stmt = $pdo->prepare("SELECT name FROM users WHERE name = ?");
$stmt->bindParam(1, $_POST['InputLogin1'], PDO::PARAM_STR, 20);
$stmt->execute();
$numRows = $stmt->fetchColumn(); 
if (!empty($numRows))
{
	
	echo json_encode(array('success'=>false));
	//echo json_encode('false');
}
else
{
	//echo json_encode('true');
	echo json_encode(array('success'=>true));
}

/*$pdo1 = db_connect();
$stmt = $pdo1->prepare("SELECT email FROM users WHERE email = ?");
$stmt->bindParam(1, $_POST['InputEmail'], PDO::PARAM_STR, 20);
$stmt->execute();
$numRows1 = $stmt->fetchColumn(); 
if (!empty($numRows1))
{
	
	echo json_encode(array('success1'=>false));
	//echo json_encode('false');
}
else
{
	//echo json_encode('true');
	echo json_encode(array('success1'=>true));
}*/

?>
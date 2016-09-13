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
$json = array();
$stmt = $pdo->prepare("SELECT name FROM users WHERE name = ?");
$stmt->bindParam(1, $_POST['InputLogin1'], PDO::PARAM_STR, 20);
$stmt->execute();
$numRows = $stmt->fetchColumn(); 
if (!empty($numRows))
{
	$json['success'] = false;
	//echo json_encode(array('success'=>false));

	
}
else
{
	$json['success'] = true;	
	//echo json_encode(array('success'=>true));
}


$stmt1 = $pdo->prepare("SELECT email FROM users WHERE email = ?");
$stmt1->bindParam(1, $_POST['InputEmail'], PDO::PARAM_STR, 20);
$stmt1->execute();
$numRows1 = $stmt1->fetchColumn(); 
if (!empty($numRows1))
{
	$json['success1'] = false;
	
}
else
{
	$json['success1'] = true;
	
}
echo json_encode($json);
?>
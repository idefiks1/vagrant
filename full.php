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
//$str = $_GET['InputLogin1'];
//var_dump($_POST);
//die();
$a = "admin";
		$stmt = $pdo->prepare("SELECT comment FROM comments WHERE name = ?");
		$stmt->bindParam(1, $a, PDO::PARAM_STR, 20);
		
		$stmt->execute();
		$numRows = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!empty($numRows))
		{
			$json = $numRows;
			//echo json_encode(array('success'=>false));
		}
		echo json_encode($json);
?>
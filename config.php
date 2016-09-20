<?php
include ('header.php');
include ('dbConnect.php');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1); 
	

function get_data()
{
	$pdo = db_connect();
	$stmt = $pdo->prepare("select users.name, id, comment, date from comments INNER JOIN users on comments.id_user=users.id_user");//join users
    $stmt->execute();
    $rowsArray = $stmt->fetchAll();
	return $rowsArray;
}
?>
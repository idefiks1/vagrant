<?php
include ('dbConnect.php');
$pdo = db_connect();
$json = array();
if (!empty($_POST['InputLogin1']))
{
	$stmt = $pdo->prepare("SELECT name FROM users WHERE name = ?");
	$stmt->bindParam(1, $_POST['InputLogin1'], PDO::PARAM_STR);		
	$stmt->execute();
	$numRows = $stmt->fetchColumn();
	if (!empty($numRows))
	{
		$json['success'] = false;
	}
	else
	{
		$json['success'] = true;	
	}
}
else 
{
	$json['success'] = false;	
}
if (empty($_POST['InputEmail']))
{
	$json['success1'] = false;
}
else
{
	$json['success2'] = true;
	$email = $_POST['InputEmail'];
	if (!preg_match("/[a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", $email)) 
	{
		$json['success2'] = false;
    }
    else
    {
    	$json['success2'] = true;
    	$stmt1 = $pdo->prepare("SELECT email FROM users WHERE email = ?");
		$stmt1->bindParam(1, $_POST['InputEmail'], PDO::PARAM_STR, 20);
		$stmt1->execute();
		$numRows1 = $stmt1->fetchColumn(); 
		if (!empty($numRows1))
		{
			$json['success2'] = false;
			$json['success1'] = false;	
		}
    }   
}
echo json_encode($json);
?>
<?php
include ('config.php');

$email = $_GET['email'];
$hash = $_GET['hash'];
//var_dump($email, $hash);
//die();

if (!empty($_GET['email']) && !empty($_GET['hash']))
{
	$pdo = db_connect();
	$stmt = $pdo->prepare("SELECT email, hash, active FROM users WHERE email = ? AND hash = ?");
	$stmt->bindParam(1, $email, PDO::PARAM_INT);
	$stmt->bindParam(2, $hash, PDO::PARAM_INT);
	$stmt->execute();
	$emailArray = $stmt->fetch(PDO::FETCH_ASSOC);
    $Email = $emailArray['email'];
	$Hash = $emailArray['hash'];
	$Active = $emailArray['active'];
	//var_dump($Email, $Hash, $Active);
	//die();
	
	if ( (!empty($Email)) && (!empty($Hash)) &&  ($Active == '0'))
	{
		$stmt = $pdo->prepare("UPDATE users SET active = '1' WHERE email = ? AND hash = ?");
		$stmt->bindParam(1, $Email, PDO::PARAM_INT);
		$stmt->bindParam(2, $Hash, PDO::PARAM_INT);
		$stmt->execute();
		echo "You account was activate. Thank you for activation."; ?> <a href = login.php >Login</a> 

		<?php
	}
}

?>
<?php include ('footer.php'); ?>
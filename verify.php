<?php
include ('config.php');
if( empty($_GET['email']) or empty($_GET['hash']) )
{
	
	echo "Error! Maybe you verification is done. Please ";?>
	<a href = login.php >Login!</a>
	<?php echo "<br> Or input data are wrong!. Please, register!";?>
	<a href = reg.php >Register</a>
	<?php
	die();
}
else
{
	$email = $_GET['email'];
	$hash = $_GET['hash'];
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
		if ( (!empty($Email)) && (!empty($Hash)) &&  ($Active == '0'))
		{
			$stmt = $pdo->prepare("UPDATE users SET active = '1' WHERE email = ? AND hash = ?");
			$stmt->bindParam(1, $Email, PDO::PARAM_INT);
			$stmt->bindParam(2, $Hash, PDO::PARAM_INT);
			$stmt->execute();
			echo "You account was activate. Thank you for activation."; ?> <a href = login.php >Login</a>
			<?php
		}
		else
		{
			echo "Link is not active! You activate is done. PLease "; ?> <a href = login.php >Login</a>
			<?php
		}
	}	
}
?>
<?php include ('footer.php'); ?>
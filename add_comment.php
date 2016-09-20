<?php
include ('config.php');
include ('functions.php');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1); 
if(!empty($_POST['text_comment']))
{
    $pdo = db_connect();
  	$name = $_SESSION["session_username"];
  	$idUser = 0;
  	$stmt = $pdo->prepare("SELECT id_user from users where name = ?");
  	$stmt->bindParam(1, $name, PDO::PARAM_STR, 12);
  	$stmt->execute();
        while($idArray= $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $idUser=$idArray['id_user'];
        }
    $comment = $_POST['text_comment'];
	$date = date("Y-m-d H:i:s");
	add_data($comment, $idUser, $date);
	$url="index.php";
	header('Location: '.$url);
}
?>
<div class="container">
    <div class="bs-example" data-example-id="simple-ul">
        <form name="comment" action="add_comment.php" method="post">
            <label for="comment">Comment:</label>
            <textarea class="form-control" name="text_comment" rows="5" id="comment" placeholder="Comment"></textarea>
            <br>
            <button type="submit" class="btn btn-primary">Add comment</button>
        </form>
        <br>
    </div>
</div>
<?php include ('footer.php'); ?>
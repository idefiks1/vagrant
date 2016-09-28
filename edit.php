<?php
include ('config.php');
if(!isset($_SESSION["session_username"]))
{
    $url="index.php";
    header('Location: '.$url);
}
	$pdo = db_connect();
	$Comment = 0;
	$stmt = $pdo->prepare("SELECT comment, id FROM comments where id = ?");
	$stmt->bindParam(1, $_GET['id'], PDO::PARAM_INT, 12);
	$stmt->execute();
	$CommentArray = $stmt->fetch(PDO::FETCH_ASSOC);
    $Comment = $CommentArray['comment'];
    $idComment = $CommentArray['id'];
	if(!empty($_POST['text_comment']))
	{
		if (isset($_POST["Save"])) 
		{	
			
	        $pdo = db_connect();
	        $stmt = $pdo->prepare("UPDATE comments SET comment = ? WHERE id = ?");
	        $stmt->bindParam(1, $_POST['text_comment'], PDO::PARAM_STR, 100);
	        $stmt->bindParam(2, $idComment, PDO::PARAM_INT, 4);
	        $stmt->execute();
	        $url="index.php";
			header('Location: '.$url);
		}   
	}
?>
<div class="container">
	<div class="bs-example" data-example-id="simple-ul">
		<form name="comment"  method="post">
  			<br>
  			<p>
                <label for="comment">Edit and click Save.</label>
                <br>
                <label for="comment">Comment:</label>
                <textarea class="form-control" name="text_comment" rows="5" id="comment"><?php echo $Comment;?></textarea>
    
  			</p>
  			<p>
        		<button type="submit" name="Save" class="btn btn-primary" action="edit.php" method="post">Save</button>
  			</p>
		</form>
	</div>
</div>
<?php include ('footer.php'); ?>
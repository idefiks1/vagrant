<?php
function strCut($string,$from,$to)
{
    $strnew = "";
    $arrStr = explode(" ", $string);
    $len = 0;
    for ($i=0;$i<count($arrStr);$i++)
    { 
        $len = $len + strlen($arrStr[$i]);
        $strnew = $strnew." ".$arrStr[$i]." ";
		if (($len>=$from) && ($len<=$to))
        {
        	$strnew = $strnew."...";
            echo $strnew;
            break;
        } 
    }
}
function add_data($comment, $idUser, $date)
{
	$pdo = db_connect();
	$stmt = $pdo->prepare("INSERT INTO comments (comment, id_user, date) VALUES (?,?,?)");
    $stmt->bindParam(1, $comment, PDO::PARAM_STR);
    $stmt->bindParam(2, $idUser, PDO::PARAM_STR);
    $stmt->bindParam(3, $date, PDO::PARAM_STR);
    
    $result = $stmt->execute();
}
?>
<?php

include ('config.php');

if(isset($_POST["login"]))
{
 
    if(isset($_SESSION["session_username"]))
    {
        header("Location: index.php");
    }

    if(!empty($_POST['InputName']) && !empty($_POST['InputPassword'])) 
    {
        $username=$_POST['InputName'];
        $password=md5('vagrant'+ $_POST['InputPassword']);
        $conn = db_connect();
        $stmt = $conn->prepare("SELECT name, pwd  FROM users where name = ? AND pwd = ?");
        $stmt->bindParam(1, $username, PDO::PARAM_STR, 12);
        $stmt->bindParam(2, $password, PDO::PARAM_STR, 20);
        $stmt->execute();
        $name_pwd = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $num_rows = count($name_pwd);
        if($num_rows!=0)
        {
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
              $dbusername=$row['name'];
              $dbpassword=$row['pwd'];
            }
            if($username == $dbusername && $password == $dbpassword)
            {
                $_SESSION['session_username']=$username;  
                header("Location: index.php");
            }
        } 
        else 
        {
            echo  "Invalid username or password!";
        }
    } 
}       
      
?>

<div class="container">
    <div class="bs-example" data-example-id="simple-ul">
        <form action="login.php" method="post">
            <label style= "text-align:center;">Please, login</label></p>
                <label>
                    <p>Name</p>
                </label>
                    <p><input type="text" name="InputName" class="form-control" id="InputName" placeholder="Name"></p>
                <label>
                    <p>Password</p>
                </label>
                    <p><input type="password" name="InputPassword" class="form-control" id="InputPassword" placeholder="Password"></p>
                    <p><button type="submit" name="login" class="btn btn-primary">Login</button></p>
        </form>
    </div>
</div>

<?php include ('footer.php');?>
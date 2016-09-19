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
        $password=md5($_POST['InputPassword']."vagrant");
        $conn = db_connect();
        $active = 1;
        $stmt = $conn->prepare("SELECT name, pwd, active  FROM users where name = ? AND pwd = ? AND active = ?");
        $stmt->bindParam(1, $username, PDO::PARAM_STR);
        $stmt->bindParam(2, $password, PDO::PARAM_STR);
        $stmt->bindParam(3, $active, PDO::PARAM_INT, 1);
        $stmt->execute();
        $name_pwd = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $num_rows = count($name_pwd);
        $activeStatus = 0;
        if($num_rows!=0)
        {
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
              $dbusername=$row['name'];
              $dbpassword=$row['pwd'];
              $activeStatus=$row['active'];
            }
             
            if($username == $dbusername && $password == $dbpassword && $activeStatus == 1)
            {
                $_SESSION['session_username']=$username;  
                header("Location: index.php");
            }


        }
        if ($activeStatus == 0)
            {
                ?><div style= "text-align:center;"><label><?="Please activate your accout! Check email!";?></label></div>
            <?php } 
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
            <div style= "text-align:center;">
                <label>Please, login</label></p>
            </div>
                <label>
                    <p>Login</p>
                </label>
                    <p><input type="text" name="InputName" class="form-control" id="InputName" placeholder="Login"></p>
                <label>
                    <p>Password</p>
                </label>
                    <p><input type="password" name="InputPassword" class="form-control" id="InputPassword" placeholder="Password"></p>
                    <p><button type="submit" name="login" class="btn btn-primary">Login</button></p>
        </form>
    </div>
</div>
<?php include ('footer.php');?>
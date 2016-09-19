<?php
include ('config.php');
include 'PHPMailer-master/PHPMailerAutoload.php';
?>
<?php
if(isset($_POST["register"]))
{
    if(!empty($_POST['InputLogin1']) && !empty($_POST['InputPassword1']) && !empty($_POST['InputEmail'])) 
    {
        $username=$_POST['InputLogin1'];
        $password=md5($_POST['InputPassword1']."vagrant");
        $email = $_POST['InputEmail'];
        $hash = md5(rand(0,1000));
        $conn = db_connect();
        $stmt = $conn->prepare("SELECT name, pwd  FROM users where name = ?");
        $stmt->bindParam(1, $username, PDO::PARAM_STR, 20);
        $stmt->execute();
        $namePwd = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $numRows = count($namePwd);
        if($numRows==0)
        {

            $mail = new PHPMailer;
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'idefiks1@gmail.com';                 // SMTP username
            $mail->Password = 'nrkrM9DvX7737483I';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom('dev@vagrant.dev', 'Mailer');
            $mail->addAddress($email, $username);

            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Signup | Verification';
            $mail->Body    = '
             
            Thanks for signing up!
            Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
            <br> 
            <br>------------------------
            <br>Username: '.$username.'
            <br>Password: '.$_POST['InputPassword1'].'
            <br>------------------------
            <br>Please click this link to activate your account:
            <br><a href="http://vagrant.dev/verify.php?email='.$email.'&hash='.$hash.'">http://vagrant.dev/verify.php?email='
            .$email.'&hash='.$hash.'</a>'.'';?>
            <?php $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if(!$mail->send()) 
            {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else 
            {
                echo 'Message has been sent';
            }
         
            $stmt1 = $conn->prepare("INSERT INTO users (name, pwd, email, hash) VALUES (?,?,?,?)");
            $stmt1->bindParam(1, $username, PDO::PARAM_STR, 20);
            $stmt1->bindParam(2, $password, PDO::PARAM_STR, 100);
            $stmt1->bindParam(3, $email, PDO::PARAM_STR, 30);
            $stmt1->bindParam(4, $hash, PDO::PARAM_STR, 32);
            $stmt1->execute();
            header("Location: login.php");  
        }
        else 
        {          
            echo "This login is already in use";
        }
    }
}
?>


<script>
$(document).ready(function() 
{
    function isValidPassword(passw)
    {
        var pattern = new RegExp(/[A-Za-z0-9]{6,}/);
        return pattern.test(passw);
    }
    function isValidLogin(login) 
    {
        var pattern = new RegExp(/[A-Za-z0-9]{2,}/);
        return pattern.test(login);
    }

       
    
    $( "#InputLogin1" ).blur(function(e) 
    {
        e.preventDefault();
        $.ajax(
        {
            type: 'POST',
            url: 'check.php',
            dataType: 'json',
            data: {InputLogin1: $('#InputLogin1').val()},
            success: function(data)
            {
                if (data.success == true)
                {
                    $("#sub_reg").prop("disabled", "false"); 
                    var Ulogin = $('#InputLogin1').val();
                    if(Ulogin != 0)
                    {   
                        if (isValidLogin(Ulogin))
                        {
                            $("#InputLogin1").closest('.form-group').removeClass('has-error').addClass('has-success');
                            $("#helpBlock1").html("Success!");
                        }
                        else
                        {
                            $("#InputLogin1").closest('.form-group').removeClass('has-success').addClass('has-error');
                            $("#helpBlock1").html("Login is invalid!");
                        } 
                    } 
                    else 
                    {      
                        $("#InputLogin1").closest('.form-group').removeClass('has-success').addClass('has-error');
                        $("#helpBlock1").html("Login empty!");
                    }
                }
                if (data.success == false)
                {
                    $("#sub_reg").prop("disabled", "true");
                    $("#InputLogin1").closest('.form-group').removeClass('has-success').addClass('has-error');
                    $("#helpBlock1").html("This login already use or empty!");
                    
                }
            }
        });
    });
    ///Check email in db
    $( "#InputEmail" ).blur(function(e) 
    {
        e.preventDefault();
        $.ajax(
        {
            type: 'POST',
            url: 'check.php',
            dataType: 'json',
            data: {InputEmail: $('#InputEmail').val()},
            success: function(data)
            {
                 if (data.success1 == false)
                {
                    $("#sub_reg").prop("disabled", "true");
                    $("#InputEmail").closest('.form-group').removeClass('has-success').addClass('has-error');
                    //$("#helpBlock2").html("This email already use or empty!");
                    
                }
                if (data.success1 == true)
                {
                    $("#sub_reg").prop("disabled", "false");
                    $("#InputEmail").closest('.form-group').removeClass('has-error').addClass('has-success');
                    //$("#helpBlock2").html("Success!");   
                }
            }
        });
    }); 
    ///Check email in db
    ///Check email for pattern
    $( "#InputEmail" ).blur(function(c) 
    {
        c.preventDefault();
        $.ajax(
        {
            type: 'POST',
            url: 'check.php',
            dataType: 'json',
            data: {InputEmail: $('#InputEmail').val()},
            success: function(data)
            {
                if (data.success2 == true)
                {
                    
                    $("#InputEmail").closest('.form-group').removeClass('has-error').addClass('has-success');
                    $("#helpBlock3").html("Success!");
                    $("#sub_reg").removeAttr("disabled");
                    
                }
                if (data.success2 == false)
                {
                    $("#sub_reg").prop("disabled", "true");
                    //alert("Only as example@email.com!");
                    $("#InputEmail").closest('.form-group').removeClass('has-success').addClass('has-error');
                    //$("#helpBlock3").html("Only as example@email.com!");
                    
                }
            }
        });
    });
    ///Check email for pattern
    $( "#InputPassword1" ).blur(function(d) 
    {
        var Upass = $('#InputPassword1').val();
        if(Upass != 0)
        {   
            if (isValidPassword(Upass))
            {
                $("#InputPassword1").closest('.form-group').removeClass('has-error').addClass('has-success');
                $("#helpBlock4").html("Success!");
            }
            else 
            {
                $("#InputPassword1").closest('.form-group').removeClass('has-success').addClass('has-error');
                $("#helpBlock4").html("Password is invalid! Password contains invalid characters. Use letters and numbers.");
            } 
        } 
        else 
        {      
            $("#InputPassword1").closest('.form-group').removeClass('has-success').addClass('has-error');
            $("#helpBlock4").html("Password empty");
        }
    });
});
</script>
<div class="container">
    <div class="bs-example" data-example-id="simple-ul">
        <form action="reg.php" method="post" class="control-group">
            <div style= "text-align:center;">
                <label style= "text-align:center;">Registration:</label></p>
            </div>
            <label>
                <p>Login</p>
            </label>
            <div class="form-group">
                <p><input type="text" name="InputLogin1" class="form-control" id="InputLogin1" placeholder="Login"></p>
                <span id="helpBlock1" class="help-block"></span>
            </div>

            <label>
                <p>Password</p>
            </label>
            <div class="form-group">
            <p><input type="password" name="InputPassword1" class="form-control" id="InputPassword1" placeholder="Password"></p>
                <span id="helpBlock4" class="help-block"></span>
            </div>
            <label>
                <p>Email</p>
            </label>
            <div class="form-group">
                <p><input type="password1" name="InputEmail" class="form-control" id="InputEmail" placeholder="Email"></p>
                <span id="helpBlock2" class="help-block"></span>
                <span id="helpBlock3" class="help-block"></span>
            </div>
            <p><button type="submit" name="register" class="btn btn-primary" id="sub_reg">Registration</button></p>
            
        </form>
    </div>
</div>
<?php include ('footer.php'); ?>
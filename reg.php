<?php
include ('config.php');
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
            $stmt1 = $conn->prepare("INSERT INTO users (name, pwd, email, hash) VALUES (?,?,?,?)");
            $stmt1->bindParam(1, $username, PDO::PARAM_STR, 20);
            $stmt1->bindParam(2, $password, PDO::PARAM_STR, 100);
            $stmt1->bindParam(3, $email, PDO::PARAM_STR, 30);
            $stmt1->bindParam(4, $hash, PDO::PARAM_STR, 32);
            $stmt1->execute();
            $to      = $email; // Send email to our user
            $subject = 'Signup | Verification'; 
            $cc = null;
            $bcc = null;
            $return_path = "me@vagrant.dev";
            $message = '
             
            Thanks for signing up!
            Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
             
            ------------------------
            Username: '.$username.'
            Password: '.$password.'
            ------------------------
             
            Please click this link to activate your account:
            http://www.vagrant.dev/verify.php?email='.$email.'&hash='.$hash.'
             
            '; // Our message above including the link
                                 
            $headers = 'From:me@vagrant.dev' . "\r\n"; // Set from headers
            //$ok = mail($to, $subject, $message, $headers); // Send our email
            $ok = imap_mail($to, $subject, $message, $headers, $cc, $bcc, $return_path);
            //var_dump($ok);
            //die();
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
    $(document).ready(function() {    
        $( "#InputLogin1" ).blur(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'check.php',
                dataType: 'json',
                data: {InputLogin1: $('#InputLogin1').val()},

                success: function(data)
                {
                    

                    //console.log(data, data.success);
                    if (data.success == true)
                    {
                        $("#InputLogin1").closest('.form-group').removeClass('has-error').addClass('has-success');
                        $("#helpBlock1").html("Success!");
                        $("#sub_reg").removeClass('disabled');
                    }
                    if (data.success == false)
                    {
                        $("#InputLogin1").closest('.form-group').removeClass('has-success').addClass('has-error');
                        $("#helpBlock1").html("This login already use or empty!<br>Login must be longer than 2 characters");
                        $("#sub_reg").addClass('disabled');
                    }
                  
                }
              

            });
        });
            $( "#InputEmail" ).blur(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'check.php',
                dataType: 'json',
                data: {InputEmail: $('#InputEmail').val()},
                success: function(data)
                {

                    //console.log(data, data.success1);
                    if (data.success1 == true)
                    {
                        $("#InputEmail").closest('.form-group').removeClass('has-error').addClass('has-success');
                        //$("#helpBlock2").html("Success!");
                        $("#sub_reg").removeClass('disabled');
                    }
                    if (data.success1 == false)
                    {
                        $("#InputEmail").closest('.form-group').removeClass('has-success').addClass('has-error');
                        $("#helpBlock2").html("This email already use or empty!");
                        $("#sub_reg").addClass('disabled');
                    }
                    
                }
              

            });
        }); 

$( "#InputEmail" ).blur(function(c) {
            c.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'check.php',
                dataType: 'json',
                data: {InputEmail: $('#InputEmail').val()},
                success: function(data)
                {

                    //console.log(data, data.success1);
                    if (data.success2 == true)
                    {
                        $("#InputEmail").closest('.form-group').removeClass('has-error').addClass('has-success');
                        //$("#helpBlock3").html("Success!");
                        $("#sub_reg").removeClass('disabled');
                    }
                    if (data.success2 == false)
                    {
                        $("#InputEmail").closest('.form-group').removeClass('has-success').addClass('has-error');
                        $("#helpBlock3").html("Only as example@email.com!");
                        $("#sub_reg").addClass('disabled');
                    }
                    
                }
              

            });
        });




    });
</script>

<div class="container">
    <div class="bs-example" data-example-id="simple-ul">
        <form action="reg.php" method="post" class="control-group">

            <label style= "text-align:center;">Registration</label></p>
            <label>
                <p>Name</p>
            </label>
            <div class="form-group">
                <p><input type="text" name="InputLogin1" class="form-control" id="InputLogin1" placeholder="Name" ></p>
                <span id="helpBlock1" class="help-block"></span>
            </div>

            <label>
                <p>Password</p>
            </label>
            <p><input type="password" name="InputPassword1" class="form-control" id="InputPassword1" placeholder="Password"></p>

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
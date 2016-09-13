<?php
include ('config.php');
?>
<?php
if(isset($_POST["register"]))
{
    if(!empty($_POST['InputLogin1']) && !empty($_POST['InputPassword1'])) 
    {
        $username=$_POST['InputLogin1'];
        $password=$_POST['InputPassword1'];
        $email = $_POST['InputEmail'];
        $conn = db_connect();
        $stmt = $conn->prepare("SELECT name, pwd  FROM users where name = ?");
        $stmt->bindParam(1, $username, PDO::PARAM_STR, 12);
        $stmt->execute();
        $namePwd = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $numRows = count($namePwd);
        if($numRows==0)
        {
            $stmt1 = $conn->prepare("INSERT INTO users (name, pwd, email) VALUES (?,?,?)");
            $stmt1->bindParam(1, $username, PDO::PARAM_STR, 12);
            $stmt1->bindParam(2, md5("vagrant" + $_POST['InputPassword1']), PDO::PARAM_STR, 12);
            $stmt1->bindParam(3, $email, PDO::PARAM_STR, 12);
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
    $(document).ready(function() {    
        $( "#InputLogin1" ).blur(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'check.php',
                dataType: 'json',
                data: {InputLogin1: $('#InputLogin1').val()},
                data1:{InputEmail: $('#InputEmail').val()},
                success: function(data)
                {

                    //console.log(data, data.success);
                    if (data.success == true)
                    {
                        $("#InputLogin1").closest('.form-group').removeClass('has-error').addClass('has-success');
                        $("#helpBlock1").html("Success!");
                    }
                    if (data.success == false)
                    {
                        $("#InputLogin1").closest('.form-group').removeClass('has-success').addClass('has-error');
                        $("#helpBlock1").html("This login already use!");
                    }

                    
                }
                success: function(data1)
                {

                    //console.log(data, data.success);
                    if (data1.success == true)
                    {
                        $("#InputEmail").closest('.form-group').removeClass('has-error').addClass('has-success');
                        $("#helpBlock2").html("Success!");
                    }
                    if (data1.success == false)
                    {
                        $("#InputEmail").closest('.form-group').removeClass('has-success').addClass('has-error');
                        $("#helpBlock2").html("This login already use!");
                    }

                    
                }

            });
        });





         /*$( "#InputEmail" ).blur(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'check.php',
                dataType: 'json',
                data: {InputEmail: $('#InputEmail').val()},
                success: function(data)
                {
                   
                    if (data.success1 == true)
                    {
                        $("#InputEmail").closest('.form-group').removeClass('has-error').addClass('has-success');
                    }
                    if (data.success1 == false)
                    {
                        $("#InputEmail").closest('.form-group').removeClass('has-success').addClass('has-error');
                    }

                    //$("#content").html(data);
                }

            });
        });*/
    });
</script>





 
        <form action="reg.php" method="post">


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
                <p><input type="email" name="InputEmail" class="form-control" id="InputEmail" placeholder="Email"></p>
                <span id="helpBlock2" class="help-block"></span>
            </div>
            <p><button type="submit" name="register" class="btn btn-primary">Registration</button></p>
            

        </form>
    </div>
</div>







<?php include ('footer.php'); ?>
<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1); 
include ('config.php');

?>
<div class="container-fluid"">
    <div class="row">
        <div class="col-md-3 col-md-offset-3">
            <?php 
            $array = get_data();
            foreach ($array as $key => $value) 
                {
                    ?>
                    <div class="bs-example" data-example-id="simple-ul">
                        <ul class="list-unstyled">
                        <li><b><?= $value['name']."\n"; ?></b></li>
                        <?php
                        if(strlen($value['comment'])>50)
                        {
                            ?>
                            <li><h5><?= substr($value['comment'],0,50); ?></h5>
                            <button type="button" class="btn btn-default btn-xs" id= "full1">...</button>
                            <script>
                           /*$( "#full1" ).click(function(c) {
                            c.preventDefault();
                            $.ajax({
                                type: 'POST',
                                url: 'full.php',
                                dataType: 'json',
                                data: {Input: $('#full').val()},
                                success: function(data)
                                {

                                    //console.log(data, data.success1);
                                    if (data.success == true)
                                    {
                                        $('#full').val(data)
                                        
                                    }
                                    if (data.success == false)
                                    {
                                       $('#full').val("")
                                    }
                                    
                                }
                              

                            });
                        });*/
                           </script>
                            </li>
                            <?php 
                        }
                        ?>
                          <?php
                       if(strlen($value['comment'])<50)
                        {
                            ?>
                            <li><h5><?= $value['comment']; ?></h5>
                            </li>
                            <?php 
                        }
                        ?>
                        <li><small><?= $value['date']."\n"; ?></small></li>
                        <?php
                        if(isset($_SESSION["session_username"]) and $_SESSION["session_username"]==$value['name'])
                        {
                            ?>
                            <a href = "edit.php?id=<?= $value['id']; ?>">Edit</a>
                            <?php 
                        }
                        ?>
                        </ul>
                    </div>
                    <?php
                    }
                    ?>
        </div>
        <div class="col-md-3 col-md-offset-3">
         <?php
                if(isset($_SESSION["session_username"]))
                {
                    ?>
                    <h4><a href="add_comment.php"><?php echo "Add comment"; ?></a></h4>
                    <?php
                }
                ?>
                <h4><a href="login.php">Login</a></h4>
                <h4><a href="reg.php">Registration</a></h4>
        </div>   
    </div>
</div>
<?php include ('footer.php'); ?>





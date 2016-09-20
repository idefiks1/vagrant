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
                    //$("#helpBlock3").html("Success!");
                    $("#sub_reg").removeAttr("disabled");
                    
                }
                if (data.success2 == false)
                {
                    //$("#helpBlock3").html("Only as example@email.com!");
                    $("#sub_reg").prop("disabled", "true");
                    //alert("Only as example@email.com!");
                    $("#InputEmail").closest('.form-group').removeClass('has-success').addClass('has-error');
                    //$("#helpBlock3").html("Only as example@email.com!");
                    
                }
            }
        });
    });
    ///Check email for pattern

    ///Check password for pattern
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
    ///Check password for pattern
     $(".btn").click(function()
    {
        if ($(this).next().is(":hidden"))
        {
            $(this).next().slideDown("slow").show();
            $(this).prev().toggle();
        } 
        else
        {
            $(this).next().slideUp("slow").hide("slow");
            $(this).prev().toggle();
        }
    });
});
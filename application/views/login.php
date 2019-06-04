<html>
    <head>
        <link href="<?php echo base_url(); ?>css/materialize.css" rel="stylesheet" type="text/css">
        <title>Login | Thousand Plus Events </title>
        <link rel="icon" href="<?php echo base_url(); ?>images/favicon.png" type="image/png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>        
        <style>
          
        
        </style>
    </head>    
    <body>        
       <div class="navbar-fixed">
            
            <nav>
              <div class="nav-wrapper">
                  
                <ul class="right hide-on-med-and-down">

                  <li><a href="<?php echo base_url(); ?>index.php/home/index" class="nav-page">Home</a></li>
                  <li><a href="<?php echo base_url(); ?>index.php/home/register" class="nav-page current">Create account</a></li>
                  <li class="active"><a href="<?php echo base_url(); ?>index.php/home/login" class="nav-page">Log In</a></li>

                </ul>
              </div>
           </nav>
        </div>  
        
        <div class="container">           
            <div class="row">                
                <div class="col s12 m6 offset-m3">                    
                    <a href="<?=  base_url() ?>index.php/home/homepage" class="brand-logo"><img src="<?=  base_url() ?>/images/logo1.png" width="100%" style="margin-top:2%;"></a>
                    <div class="card">                        
                        <center><h3>Log In</h3></center><hr>
                        
                        <form method="POST" id="login_form">
                            
                            <div class="row">
                            <div class="col s12 text-center">  
                               
                                
                                <div class="input-field col s12">
                                  <i class="material-icons prefix" id="user_icon">account_circle</i>
                                  <input type="text" name="user" id="user" required>
                                  <label for="user">Username</label>     
                                <span class="helper-text" data-error="Re-check your username" id="helper_user"></span>
                                </div>
                                    
                                <div class="input-field col s12">
                                  <i class="material-icons prefix" id="pass_icon">lock</i>
                                  <input type="password" name="pass" id="pass" required>
                                  <label for="pass">Password</label>        
                                <span class="helper-text" data-error="Re-check your password" id="helper_pass"></span>
                                </div>   
                            </div>
                            
                            <div class="col s12"> 
                                <center>
                                   
                                    <div class="row">
                                        <button name="login" type="button" class="btn-large green waves-light waves-effect" value="Log In" id="login">Log In </button>
                                        <button name="btn_submit" type="submit" class="btn-large green waves-light waves-effect" value="Log In" id="btn_submit" style="display:none">Log In real </button>
                                       
                                    </div>
                                   
                                    <u><a class="mute" href="#" >Forgot password?</a></u>
                                    <br><br>
                                    Do not have an account? <a class="mute" href="<?php echo base_url(); ?>index.php/home/register"><u>Register</u> </a><br>&nbsp;
                                    <?php  ?>
                                </center>
                            </div>
                            </div>
                        </form>
                        
                        
                    </div>
                </div>
            </div>
        </div>
        
        <script src="<?php echo base_url(); ?>js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>js/materialize.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script>
            $(document).ready(function(){
                
                $(window).keydown(function(event){
                    if(event.keyCode == 13) {
                      event.preventDefault();                       
                      $("#login").click();
                      return false;
                    }
                  });
                
                $("#login").click(function(){
                    
                    var user = $("#user").val();
                    var pass = $("#pass").val();
                    
                    $.ajax({
                        url:"<?php echo base_url(); ?>index.php/home/login_check",
                        method:"POST",
                        data:{user: user, pass: pass},
                        success:function(data){                                
                            if(data == 0) 
                            {                                   
                                M.toast({html: 'Incorrect login credentials', displayLength: 5000, classes: 'red' });
                                $("#user").addClass("invalid");  
                                $("#user").focus();  
                                $("#user").select(); 
                               
                                $("#pass").addClass("invalid");  
                                $("#pass").val("");  

                                $("#pass_icon").addClass("red-text");
                                $("#user_icon").addClass("red-text");
                                
                            } 
                            if(data == 1)
                            {
                                $("#overlay").css("display", "block");
                                $('#btn_submit').click();
                            }
                        }
                    });
                    
                    
                });
                
                
                

            });            
        </script>      
       
    </body>
</html>


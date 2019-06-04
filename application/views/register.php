
<html>
    <head>
        
        <title>Register | Thousand Plus Events</title>
        <link rel="icon" href="<?php echo base_url(); ?>images/favicon.png" type="image/png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/materialize.css">
        <meta name="google-signin-client_id" content="1041428688047-9q9j3smvd108srlfps0tjv8232nreidr.apps.googleusercontent.com">
        <meta name="google-signin-scope" content="profile email">
        <script src="https://apis.google.com/js/platform.js" async defer></script>
    </head>    
    <body>        
        <div class="navbar-fixed">
            
            <nav>
              <div class="nav-wrapper">                   
                <ul class="right hide-on-med-and-down">

                  <li><a href="<?php echo base_url(); ?>index.php/home/index" class="nav-page">Home</a></li>
                  <li class="active"><a href="<?php echo base_url(); ?>index.php/home/register" class="nav-page current">Create account</a></li>
                  <li><a href="<?php echo base_url(); ?>index.php/home/login" class="nav-page">Log In</a></li>                 

                </ul>
              </div>
            </nav>
        </div>   
        
        <div class="container">          
            <div class="row">
                <div class="col s12">
                    
                    <div class="alert-success center" hidden>
                        <span class="close-btn-success" id="register_success"></span>
                        Successfully registered !<br><p class="small">Click <a href="login.php"><u>here</u></a> to login</p>
                    </div>
                    
                </div>
                <div class="col s12 m6 offset-m3">
                   <a href="<?=  base_url() ?>index.php/home/homepage" class="brand-logo"><img src="<?=  base_url() ?>/images/logo1.png" width="100%" style="margin-top:2%;"></a>
                    <div class="card">
                         
                        
                        
                    <form method="POST" autocomplete="off">
                          <div class="row ">                    
                        <center><h3 style="padding-top:20px">Register</h3></center>  
                        
                        <div class=" col s12 text-center">  
                                     <hr>
                            <div class="input-field col s12 center-align">
                                <div class="col s5 right-align" style="padding-right:0;line-height:2">
                                    Get email from</div>
                                <div class="g-signin2 col s7 left-align" data-onsuccess="onSignIn" data-theme="dark" style="padding-left:30px"></div>
                            </div>
                            <div class="input-field col s12">
                              <i class="material-icons prefix" id="user_icon">account_circle</i>
                              <input type="text" id="user" name="user"required autocomplete="off" class="validate" minlength=8>
                              <label for="user">Username</label>     
                              <span class="helper-text" data-error="Username must be 8 characters minimum" data-success="Seems good" id="helper_user"></span>
                            </div>
                            
                            <div class="input-field col s12">
                              <i class="material-icons prefix" id="pass1_icon">lock</i>
                              <input type="password" id="pass1" name="pass1"  required autocomplete="off"  class="validate" minlength=8>
                              <label for="pass1">Password</label> 
                            <span class="helper-text" data-error="" data-success="Seems good" id="helper_pass1"></span>
                            </div>
                            
                            <div class="input-field col s12">
                              <i class="material-icons prefix" id="pass2_icon">lock</i>
                              <input type="password" id="pass2" name="pass2" required autocomplete="off" class="validate" minlength=8>
                              <label for="pass2" >Retype Password</label>    
                              <span class="helper-text" data-error="" data-success="Seems good" id="helper_pass2"></span>
                            </div>
                            
                            <div class="input-field col s12">
                              <i class="material-icons prefix" id="email_icon">email</i>
                              <input type="email" id="email" name="email" required autocomplete="off" class="validate">
                              <label for="email">Email</label>
                            <span class="helper-text" data-error="" data-success="Seems good" id="helper_email"></span>
                            </div>
                            
                        </div>
                     
                        </div>
                        <div class="row">
                            <p class="mute small center">By registering you agree to our <a href="terms.php" target="_blank"><u>terms and conditions</u></a></p>   
                            <div class="input-field col s12 center-align">                                                
                                 <button name="reg" type="submit" class="btn-large waves-light waves-effect green" value="Register" id="register_btn">Register</button> <br> &nbsp;
                            </div>              
                        </div>                             
                    </form>  
                            
                </div>
            </div>
        </div>  
        </div>
        
          
        
        
        
        
        </body>  
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>js/materialize.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
     <script>
            $(document).ready(function(){
                
                $("#user").on('keyup focusout change', function(){
                    $("#helper_user").attr("data-success", "Seems good");      
                    var username = $(this).val();   
                    var user_l = $(this).val().length;   
                    
                    if (user_l > 7){
                        $.ajax({
                            url:"<?php echo base_url(); ?>index.php/home/check_username_exists",
                            method:"POST",
                            data:{username: username },
                            success:function(data){
                                if(data == 1) {
                                    $("#helper_user").attr("data-error", "Username already exists");
                                    $("#user").addClass("invalid");
                                    
                                    $("#user_icon").addClass("red-text");
                                    $("#user_icon").removeClass("green-text");
                                }
                                else {
                                    $("#user").removeClass("invalid");
                                    $("#user").addClass("valid");
                                    
                                    $("#user_icon").removeClass("red-text");
                                    $("#user_icon").addClass("green-text");
                                }                                

                                }
                            });
                    }
                    else {
                        $("#helper_user").attr("data-error", "Username must be 8 characters minimum"); 
                        $("#user").addClass("invalid");
                        
                        $("#user_icon").addClass("red-text");
                        $("#user_icon").removeClass("green-text");
                    }
                    
                    
                });
                
                $("#pass1").on('keyup change', function(){
                    var pass = $(this).val().length;              
                    
                    if(pass > 7) {                       
                        $("#pass1").removeClass("invalid"); 
                        $("#pass1").addClass("valid");                        
                        
                        $("#pass1_icon").removeClass("red-text");
                        $("#pass1_icon").addClass("green-text");
                    }
                    else {  
                        $("#helper_pass1").attr("data-error", "Password must be 8 characters minimum");           
                        $("#pass1").addClass("invalid");
                        
                        $("#pass1_icon").addClass("red-text");
                        $("#pass1_icon").removeClass("green-text");
                    }
                    
                    var pass1 = $(this).val();              
                    var pass2 = $("#pass2").val();              
                    
                    if(pass1 != pass2 && pass2 != '' ) {   
                        $("#helper_pass1").attr("data-error", "Password must be 8 characters minimum");           
                        $("#pass2").addClass("invalid"); 
                        
                        $("#pass2_icon").addClass("red-text");
                        $("#pass2_icon").removeClass("green-text");
                    }
                    else if(pass2 != ''){                       
                        $("#pass2").removeClass("invalid");
                        $("#pass2").addClass("valid");
                        
                        $("#pass2_icon").removeClass("red-text");
                        $("#pass2_icon").addClass("green-text");
                    }
                            
                        
                });
                
                $("#pass2").on('keyup focusout change', function(){
                    var pass2 = $(this).val();              
                    var pass2_l = $(this).val().length;              
                    var pass1 = $("#pass1").val();              
                    
                    if (pass2_l < 8) {
                        $("#helper_pass2").attr("data-error", "Passwords do not match");           
                        $("#pass2").addClass("invalid"); 
                        
                        $("#pass2_icon").addClass("red-text");
                        $("#pass2_icon").removeClass("green-text");
                        
                    }
                    else if(pass1 == pass2 && pass2_l > 2) {                       
                        $("#pass2").removeClass("invalid"); 
                        $("#pass2").addClass("valid"); 
                        
                        $("#pass2_icon").removeClass("red-text");
                        $("#pass2_icon").addClass("green-text");
                        
                    }
                    else {         
                        $("#helper_pass2").attr("data-error", "Passwords do not match");       
                        $("#pass2").addClass("invalid");
                        
                        $("#pass2_icon").addClass("red-text");
                        $("#pass2_icon").removeClass("green-text");
                       
                    }
                            
                        
                });
               
                $("#email").on('keyup focusin focusout change', function(){
                    var email = $(this).val();             
                    var filter =  /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{1,4})+$/;
                    
                    if (filter.test(email)) {
                        var valid = 1;                        
                        $("#email").removeClass("invalid");  
                        $("#email").addClass("valid");  
                        
                        $("#email_icon").removeClass("red-text");
                        $("#email_icon").addClass("green-text");
                        
                        $.ajax({
                            url:"<?php echo base_url(); ?>index.php/home/check_email_exists",
                            method:"POST",
                            data:{email: email },
                            success:function(data){
                            if(data == 1) {
                                $("#helper_email").attr("data-error", "Email already used");
                                $("#email").addClass("invalid");  
                                
                                $("#email_icon").addClass("red-text");
                                $("#email_icon").removeClass("green-text");
                            }           
                        }
                    });
                    }
                    else {
                        var valid = 0;
                        $("#helper_email").attr("data-error", "This doesn't seem like an email");
                        $("#email").addClass("invalid");   
                        
                        $("#email_icon").addClass("red-text");
                        $("#email_icon").removeClass("green-text");
                    }
                    
                    
                    
                    
                });
                
                $("#register_btn").on('click', function(event){                    
                    if($("#user").hasClass("invalid") || $("#pass1").hasClass("invalid") || $("#pass2").hasClass("invalid")  || $("#email").hasClass("invalid") ) {
                       event.preventDefault();
                       M.toast({html: 'Re-check fields marked in red', displayLength: 5000, classes: 'red' });
                    }
                    
                            
                        
                });
                
                
            });

         
        </script>
    
        <script>
              function onSignIn(googleUser) {                
                var profile = googleUser.getBasicProfile();                 
                M.toast({html: 'Welcome ' + profile.getName(), displayLength: 5000, classes: 'green' });  

                jQuery("#email").val(profile.getEmail());
                jQuery("#user").val(((profile.getGivenName() + profile.getFamilyName()).toLowerCase()).split(" ").join(""));
                jQuery("#email").trigger("change");
                jQuery("#email").trigger("change");
                jQuery("#user").trigger("change");
                $("#helper_user").attr("data-success", "(Suggested) - You can change this");      
                M.updateTextFields();
              }
              
              function signOut() {
                var auth2 = gapi.auth2.getAuthInstance();
                auth2.signOut().then(function () {
                  console.log('User signed out.');
                });
              }
        </script>
   

</html>
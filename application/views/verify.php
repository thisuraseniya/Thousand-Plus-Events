<html>
    <head>
        <link href="<?php echo base_url(); ?>css/materialize.css" rel="stylesheet" type="text/css">
        <title>Verify Email | Thousand Plus Events </title>
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
                  <li class="active"><a href="<?php echo base_url(); ?>index.php/home/logout" class="nav-page">Log out</a></li>
                </ul>
              </div>
           </nav>
        </div> 
        
        <div class="container">           
            <div class="row">                
                <div class="col s12 m6 offset-m3">                    
                    <a href="<?=  base_url() ?>index.php/home/homepage" class="brand-logo"><img src="<?=  base_url() ?>/images/logo1.png" width="100%" style="margin-top:2%;"></a>
                   <br>&nbsp;
                        
                    <div class="col s12 center-align" >
                        <div class="collection">
                            <a href="<?=  base_url() ?>index.php/home/profile" class="collection-item red white-text strong">Your email is not verified. </a>
                        </div>
                        <p>We have sent a confirmation email to the email you have provided with this account. <br><br>Enter the verification code sent to you in that email, below.</p>
                        
                        <div class="input-field col s12">
                          <input id="v_code" type="number">
                          <label for="v_code">Verification Code </label>
                        </div>
                        
                        <div class="row">
                            <div class="input-field col s8 left-align">                            
                              <button class="waves-effect waves-green btn-flat" id="resend">Re-send verification email <span id="counter"></span></button>                                  
                            </div>
                       
                            <div class="input-field col s4 right-align">                            
                                <button class="btn green waves-effect waves-light" id="verify">Verify
                                <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                        
                        
                        
                        
                    </div>
                  
                </div>
            </div>
        </div>
        
        
    </body>
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/materialize.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script>
        $("#resend").click(function() {
            $("#resend").attr("disabled", "disabled");
            
            var count = 59, timer = setInterval(function() {
                $("#counter").html(count--);
                    if(count == 0) clearInterval(timer);
                }, 1000);
            
            setTimeout(function() {
                $("#resend").removeAttr("disabled");
                $("#counter").attr("hidden", "hidden");
            }, 60000);
        });
        
        $(document).ready(function(){
            
            $("#resend").click(function(){
                 $.ajax({
                    url:"<?php echo base_url(); ?>index.php/home/resend_verification_email",
                    method:"POST",
                    data:{username: "<?= $username ?>"},
                    success:function(data){
                        M.toast({html: 'Email successfully sent!', classes: 'blue'});
                    }
                });            
            });
            
            $("#verify").click(function(){
                var code = $("#v_code").val();
                 $.ajax({
                    url:"<?php echo base_url(); ?>index.php/home/verify_email",
                    method:"POST",
                    data:{code: code, username: "<?= $username ?>"},
                    success:function(data){
                        if(data == 0)
                            {
                                M.toast({html: 'Verification code is incorrect', classes: 'red'});
                            }
                        else if (data == 1)
                            {
                                M.toast({html: 'Verification successfull!', classes: 'green'});
                                window.location.replace("<?php echo base_url(); ?>index.php/home/verification_success/<?= $username ?>/"+code);
                            }
                    }
                });            
            });   
            
        });
        
        

    </script>
</html>
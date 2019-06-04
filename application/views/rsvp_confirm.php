
<html>
    <head>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/materialize.css">
        <title> Register for the event | Thousand Plus Events</title>
        <link rel="icon" href="<?php echo base_url(); ?>images/favicon.png" type="image/png"> 
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>  
    
    <body>  
        
          
        <div class="navbar-fixed">
            
            <nav>
              <div class="nav-wrapper">
                  <a href="#!" class="brand-logo"></a>
                <ul class="right hide-on-med-and-down">

                  <li><a href="<?php echo base_url(); ?>index.php/rsvp" class="nav-page">Home</a></li>
                 

                </ul>
              </div>
            </nav>

        </div>            
        
        <div class="row">  
        <div class="col s12">
            
                <div class="col s12 m4 offset-m4"  style="margin-top:40px">
                     <div class="col s12 center-align">
                    <h4><strong><?php echo $events['name']; ?></strong></h4><?php echo $events['date']; ?> <br>
                    <?php echo $events['time']; ?>
                    <br>&nbsp;
                </div>
                <div class="col s12 center-align">
                    <img class="" src="<?php echo base_url().$events['pic']; ?>" width="100%" id="output" style="margin-top:20px">           
                </div>  

                </div>

               <form method="POST">
                <div class="col s12 m6 offset-m3" style="margin-top:50px">                      
                    <center><h6>Provide your details to register for the above event</h6><br></center>
                     <form method="post">
                        <div class="input-field col s12">                           
                            <input type="text" id="name" name="name" required>
                            <label for="fname">Name*</label>
                        </div>    
                    
                        <div class="input-field col s12">                           
                            <input type="email" id="email" name="email" required>
                            <label for="email">Email*</label>
                        </div> 
                    
                        <div class="input-field col s12">                           
                            <input type="text" id="tele" name="tele" required>
                            <label for="tele">Telephone*</label>
                        </div>  
                    
                        <div class="input-field col s12">
                            <textarea id="address" name="address" class="materialize-textarea"></textarea>
                            <label for="address">Address</label>
                        </div>
                        <div class="input-field col s12">
                            <center><div class="g-recaptcha" data-callback="capcha_filled" data-expired-callback="capcha_expired" data-sitekey="6Lff_IUUAAAAAPkataXBEI8enoaex-KGUOyC4Vrg"></div></center>
                        </div>
                              
                        <div class="input-field col s12 center-align">
                            <button name="btn_reset" id="btn_reset" type="reset" value="Reset" class="btn-large waves-light waves-effect red" >Cancel</button>  
                            <button name="btn_save" id="btn_save" type="submit" value="Save" class="btn-large waves-light waves-effect green" disabled>Register</button>  
                             
                        </div>
                    </form>
                       
                   </div>  
               
                </form>
           
            
            
        </div>
        </div>               
        
    </body>

    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/materialize.js"></script>
    
    <script>
        $(document).ready(function(){
            $('select').formSelect();
        });
        
        $(document).ready(function(){
            $('.fixed-action-btn').floatingActionButton();
        });
        
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
        
        function capcha_filled() {
            document.getElementById("btn_save").disabled = false;            
        }    
        
        function capcha_expired() {
            document.getElementById("btn_save").disabled = true;            
        } 
        
        
        
    </script>

</html>


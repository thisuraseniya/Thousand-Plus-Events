
<html>
    <head>
  
        <title> My Profile | Thousand Plus Events</title>
       
        
    </head>  
    
    <body>  
        
          
          
        
        <div class="row">  
        <div class="col ms12">
            
                <div class="col s12 m3"  style="margin-top:40px">
                    <div class="col s12">                        
                        <img src="<?php echo base_url().$_SESSION['pic']?>" class="materialboxed" width="100%" id="output">
                    </div>
                    
                   <?php echo form_open_multipart('home/do_upload');?>
                    
                        <div class="file-field input-field col m12">
                          <div class="btn black waves-light waves-effect">
                            <span>Change profile Picture</span>
                            <input type="file" name="fileToUpload" id="fileToUpload" onchange="loadFile(event); return upload_btn(this); " accept="image/jpg, image/png, image/jpeg"
                            size="20">
                          </div>
                          <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" value="" class="validate">
                          </div>                         
                                                
                        </div>                                           
                  
                        <div class="input-field col m12 right-align"> 
                            <button type="submit" value="save" name="upload" id="upload" disabled class="btn waves-light waves-effect green">Save changes</button>                            
                        </div> 
                    
                        
                       
                    
                    <?php echo '</form>'; ?>

                    <div class="alert-fail" hidden>
                        <span class="close-btn-fail" id="fail_type" onclick="fail_type_close()">&times;</span>
                        Only .jpg .jpeg or .png files can be uploaded   
                    </div>

                    <div class="alert-fail" hidden>
                        <span class="close-btn-fail" id="fail_size" onclick="fail_size_close()">&times;</span>
                        File too large. Max 1MB.
                    </div>

                    <div class="alert-fail" hidden>
                        <span class="close-btn-fail" id="fail_error" onclick="fail_error_close()">&times;</span>
                        Error uploading image. Try again later.
                    </div>            
                

                </div>

             
                <div class="col s12 m6">       
                      <form method="POST">
                    <center><h3>Your Personal Details</h3><br></center>
                     
                        <div class="input-field col s12">                           
                            <input type="text" id="fname" name="fname" placeholder="First Name" value="<?php echo $fname; ?>" onkeyup="activate()" >
                            <label for="fname">First Name</label>
                        </div>                               
                        
                        <div class="input-field col s12">                           
                            <input type="text" id="lname" name="lname" placeholder="Last Name" value="<?php echo $lname; ?>" onkeyup="activate()">
                            <label for="lname">Last Name</label>
                        </div>                               
                        
                        <div class="input-field col s12">
                            <select name="gender" id="g" onchange="activate()">
                                    <option value="<?php echo $gender; ?>" hidden><?php echo $gender; ?></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>                                       
                            </select>
                            <label>Select your gender</label>
                        </div>         
                         
                        <div class="input-field col s12">                           
                            <input type="text" id="nic" name="nic" placeholder="eg - 9612345678v" value="<?php echo $nic; ?>" onkeyup="activate()">
                            <label for="nic">NIC</label>
                        </div>  
                    
                        <div class="input-field col s12">                           
                            <input type="text" id="tele" name="tele" placeholder="eg - +94712345678" value="<?php echo $telephone; ?>" onkeyup="activate()">
                            <label for="tele">Telephone</label>
                        </div>  
                    
                        <div class="input-field col s12">                           
                            <input type="email" id="email" name="email" placeholder="email" value="<?php echo $email; ?>" readonly disabled>
                            <label for="email">Email</label>
                        </div>
              
                        <div class="fixed-action-btn">
                            <button name="btn_reset" id="btn_reset" type="button" value="Reset" class="btn-large waves-light waves-effect red" disabled onclick="location.reload()">Cancel</button>  
                            <button name="btn_save" id="btn_save" type="submit" value="Save" class="btn-large waves-light waves-effect green" disabled>Save changes</button>  
                             
                        </div>

                    
                   </form>    
                   </div>  
               
                <div class="col m3">  
                    <center><h3>Options</h3><br></center>
                    <div class="col m6 ">  
                        Show reminders and notifications when I log in
                    </div>
                    <div class="col m6">
                    <div class="input-field col s12">                           
                        <div class="switch">
                        <label>
                          Off
                          <input type="checkbox" id="reminder_toggle" name="reminder_toggle"  <?php if($reminders ==1){echo "checked";} ?>  >
                          <span class="lever"></span>
                          On
                        </label>
                            
                      </div>
                    </div>
                    </div>  
                </div>
            
        </div>
            
           
        </div>

        
        
        <script>
            function activate() {
                document.getElementById("btn_save").disabled = false;
                document.getElementById("btn_reset").disabled = false;
            }
            
            function upload_btn(file) {
                var ext = file.files[0].name.split('.').pop();                
                var valid = 1;
                var FileSize = file.files[0].size / 1024 / 1024; 
                
                if (FileSize > 1) 
                {
                    fail_size.parentElement.style.display='block';
                    valid = 0;   
                }                 
                else if ( ext == "jpg" || ext == "JPG" || ext == "jpeg" || ext == "JPEG" || ext == "png" || ext == "PNG" ) 
                {
                    valid = 1 
                }
                else 
                {
                    fail_type.parentElement.style.display='block';
                    valid = 0
                }
                
                if (valid == 1) 
                {
                    document.getElementById("upload").disabled = false;
                    document.getElementById("cancel_up").disabled = false; 
                    fail_size.parentElement.style.display='none';
                    fail_type.parentElement.style.display='none';
                }
                else
                {
                    document.getElementById("upload").disabled = true;
                    document.getElementById("cancel_up").disabled = true;    
                }
            }
            
            function fail_type_close() {
                fail_type.parentElement.style.display='none';
            }
            
            function fail_size_close() {
                fail_size.parentElement.style.display='none';
            }
            
            function fail_error_close() {
                fail_error.parentElement.style.display='none';
            }
                        
             
            
        </script>
        
    </body>

    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/materialize.js"></script>
    
    <script>
        $(document).ready(function(){
            $("#profile").addClass("active");
            $("#profile_2").addClass("active");
            $('select').formSelect();       
            $('.fixed-action-btn').floatingActionButton();
            $('.materialboxed').materialbox();
        });
        
         $('#reminder_toggle').change(function(){                
            if (this.checked){
                var value = 1;
            }
            else {
                var value = 0;
            }          

            $.ajax({
                 url:'<?= base_url() ?>index.php/home/toggle_reminder',
                 method: 'post',
                 data: {value: value},
                 dataType: 'json',
                 complete: function(response){M.toast({html: 'Preference saved', displayLength: 2000 });}
                });
            });
        
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>

</html>


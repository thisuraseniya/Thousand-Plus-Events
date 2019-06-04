<?php 

    if ($departments['finance']) {  $finance_toggle = "checked";  }
    else {  $finance_toggle = "hidden";  }

    if ($departments['logistics']) {  $logistics_toggle = "checked";  }
    else {  $logistics_toggle = "hidden";  }

    if ($departments['decoration']) {  $decoration_toggle = "checked";  }
    else {  $decoration_toggle = "hidden";  }

    if ($departments['marketing']) {  $marketing_toggle = "checked";  }
    else {  $marketing_toggle = "hidden";  }

    if ($departments['sales']) {  $sales_toggle = "checked";  }
    else {  $sales_toggle = "hidden";  }

    if ($departments['registration']) {  $registration_toggle = "checked";  }
    else {  $registration_toggle = "hidden";  }
    
?>
<html>
    <head>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/materialize.css">
<!--        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">        -->
        <title> Manage Events | Thousand Plus Events </title>
        <link rel="icon" href="<?php echo base_url(); ?>images/favicon.png" type="image/png"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script>
        
    </script>
    </head>  
    
    <body>  
        
        
      
               
        <?php foreach($events as $val){ ?>
        
            <div class="row" >
                <div class="col s12 m3">  
                    <div class="col s12 center-align">
                        <h4><strong><?php echo $val['name']; ?></strong></h4><?php echo $val['date']; ?> <br>
                        <?php echo $val['time']; ?>
                        <br>&nbsp;
                   
                        <img class="materialboxed" src="<?php echo base_url().$val['pic']; ?>" width="100%" id="output">                        
                       
                    </div>
                    
                    <?php echo form_open_multipart("home/do_pic_upload/".$_SESSION['id']); ?>
                    
                        <div class="file-field input-field col s12">
                          <div class="btn black waves-light waves-effect">
                            <span>Change cover picture</span>
                            <input type="file" name="fileToUpload" id="fileToUpload" onchange="loadFile(event); return upload_btn(this); " accept="image/jpg, image/png, image/jpeg"
                            size="20">
                          </div>
                          <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" value="" class="validate">
                          </div>                         
                                                
                        </div>                                           
                  
                        <div class="input-field col s12 center-align"> 
                            <button type="reset" value="Cancel" name="cancel_up" id="cancel_up" class="btn red waves-light waves-effect" onclick="location.reload()" disabled>Cancel</button>
                            <button type="submit" value="save" name="upload" id="upload" disabled class="btn waves-light waves-effect green">Save changes</button>  
                            
                        </div> 
                    <?php echo "</form>"; ?>
                    
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
                    <br>
                    &nbsp;
                    <div class="col s12 center-align" >
                        <form method="post">
                           
                            <div class="input-field col s12">
                                <input placeholder="Event Name" id="e_name" name="e_name" type="text" class="validate" value="<?= $val['name']; ?>" required>
                                <label for="e_name">Event Name</label>
                            </div>
                            <div class="input-field col s12">
                                <input placeholder="Date" id="date" name="e_date" type="text" class="validate datepicker" value="<?= $val['date']; ?>" required>
                                <label for="date">Date</label>
                            </div>
                            <div class="input-field col s12">
                                <input placeholder="time" id="time" name="e_time" type="text" class="validate timepicker" value="<?= $val['time']; ?>" required>
                                <label for="time">Time</label>
                            </div>
                            <div class="input-field col s12">
                                <textarea placeholder="description" id="description" name="e_description" type="text" class="validate materialize-textarea" required><?= $val['description']; ?></textarea>
                                <label for="time">Description</label>
                            </div>
                           
                            <div class="input-field col s12">
                                <button value="cancel_details" id="cancel_details" name="cancel_details" class="waves-effect waves-light btn red" type="reset">Cancel</button>
                                <button value="save_details" id="save_details" name="save_details" class="waves-effect waves-light btn green" type="submit">Save</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
                <div class="col m9"  style="margin-top:30px"> 
                
                    <div class="row col s12">                        
                        <a href="<?php echo base_url(); ?>index.php/home/manage" class="breadcrumb">My Events</a>
                        <a href="" class="breadcrumb"><?php echo $val['name']; ?></a>                                          
                    </div>
                    
                <div class="row"> 
                <div class="col s12 m5">
                    <div class="card col s12">
                            <a class="anchor" id="crew"></a>
                            <center><h5><strong>Overview</strong></h5><hr></center>
                                Days left - <?php 
                                                $diff=date_diff(date_create(date("Y-m-d")), date_create($val['date']));
                                                if ((int)($diff->format("%d")) < 0 )
                                                    { echo "<a style='color:red'>Overdue</a>"; } 
                                                else { echo $diff->format("%a");   
                                                 echo $diff->format(" (%m Month(s) %d Day(s))"); }  
                                            ?>
                        <br><br>
                        <b>Department Completions</b><br>
                        <div <?php echo $finance_toggle; ?> >&nbsp;&nbsp;Finance Department - <b><?= number_format((float)$departments_progress['finance'], 2, '.', '') ?>%</b><br></div>
                        <div <?php echo $logistics_toggle; ?> >&nbsp;&nbsp;Logistics Department - <b><?= number_format((float)$departments_progress['logistics'], 2, '.', '') ?>%</b><br></div>
                        <div <?php echo $decoration_toggle; ?> >&nbsp;&nbsp;Decorations Department - <b><?= number_format((float)$departments_progress['decorations'], 2, '.', '') ?>%</b><br></div>
                        <div <?php echo $marketing_toggle; ?> >&nbsp;&nbsp;Marketing Department - <b><?= number_format((float)$departments_progress['marketing'], 2, '.', '') ?>%</b><br></div>
                        <div <?php echo $registration_toggle; ?> >&nbsp;&nbsp;Registrations Department - <b><?= number_format((float)$departments_progress['registrations'], 2, '.', '') ?>%</b><br></div>
                        <div <?php echo $sales_toggle; ?> >&nbsp;&nbsp;Sales Department - <b><?= number_format((float)$departments_progress['sales'], 2, '.', '') ?>%</b><br></div>
                               
                            <div class="row">
                                
                               
                            </div>

                            <div>                                        
                                
                            </div>
                    </div> 
                    <div class="card col s12">
                         <a class="anchor" id="search"></a>
                            <center><h5><strong>Invite Users</strong></h5><hr>        
                           
                           
                                Search through thousands of users whom you can get help from.</center><hr>
                                 <div class="row" style="margin-bottom:0">                    
                                <div class="input-field col s12">
                                  <i class="material-icons prefix">search</i>
                                  <input type="text" id="search_user" name="search_text" placeholder="Search">
                                  <label for="search_user">Search Users by username</label>                        
                                </div>
                                </div> 
                                <div class="row">
                                    <hr>
                                    <div id="result_users" class="col s12"></div></div>
                            

                       
                    </div>
                    
                     <div class="card col s12">
                            <a class="anchor" id="crew"></a>
                            <center><h5><strong>Add Reminders</strong></h5><hr>
                        <div style="font-size:11pt">Reminders will be displayed each time you log in to Thousand Plus Events. You can change this under 'My Profile'.</div></center>
                            <div class="row">
                                <form method="POST">
                                    <div class="input-field col s12 m9">                                                          
                                        <input type="text" name="reminder" id="reminder" required>  
                                        <label for="reminder">Enter reminder</label>
                                    </div>
                                    <div class="input-field col s12 m3 right-align"> 
                                        <button class="btn green waves-light waves-effect" name="add_reminder" type="submit" value="Add">Save</button>
                                    </div>
                                </form>
                            </div>

                                                              
                        <div class="col s12">                            
                           <ul class="collection">
                                <?php foreach($reminders as $rem){ ?>                                       
                                    <li class="collection-item avatar">
                                      <i class="material-icons circle blue">notes</i>
                                      <span class="title">Reminder - <?= $rem['reminder'] ?></span>                                     
                                        <br>
                                        <div class="right-align">
                                        <a href="<?php echo base_url(); ?>index.php/home/delete_reminder/<?= $rem['id']*23 ?>/<?= $id_passed ?>" class="waves-light waves-effect red btn" style="margin-top:5px">Delete</a>
                                        </div>          
                                      
                                    </li>
                                <?php } ?>          
                            </ul>            
                          </div>                           
                        </div>    
                   
                </div>
                
                <div class="col m7">                    
                    <div class="row">
                        

                        <div class="col m4 s6">
                            <a href="#modal1" class="modal-trigger">
                              <div class="card">
                                <div class="card-image">
                                  <img src="<?php echo base_url(); ?>images/departments/add_new.png">
                                </div>

                                <div class=" center-aligned" style="padding: 13px">
                                    <center>  <b>Add / Remove departments</b></center>
                                </div>

                                <div class="progress">
                                    <div class="determinate" style="width: 100%"></div>
                                </div>

                              </div>
                            </a>
                        </div>
                        
                        <div id="modal1" class="modal">
                            
                            <form method="post" action="<?php echo base_url(); ?>index.php/home/departments/<?php echo $_SESSION['id']; ?>">
                            <div class="modal-content">
                                <p>
                                 <ul class="collection">
                                     <li class="collection-item">
                                         <div>Finance Department
                                             <a href="#!" class="secondary-content">
                                                 <div class="switch">
                                                    <label>
                                                      Remove
                                                      <input type="checkbox" name="finance_toggle" <?php echo $finance_toggle; ?> >
                                                      <span class="lever"></span>
                                                      Add
                                                    </label>
                                                  </div>
                                             </a>
                                         </div>
                                     </li>
                                     
                                     <li class="collection-item">
                                         <div>Logistics Department
                                             <a href="#!" class="secondary-content">
                                                 <div class="switch">
                                                    <label>
                                                      Remove
                                                      <input type="checkbox" name="logistics_toggle" <?php echo $logistics_toggle; ?> >
                                                      <span class="lever"></span>
                                                      Add
                                                    </label>
                                                  </div>
                                             </a>
                                         </div>
                                     </li>
                                     
                                     <li class="collection-item">
                                         <div>Decorations Department
                                             <a href="#!" class="secondary-content">
                                                 <div class="switch">
                                                    <label>
                                                      Remove
                                                      <input type="checkbox" name="decorations_toggle" <?php echo $decoration_toggle; ?> >
                                                      <span class="lever"></span>
                                                      Add
                                                    </label>
                                                  </div>
                                             </a>
                                         </div>
                                     </li>
                                     
                                     <li class="collection-item">
                                         <div>Marketing Department
                                             <a href="#!" class="secondary-content">
                                                 <div class="switch">
                                                    <label>
                                                      Remove
                                                      <input type="checkbox" name="marketing_toggle" <?php echo $marketing_toggle; ?> >
                                                      <span class="lever"></span>
                                                      Add
                                                    </label>
                                                  </div>
                                             </a>
                                         </div>
                                     </li>
                                     
                                     <li class="collection-item">
                                         <div>Registrations Department
                                             <a href="#!" class="secondary-content">
                                                 <div class="switch">
                                                    <label>
                                                      Remove
                                                      <input type="checkbox" name="registration_toggle" <?php echo $registration_toggle; ?> >
                                                      <span class="lever"></span>
                                                      Add
                                                    </label>
                                                  </div>
                                             </a>
                                         </div>
                                     </li>
                                     
                                     <li class="collection-item">
                                         <div>Sales Department
                                             <a href="#!" class="secondary-content">
                                                 <div class="switch">
                                                    <label>
                                                      Remove
                                                      <input type="checkbox" name="sales_toggle" <?php echo $sales_toggle; ?> > 
                                                      <span class="lever"></span>
                                                      Add
                                                    </label>
                                                  </div>
                                             </a>
                                         </div>
                                     </li>
                                     
                                     
                                </ul>
                                <div class="right-align">
                                    <button class="modal-close waves-effect waves-light btn red" type="reset" name="reset">Cancel</button>
                                    <button class="modal-close waves-effect waves-light btn green" type="submit" value="save" name="save">Save Changes</button>
                                    
                                </div>
                            </div>
                            </form>
                        
                        </div>
                        
                        <div class="col m4 s6" <?php echo $finance_toggle; ?> >
                            <a href="<?php echo base_url(); ?>index.php/home/finance/<?php echo $val['id']*23; ?>">
                              <div class="card">
                                <div class="card-image">
                                  <img src="<?php echo base_url(); ?>images/departments/finance.jpg">
                                </div>

                                <div class="card-content center-aligned">
                                    <center>Finance</center>
                                </div>

                                <div class="progress">
                                    <div class="determinate" style="width: <?php echo $departments_progress['finance']; ?>%"></div>
                                </div>

                              </div>
                            </a>
                        </div>
                        
                        <div class="col m4 s6" <?php echo $logistics_toggle; ?>>
                            <a href="<?php echo base_url(); ?>index.php/home/logistics/<?php echo $val['id']*23; ?>">
                              <div class="card">
                                <div class="card-image">
                                  <img src="<?php echo base_url(); ?>images/departments/logistics.jpg">
                                </div>

                                <div class="card-content center-aligned">
                                    <center>Logistics</center>
                                </div>

                                <div class="progress">
                                    <div class="determinate" style="width: <?php echo $departments_progress['logistics']; ?>%"></div>
                                </div>
                              </div>
                            </a>
                        </div>
                        
                        <div class="col m4 s6" <?php echo $decoration_toggle; ?>>
                            <a href="<?php echo base_url(); ?>index.php/home/decorations/<?php echo $val['id']*23; ?>">
                              <div class="card">
                                <div class="card-image">
                                  <img src="<?php echo base_url(); ?>images/departments/decoration.jpg">
                                </div>

                                <div class="card-content center-aligned">
                                    <center>Decorations</center>                                    
                                </div>

                                <div class="progress">
                                    <div class="determinate" style="width: <?php echo $departments_progress['decorations']; ?>%"></div>
                                </div>

                              </div>
                            </a>
                        </div>
                    
                        
                        <div class="col m4 s6" <?php echo $marketing_toggle; ?>>
                            <a href="<?php echo base_url(); ?>index.php/home/marketing/<?php echo $val['id']*23; ?>">
                              <div class="card">
                                <div class="card-image">
                                  <img src="<?php echo base_url(); ?>images/departments/marketing.jpg">
                                </div>

                                <div class="card-content center-aligned">
                                    <center>Marketing</center>
                                </div>

                                <div class="progress">
                                    <div class="determinate" style="width: <?php echo $departments_progress['marketing']; ?>%"></div>
                                </div>
                              </div>
                            </a>
                        </div>
                
                        <div class="col m4 s6" <?php echo $registration_toggle; ?>>
                            <a href="<?php echo base_url(); ?>index.php/home/registrations/<?php echo $val['id']*23; ?>">
                              <div class="card">
                                <div class="card-image">
                                  <img src="<?php echo base_url(); ?>images/departments/registration.jpg">
                                </div>

                                <div class="card-content center-aligned">
                                    <center>Registrations</center>
                                </div>

                                <div class="progress">
                                    <div class="determinate" style="width: <?php echo $departments_progress['registrations']; ?>%"></div>
                                </div>
                              </div>
                            </a>
                        </div>
                        
                        <div class="col m4 s6" <?php echo $sales_toggle; ?>>
                            <a href="<?php echo base_url(); ?>index.php/home/sales/<?php echo $val['id']*23; ?>">
                              <div class="card">
                                <div class="card-image">
                                  <img src="<?php echo base_url(); ?>images/departments/sales.jpg">
                                </div>

                                <div class="card-content center-aligned">
                                    <center>Sales</center>
                                </div>

                                <div class="progress">
                                    <div class="determinate" style="width: <?php echo $departments_progress['sales']; ?>%"></div>
                                </div>
                              </div>
                            </a>
                        </div>
                     
                </div>
                
               
                        
            </div>
                </div>
               
            <?php } ?>
        </div>
        </div>   
    </body>
    
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/materialize.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <script>
            $(document).ready(function(){
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    minDate: new Date()
                });
                $('.timepicker').timepicker({
                    twelveHour: false
                });
                $('#modal1').modal({
                    dismissible: false
                });
                
                $('#cancel_details').click(function(){   
                    event.preventDefault();
                    this.form.reset(); 
                    M.updateTextFields();                
                }); 
                
                $('.materialboxed').materialbox();
                
                //////// User Ajax
                function load_user(name){    
                    $.ajax({
                        url:"<?php echo base_url(); ?>index.php/home/search_users",
                        method:"POST",
                        data:{name:name},
                        success:function(data){
                            $('#result_users').html(data);
                        }
                    });
                 }

                $('#search_user').keyup(function(){

                    var search = $(this).val();
                    if(search != '')
                    {
                        load_user(search);
                    }
                    else
                    {
                        load_user();
                    }
                });
                
            });
            
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
            
            var loadFile = function(event) {
                var output = document.getElementById('output');
                output.src = URL.createObjectURL(event.target.files[0]);
            };
            
            
            
        </script>    
</html>


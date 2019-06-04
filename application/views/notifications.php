
<html>
    <head>
      
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/materialize.css">        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="icon" href="<?php echo base_url(); ?>images/favicon.png" type="image/png">    
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
        
    </head>  
    
    <body>  
        

        <!--        Notifications Model -->
            <div id="modal_notifications" class="modal bottom-sheet modal-fixed-footer">
                <div class="modal-content">
                    <div class="row">
                        <div class="col s12 m4 offset-m4">
                        <center><img src="<?= base_url() ?>/images/logo1.png" width="100%" ></center>
                        </div>
                        <div class="col s12 m6">
                           
                            <div class="col s12 card">
                            <center><h5>Notifications</h5></center><hr>
                                <center><span id="no_notifications">You have no notifications! </span></center>
                                <div class="right-align" hidden id="mark_read_div">
                                   <label>
                                        <input type="checkbox" class="filled-in" value=1 id="mark_read" />                        
                                    <span style="color:black">Mark all as read</span>
                                    </label> 
                                </div>
                                <ul class="collection">
                                    
                                    
                                <?php $noti_count = 0;
                                    foreach($notifications as $noti){
                                        ?>
                                        <script>document.getElementById("no_notifications").style.display = 'none'; 
                                        document.getElementById("mark_read_div").style.display = 'block'; </script>                            
                                    
                                        <li class="collection-item avatar notification_bar" style="background-color:rgba(3, 201, 0, 0.1)"  >
                                          <i class="material-icons circle green">notifications</i>
                                            <span class="title">Task '<b><?= $noti['task_name'] ?></b>' has been assigned to you.</span><br>

                                            <div class="right-align">
                                                <a href="<?= base_url(); ?>index.php/collaborate/<?= $noti['dept_name'] ?>/<?= $noti['event']*23 ?>" style="margin-top:5px" class="btn green waves-effect waves-light">View
                                                    </a>
                                            </div>

                                        </li>                           
                                            
                                    <?php $noti_count ++; }
                                    $_SESSION['noti_count'] = $noti_count; ?>          
                                </ul>   
                           
                            </div>
                        </div>
                        <div class="col s12 m6">
                            <div class="col s12 card">
                            <center><h5>Reminders</h5></center><hr>
                            <center><span id="no_reminders">You have no reminders!</span></center>
                             <ul class="collection">
                                <?php foreach($reminders as $rem){ ?> 
                                 
                                    <script>document.getElementById("no_reminders").style.display = 'none'; </script>
                                    <li class="collection-item avatar">
                                      <i class="material-icons circle blue">notes</i>
                                        <span class="title">Reminder - <b><?= $rem['reminder'] ?></b></span><br>        Username - <b><?= $rem['fname']." ".$rem['lname'] ?></b>                               
                                        <div class="right-align">
                                        <a href="<?= base_url(); ?>index.php/home/event/<?= $rem['event_id']*23 ?>" class="btn blue waves-effect waves-light">View</a>
                                        </div>
                                         
                                   
                                      
                                    </li>
                                <?php } ?>          
                                </ul>   
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                       
                    <label style="margin-right:25px">
                        <input type="checkbox" class="filled-in" value=1 id="until_log_in"/>                        
                    <span style="color:black">Do not display until next log in </span>
                    </label> 
                    
                  <a href="#!" class="modal-close waves-effect waves-light red btn">Close</a>
                </div>
              </div>
        <!--        End of Notifications Model -->
        
       
        
     
        
    </body>
   
    <script>
        $(document).ready(function(){
            $('.modal').modal();           
            
            //$('#modal1').modal('open');               
                          
            $('#until_log_in').change(function(){
                
                if (this.checked){
                    var value = $(this).val();                   
                }
                else {
                    var value = 0;                    
                }                                        

                $.ajax({
                     url:'<?=base_url()?>index.php/home/toggle_notifications',
                     method: 'post',
                     data: {value: value},
                     dataType: 'json',
                     complete: function(){M.toast({html: 'Saved', displayLength: 2000 });}
                });
            });
        
            $('#mark_read').change(function(){
                
                if (this.checked){
                    var value = $(this).val();                   
                }
                else {
                    var value = 0;                    
                }
                
                $.ajax({
                     url:'<?=base_url()?>index.php/home/mark_read',
                     method: 'post',
                     data: {value: value},
                     dataType: 'json',
                     complete: function(){
                         document.getElementById('mark_read').disabled = true;
                         document.getElementById("noti_badge").innerHTML = "0";
                         M.toast({html: 'Marked as read', displayLength: 2000 });
                         $('.notification_bar').css('background-color', '');
                         
                     }
                });
            });
            
            
        
        });
        
        
    </script>
</html>


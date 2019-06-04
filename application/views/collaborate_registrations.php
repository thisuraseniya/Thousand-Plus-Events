<html>
    <head>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/materialize.css"> 
        <title> Manage Events | Thousand Plus Events </title>
        <link rel="icon" href="<?php echo base_url(); ?>images/favicon.png" type="image/png"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
    </head>  
    
    <body>  
        
        
       
        
            
        <?php foreach($events as $val){ $event_id = $val['id']*23; ?>
        
        
        <div class="row">
           <div class="col s12 m3">  
                <div class="col s6 m12 center-align">
                    <h4><strong><?php echo $val['name']; ?></strong></h4><?php echo $val['date']; ?> <br>
                    <?php echo $val['time']; ?>
                    <br>&nbsp;
                </div>
                <div class="col s6 m12 center-align">
                    <img class="" src="<?php echo base_url().$val['pic']; ?>" width="100%" id="output" style="margin-top:20px">           
                </div>  
                <div class="col s12 left-align">                  
                    <div id="header">
                        <div id="header-inner"> 
                            <div class="row">
                                <ul class="section table-of-contents">
                                    Quick Links
                                    <li><a href="#crew">Crew</a></li>
                                    <li><a href="#tasks">Tasks</a></li>
                                    <li><a href="#rsvp">RSVP</a></li>
                                    <li><a href="#confirmed">Confirmed Participants</a></li>                                    
                                </ul>
                            </div>
                        </div>
                    </div>
               </div>

            </div>


            <div class="col s12 m9" style="margin-top:30px">

                <div class="row"> 
                    <a href="<?php echo base_url(); ?>index.php/collaborate" class="breadcrumb">My Collaborations</a>                      
                    <a href="" class="breadcrumb"><?php echo $val['name']; ?> - Registrations Department</a>                    
                </div>

                <div class="row">
                <div class="col s12 m5">
                    <div class="card col s12">
                        <a class="anchor" id="crew"></a>
                        <center><h5><strong>Crew</strong></h5></center><hr>                   
                       

                        <div>                                        
                            <div class="row">
                                <div class="col s12">
                                     <ul class="collection">     
                                       <?php foreach($crew as $val){ ?>


                                        <li class="collection-item avatar">
                                          <img src="<?php echo base_url().$val['pic']; ?>" alt="" class="circle materialboxed"><strong>
                                            <span class="title"><?php echo $val['fname']; ?> <?php echo $val['lname']; ?> </span></strong>
                                          <p><?php echo "<a style='color:darkblue' href='mailto:".$val['email']." '> ".$val['email']."</a>"; ?><br><?php echo $val['telephone']; ?>
                                          </p>
                                        
                                        </li>

                                         <?php } ?>
                                   </ul>
                                </div>                                 
                            </div>
                        </div>
                    </div>

 

                    <div class="card col s12 row">
                        <a class="anchor" id="rsvp"></a>
                        <center><h5><strong>RSVP</strong></h5><hr>  
                        You can send invites, get registration page link and confirm participants.</center><br>
                        <div class=" center-align">
                            <a class="waves-effect waves-light btn large modal-trigger green" href="<?=base_url()?>index.php/collaborate/rsvp/<?= $event_id ?> ">Manage RSVP's</a>                           
                            

                        </div><br>    
                                     
                    </div>                     
                </div>
                <div class="col s12 m7">
                    <div class="card col s12">
                        <a class="anchor" id="tasks"></a>
                        <center><h5><strong>Tasks</strong></h5></center><hr>                 
                        
                        <div class='row'>
                            <div class='col s12'>
                                    <ul class="collection with-header">
                                    <?php foreach($tasks as $t){ ?>
                                        <li class="collection-item">
                                            <div><?php echo $t['task_name']; ?>
                                          
                                                <a  class="secondary-content">
                                                     <label>
                                                    <?php if($t['assigned_to'] == $_SESSION['username'] || $t['completed_by'] == null || $t['completed_by'] == $_SESSION['username']) { ?>
                                                   
                                                    <input type="checkbox" class="ckbx filled-in" <?php if($t['completion']==1) {echo "checked";} ?>  value=1 id="<?php echo $t['id']; ?>" name="<?php echo $t['id']; ?>"/>
                                                    <span></span>
                                                    
                                                    <?php } else { ?>
                                                         <span>(completed)</span>
                                                         <?php } ?>
                                                         </label>
                                                </a>  
                                            </div>
                                            <hr>
                                            <div>
                                                <label>Currently assigned to</label>
                                                <select class="browser-default assigned_to" disabled>
                                                    <option value="" selected>Other / No one</option>
                                                    <?php foreach($crew as $m){
                                                        if ($t['assigned_to']==$m['username']){
                                                            $sel = "selected";
                                                            echo "<option ".$sel." value='". $m['username']."&".$t_id."'>".$m['fname']." ".$m['lname']."</option>";
                                                        }
                                                       
                                                        $t_id = $t['id']*23;
                                                        
                                                        }                                                         
                                                    ?>                                                    
                                                </select>     

                                            </div>
                                        </li>

                                    <?php } ?>
                                        </ul>


                            </div>                                 
                        </div>
                    </div>
                    <div class="card col s12">
                        <a class="anchor" id="confirmed"></a>                        
                        <center><h5><strong>Confirmed participants</strong></h5></center><hr>     
                        <div class="center-align col s12 m3">
                           <h6>Total - <?= $total; ?></h6>
                        </div>
                            <div class=" col s12 m9">
                                <button class="waves-effect waves-light btn green" id="send_all_attended">Send 'Thank You' emails to all attendees</button>      
                            </div>
                       <div class="col s12">
                         <hr>                          

                         <div class="row">        
                            <ul class="collapsible popout">
                            <?php foreach ($confirmed as $c){ ?>
                        
                            <li>
                                <div class="collapsible-header">
                                    <label>
                                        <input type="checkbox" class="cfckbx filled-in" <?php if($c['attended']==1) {echo "checked";} ?>  value=1 id="<?php echo $c['id']; ?>" name="<?php echo $c['id']; ?>"/>
                                        <span></span>
                                    </label><?= $c['name'] ?></div>
                                <div class="collapsible-body">
                                  <span>
                                      Email - <?= $c['email'] ?><br>
                                      Telephone - <?= $c['telephone'] ?><br>
                                      Address - <?= $c['address'] ?><br>
                                      
                                  </span>
                                </div>
                            </li>
                          
                           
                             

                        <?php } ?>
                           </ul>             
                          
                       
                        </div>
                       
                        </div>
                    </div>
                    </div>                       
                </div>
            </div>

                <?php } ?>


        </div> 
        
    </body>
    
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/materialize.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script>
        $(document).ready(function(){
            
            $('.collapsible').collapsible();
            $('.tooltipped').tooltip();
            $('.modal').modal();
            $('.materialboxed').materialbox();
            
            $('.datepicker').datepicker(
            {
                format: 'yyyy-mm-dd',
                maxDate: new Date()
            });   
            
            $('select').formSelect();
            
            $('#send_all_attended').click(function(){          
                document.getElementById("send_all_attended").disabled = true; 
                var event_id = <?= $id_passed ?>;
                $.ajax({
                     url:'<?=base_url()?>index.php/home/send_thankyou_emails_rsvp',
                     method: 'post',
                     data: {event_id: event_id},
                     dataType: 'json', 
                     complete:function(){                         
                         M.toast({html: 'Emails were successfully sent ', displayLength: 4000 });
                         document.getElementById("send_all_attended").disabled = false;
                        
                     },
                    });
            });

            $('.ckbx').change(function(){
                
                if (this.checked){
                    var value = $(this).val();
                    var msg = "'completed'";
                }
                else {
                    var value = 0;
                    var msg = "'incomplete'";
                }
                
                var id = this.getAttribute("name");                        

                $.ajax({
                     url:'<?=base_url()?>index.php/home/check_registrations',
                     method: 'post',
                     data: {id: id, value: value},
                     dataType: 'json',
                     complete: function(){M.toast({html: 'Marked as ' + msg, displayLength: 2000 });}
                    });
            });
            
            $('.cfckbx').change(function(){
                
                if (this.checked){
                    var value = $(this).val();
                    var msg = "'attended'";
                }
                else {
                    var value = 0;
                    var msg = "'not attended'";
                }
                
                var id = this.getAttribute("name");                        

                $.ajax({
                     url:'<?=base_url()?>index.php/home/check_attendance_registrations',
                     method: 'post',
                     data: {id: id, value: value},
                     dataType: 'json',
                     complete: function(){M.toast({html: 'Marked as ' + msg, displayLength: 2000 });}
                    });
            });

               
        });
    
    </script>
    <script src="<?php echo base_url(); ?>/js/scroll.js"></script>

    
</html>


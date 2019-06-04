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
                                    <li><a href="#invitation">Send Invitations</a></li>
                                    <li><a href="#response">Responses</a></li>
                                    <li><a href="#qr">Registration Page</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
               </div>

            </div>


            <div class="col s12 m9" style="margin-top:30px">                

                <div class="row"> 
                    <a href="<?php echo base_url(); ?>index.php/collaborate" class="breadcrumb">My Collaborations</a>                               
                    <a href="<?php echo base_url(); ?>index.php/collaborate/registrations/<?php echo $id_passed; ?>" class="breadcrumb"><?php echo $val['name']; ?> - Registrations Department</a>                                 
                    <a href="" class="breadcrumb">RSVP</a>                 
                </div>

                <div class="row">
                <div class="col s12 m5">
                    <div class="card col s12">
                        <a class="anchor" id="invitation"></a>                        
                        <center><h5><strong>Send Invitations</strong></h5><hr>                   
                            Please make sure to double check the emails since Thousand Plus Events ignores incorrect emails.</center>
                            <div class="input-field col s12">
                              <textarea id="emails" class="materialize-textarea"></textarea>
                              <label for="emails">Recipient email addresses (one email per line)</label>
                                <div class=" center-align">
                            <button class="waves-effect waves-light btn green" id="send_emails">Send</button>                             
                            <div class="progress input-field col s12 m9" id="progress_email" style="display:none">
                                <div class="indeterminate" ></div>
                            </div> 
                          
                            </div>   
                              
                           
                            </div>
                       

                        
                    </div>                   

                    <div class="card col s12 row">
                        <a class="anchor" id="qr"></a>
                        <center><h5><strong>Registration page</strong></h5><hr>    
                        Share this QR code or link in promotional materials to get people registered for the event.</center><br>
                        <div class="col s10 offset-s1 center-align">
                            <img src="https://chart.googleapis.com/chart?cht=qr&chl=<?= base_url()."index.php/rsvp/event/".md5($val['name'])."/".$id_passed ?>&chs=500x500&chld=M|0" width="100%"> <br><br>
                            <a class="btn green waves-effect waves-light" href="https://chart.googleapis.com/chart?cht=qr&chl=<?= base_url()."index.php/rsvp/event/".md5($val['name'])."/".$id_passed ?>&chs=500x500&chld=M|0"  download="QRcode">Download QR</a><br>&nbsp;
                        </div>
                        
                         <div class="col s12">
                            <div class="input-field col s12 center-align"> 
                                <i class="material-icons prefix"><a onclick="copyLink()" style="cursor:hand">content_copy</a></i>
                                    <input type="text" name="link" id="link" readonly style="cursor:text;font-size:8pt" value="<?= base_url()."index.php/rsvp/event/".md5($val['name'])."/".$id_passed ?>" >  
                                    <label for="tasks">Link</label>
                            
                             <a class="btn blue waves-effect waves-light" href="<?= base_url()."index.php/rsvp/event/".md5($val['name'])."/".$id_passed ?>" target="_blank">Visit</a>
                          </div>
                             
                        </div>
                    </div>                     
                </div>
                <div class="col s12 m7">
                    <div class="card col s12">
                        <a class="anchor" id="response"></a>                        
                        <center><h5><strong>Responses</strong></h5></center><hr>     
                        <div class="input-field col s12 m2">
                          <input value="<?= $target['target']; ?>" id="target" type="number">        
                            <label for="target">Target</label>
                        </div>
                        <div class="input-field col s12 m2">
                          <input value="<?= $current ?>" id="current" type="text" readonly>        
                            <label for="current">Current</label>
                        </div>                       
                        <div class="progress col s12 m8 input-field" style="margin-top:30px;height:10px">
                            <div class="determinate" id="progress_bar" style="width:<?php if($target['target']>0){ echo($current/$target['target']*100);}else{echo 0;} ?>%"></div>
                        </div>  
                        
                       <div class="col s12">
                           
                            <hr>
                             <div class="row">
                             <div class="center-align col s12">     
                                  <div class="right-align col s12 m3" style="margin-top:8px">
                            <label>
                                <input type="checkbox" class="filled-in" value=1 id="confirm_all"/>
                                <span>Confirm all</span>
                            </label>
                                 </div> 
                            <div class=" right-align col s12 m9">
                                <button class="waves-effect waves-light btn green" id="send_all_confirmed">Send emails to confirmed responses</button>      
                            </div>
                           </div>
                           </div>
                         <div class="row">        
                            <ul class="collapsible popout">
                            <?php foreach ($responses as $r){ ?>
                        
                            <li>
                                <div class="collapsible-header">
                                    <label>
                                        <input type="checkbox" class="ckbx filled-in" <?php if($r['confirmed']==1) {echo "checked";} ?>  value=1 id="<?php echo $r['id']; ?>" name="<?php echo $r['id']; ?>"/>
                                        <span></span>
                                    </label><?= $r['name'] ?></div>
                                <div class="collapsible-body">
                                  <span>
                                      Email - <?= $r['email'] ?><br>
                                      Telephone - <?= $r['telephone'] ?><br>
                                      Address - <?= $r['address'] ?><br>
                                      
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
            $('.collapsible').collapsible();
            
            $('.datepicker').datepicker(
            {
                format: 'yyyy-mm-dd',
                maxDate: new Date()
            });   
            
            $('select').formSelect();

            $('.ckbx').change(function(){
                
                if (this.checked){
                    var value = $(this).val();
                }
                else {
                    var value = 0;
                }
                
                var id = this.getAttribute("name");                        

                $.ajax({
                     url:'<?=base_url()?>index.php/home/check_registrations',
                     method: 'post',
                     data: {id: id, value: value},
                     dataType: 'json',
                     success: function(response){}
                    });
            });

            $('#send_emails').click(function(){
                
              
                var emails = $.trim($("#emails").val());  
                
                if (emails == "")
                {
                    M.toast({html: 'Provide valid email(s)', displayLength: 4000 });
                }
                else
                {
                    document.getElementById("send_emails").disabled = true;                              
                    document.getElementById("progress_email").style.display = "block"; 
                    $.ajax({
                         url:'<?=base_url()?>index.php/home/send_emails_rsvp',
                         method: 'post',
                         data: {emails: emails},
                         dataType: 'json', 
                         complete:function(){                         
                             document.getElementById("progress_email").style.display = "none";
                             M.toast({html: 'Emails were successfully sent ', displayLength: 4000 });
                             document.getElementById("send_emails").disabled = false;
                             $("#emails").val("");  
                         },
                        });
                }
                
                
            });
            
            $('#send_all_confirmed').click(function(){          
                document.getElementById("send_all_confirmed").disabled = true; 
                var event_id = <?= $id_passed ?>;
                $.ajax({
                     url:'<?=base_url()?>index.php/home/send_confirm_emails_rsvp',
                     method: 'post',
                     data: {event_id: event_id},
                     dataType: 'json', 
                     complete:function(){                         
                         M.toast({html: 'Emails were successfully sent ', displayLength: 4000 });
                         document.getElementById("send_all_confirmed").disabled = false;
                           
                     },
                    });
            });
            
            
            $('#target').change(function(){
                var target = $(this).val();
                var event_id = <?= $id_passed ?>;
                $.ajax({
                     url:'<?=base_url()?>index.php/home/set_target_rsvp',
                     method: 'post',
                     data: {target: target, event_id: event_id},
                     dataType: 'json', 
                     complete:function(){                         
                         var current = $('#current').val();
                         var width = (current/target)*100;                
                         $('#progress_bar').attr('style','width: ' + width + '%');
                         M.toast({html: 'Target set as ' + target, displayLength: 4000 });
                        },
                    }); 
                
                
            });
            
            $('.ckbx').change(function(){
                
                if (this.checked){
                    var value = $(this).val();
                    var msg = "confirmed";
                }
                else {
                    var value = 0;
                    var msg = "pending";
                }
                
                var id = this.getAttribute("name");                        

                $.ajax({
                     url:'<?=base_url()?>index.php/home/check_confirmation_rsvp',
                     method: 'post',
                     data: {id: id, value: value},
                     dataType: 'json',
                     complete: function(){M.toast({html: 'Marked as ' + msg, displayLength: 2000 });}
                    });
            });
            
            $('#confirm_all').change(function(){ 
                if (this.checked){
                    $('.ckbx').prop('checked', true); 
                    var event_id = <?= $id_passed ?>;
                    $.ajax({
                         url:'<?=base_url()?>index.php/home/check_all_confirmation_rsvp',
                         method: 'post',
                         data: {event_id: event_id},
                         dataType: 'json',
                         complete: function(){M.toast({html: 'All marked as \'confirmed\'', displayLength: 4000 });}
                    });
                }
               
               
            });
        });
        
        function copyLink() {         
            document.getElementById("link").select();         
            document.execCommand("copy");  
            M.toast({html: 'Link Copied ', displayLength: 1000 });
        }
     
    </script>
    <script src="<?php echo base_url(); ?>/js/scroll.js"></script>
    
   
</html>


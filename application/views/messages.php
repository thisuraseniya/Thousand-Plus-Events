<html>
<head>     
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/chat_style.css"> 
    <script src="<?php echo base_url(); ?>js/materialize.js"></script>  
    <title>Messages | Thousand Plus Events</title>
    <script>
//        function update_chat_people()
//            {
//                $.ajax({
//                     url:'<?=base_url()?>index.php/home/update_chat_people',
//                     method: 'post',
//                     data: {},                     
//                     success: function(data){                        
//                        $('#inbox_chat').append(data);
////                        $("#" + $("#send").val()).addClass("active_chat");      
//                     }
//                });
//            }
//        update_chat_people();
    </script>
</head>
<body>
<div class="" style="margin-top:0px">

<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
            </div>
            <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar"  placeholder="Search" >
                <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
            </div>
          </div>
          <div class="inbox_chat" id="inbox_chat">
<!--              add active_chat class to OUTERMOST div the one selected-->
            <?php foreach($chat_list as $list) { ?>
            <a href="#!" name="<?= $list['username'] ?>" class="people"> 
                <div class="chat_list" id="<?= $list['username'] ?>">
                  <div class="chat_people">
                    <div class="chat_img"> <img src="<?= base_url().$list['pic'] ?>" alt="pic" class="circle"> </div>
                    <div class="chat_ib">              
                      <h5><?= $list['fname']." ".$list['lname'] ?><span class="chat_date"><?= date('h:i A', strtotime($list['time'] )) ?> | <?= date('d M Y', strtotime($list['date'] )) ?></span></h5>
                      <p style="<?php if($list['seen']==0){echo 'font-weight:bold';} ?>"><?= $list['message'] ?></p>
                    </div>
                  </div>
                </div>
            </a>
            <?php } ?>  
      
              
          </div>
        </div>
        <div class="mesgs">
            <div class="col s12 center-align" style="margin-right:20px; margin-top:28%; display:none" id="spinner"> 
              <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue-only">
                  <div class="circle-clipper left">
                    <div class="circle"></div>
                  </div><div class="gap-patch">
                    <div class="circle"></div>
                  </div><div class="circle-clipper right">
                    <div class="circle"></div>
                  </div>
                </div>
              </div>
            </div>
          <div class="msg_history" id="msg_history">
              
            <div class="collection col s12 center-align" style="margin-right:20px">
                <a href="#!" class="collection-item green white-text strong">Select a chat from left pane to open</a>
            </div>
              
            
              
          </div>
          <div class="type_msg">
              <div class="row">
                <div class="col s12 m9 input-field">
                  <input type="text" id="msg">
                  <label for="msg">Type a message</label>
                </div>
                <div class="col s12 m3 input-field right-align">
                  <button class="btn waves-effect waves-light green" type="button" id="send">Send
                      <i class="material-icons right">send</i>
                  </button>
                <button class="btn waves-effect waves-light green" type="button" id="refresh" style="display:none">Refresh
                      <i class="material-icons right">send</i>
                  </button>
                </div>
              </div>
          </div>
        </div>
      </div>
      
 
    </div></div>
    </body>
    <script>
        $(document).ready(function(){
            var i;
            
            $(".people").click(function(){
                clearInterval(i);
                $('#msg_history').html('');
                $('#spinner').css('display', 'block');
                $(".chat_list").removeClass("active_chat");    
                var name = $(this).attr("name");                
                $("#" + name).addClass("active_chat");                 
                $("#send").val(name);                 
                $("#refresh").val(name);                 
                $("#msg").val('');                 
                 
                  
                $.ajax({
                     url:'<?=base_url()?>index.php/home/get_chat_history',
                     method: 'post',
                     data: {username: name},                     
                     success: function(data){                        
                         $('#spinner').css('display', 'none');
                         $('#msg_history').html(data);
                         $("#msg_history").animate({ scrollTop: $('#msg_history').prop("scrollHeight")}, 200);
                     }
                });
                
                i = window.setInterval(function(){
                    $("#refresh").click();
                }, 1000);
                
            });
            
            $(window).keydown(function(event){
                if(event.keyCode == 13 && document.activeElement.id == "msg") {
                  event.preventDefault();                
                  $("#send").click();                  
                }
            });
            
            $("#send").click(function(){
                if($.trim($("#msg").val()) != '' && $("#send").val() != '')
                {
                    var to = $("#send").val();             
                    var msg = $("#msg").val();             
                    
                    $.ajax({
                     url:'<?=base_url()?>index.php/home/insert_chat',
                     method: 'post',
                     data: {to: to, msg: msg},                     
                     success: function(data){                         
                         $("#msg").val('');            
                         $('#msg_history').append(data);
                         $('#' + to).children("p").val(msg);
                         alert($('#' + to).children("p").val());
                         $("#msg_history").animate({ scrollTop: $('#msg_history').prop("scrollHeight")}, 1000);
                         
                     }
                });
                }
            });
            
            $("#refresh").click(function(){  
                var name = $(this).val();
               
                $.ajax({
                    url:'<?=base_url()?>index.php/home/get_chat_history',
                    method: 'post',
                    data: {username: name},                     
                    success: function(data){ 
                        if($('#msg_history').html() != data )
                        {
                            $('#msg_history').html(data);                             
                            $("#msg_history").animate({ scrollTop: $('#msg_history').prop("scrollHeight")}, 1000);
                        }                                                  
                    }
                });               
            })
            
                    
                
                    
                
           
            
            
                
            
            
            
        });
    
    </script>
</html>
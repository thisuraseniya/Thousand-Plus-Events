
<html>
    <head>        
        <title>My Collaborations | Thousand Plus Events</title>
        
    </head> 
    
    <body> 
        <div class="row" style="margin-top:50px">
            <div class="col s12 m4">
                <div class="col s12 card">
                <center><h5>Find Events</h5>
                    Search through thousands of events where you can help organize.</center><hr>                  
                    <div class="row" style="margin-bottom:0">                    
                    <div class="input-field col s12">
                      <i class="material-icons prefix">search</i>
                      <input type="text" id="search_text" name="search_text">
                      <label for="search_text">Search Events</label>                        
                    </div>
                    </div> 
                    <div class="row">
                        <hr>
                        <div id="result" class="col s12"></div></div>
                </div>
                
            </div>
             <div class="col s12 m8">
                 <div class="col s12 card">
                    <center><h5>My Departments</h5></center>
                    <hr>
                    <center><span id="no_depts"><br>You are not currently collaborating in any event.<br> Use the searchbox on to your left to get started.</span></center><br>
                    
                               <div class="row">
                                <?php $count = 0 ; foreach($collab_depts as $col){ ?>
                                       
                                        <script>document.getElementById("no_depts").style.display = 'none'; </script>  
                                   
                                        <div class="col s12 m3">
                                          <div class="card">
                                            <div class="card-image">
                                              <img src="<?= base_url(); ?><?= $col['pic'] ?>">
                                             
                                            </div>
                                            <div class="card-content">
                                                <h6><b><?= ucfirst($col['dept_name']) ?> Department</b></h6><?= $col['name'] ?>
                                            </div>
                                            <div class="card-action right-align">
                                              <a class="btn blue waves-light waves-effect" href="<?= base_url(); ?>index.php/collaborate/<?= $col['dept_name']?>/<?= $col['event']*23 ?>">Visit</a>
                                            </div>
                                          </div>
                                        </div>  
                                        
                                <?php  if($count == 3){echo "</div><div class='row'>"; $count = 0; }else{$count++;} }  ?>
                     </div> 
                               
                </div>
                <div class="col s12 card">
                    <center><h5>My Tasks</h5></center>
                    <hr>
                    <center><span id="no_collab"><br>All caught up! <br>You have no tasks assigned to you yet.</span></center><br>
                    
                              <div class="col s12 m6"  >    
                                <?php $c2 = count($collaborations); $c = 0; foreach($collaborations as $noti){
                                        ?>
                                        <script>document.getElementById("no_collab").style.display = 'none'; </script>
                                        
                                            <ul class="collection">
                                                <li class="collection-item avatar" <?php if($noti['completion'] == 0) {?> style="background-color:rgba(3, 201, 0, 0.1) " <?php } ?>  >
                                                  <i class="material-icons circle green">notifications</i>
                                                    <span class="title">Task '<b><?= $noti['task_name'] ?></b>' has been assigned to you.</span><br>

                                                    <div class="right-align">
                                                        <a href="<?= base_url(); ?>index.php/collaborate/<?= $noti['dept_name'] ?>/<?= $noti['event']*23 ?>" style="margin-top:5px" class="btn green waves-effect waves-light">View
                                                            </a>
                                                    </div>

                                                </li>
                                            </ul> 
                                        
                                <?php if($c + 2 > $c2/2){echo '</div><div class="col s12 m6">'; $c=0;}else{$c++;} } ?>
                                  </div>
                               
                </div>
            </div>
        </div>
         
     
        
    </body>
    <script src="<?php echo base_url(); ?>js/materialize.js"></script>
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script>
        $(document).ready(function(){
            $("#collab").addClass("active");
            $("#collab_2").addClass("active");
            
            function load_data(name){    
                $.ajax({
                    url:"<?php echo base_url(); ?>index.php/collaborate/search_events",
                    method:"POST",
                    data:{name:name},
                    success:function(data){
                        $('#result').html(data);
                    }
                });
             }
            
            $('#search_text').keyup(function(){

                var search = $(this).val();
                if(search != '')
                {
                    load_data(search);
                }
                else
                {
                    load_data();
                }
            });
            
             $('.collapsible').collapsible();
           
        
        });
        
        
        
        
    </script>
</html>


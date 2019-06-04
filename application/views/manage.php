<html>
    <head>
        
        <title> Manage Events | Thousand Plus Events </title>
        <link rel="icon" href="<?php echo base_url(); ?>images/favicon.png" type="image/png"> 
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/materialize.css"> 
       
    
    </head>  
    
    <body>  
        
         
         
            
               
            <div class="row" style="margin-top:50px">  
                <div class="col s12 center-align" id="no_event" style="margin-bottom:38vh">
                    <div class="collection">
                        <a href="<?=  base_url() ?>index.php/home/create" class="collection-item red white-text strong">You do not have any event added.<br> Click <u>here</u> to add one.</a>
                    </div>
                 </div>
                
                 <?php  $x = 0; 
                    foreach($events as $val){ ?>
                <script>$("#no_event").attr("hidden", "hidden");</script>
                    <div class="col s10 offset-s1 m3">
                      <div class="card">
                        <div class="card-image">
                          <img src='<?php echo base_url();?><?php echo $val["pic"]; ?>' width='100%'  >
                                  
                          <span class="card-title black"> <?php echo $val['name']; ?>  </span>
                        </div>
                        <div class="card-content">
                          <?php echo $val['type']; ?> <br> <?php echo $val['date']; ?>  <br>  <?php echo $val['time']; ?> <br><br> <?php echo $val['description']; ?>
                        </div>
                        <div class="card-action right-align">
                            
                            <a class="waves-effect waves-light btn modal-trigger red" href="#modal<?php echo $val['id']*23; ?>">Delete</a>
                            
                            <a href="<?php echo base_url();?>index.php/home/event/<?php echo $val['id']*23; ?> " class='btn green waves-effect waves-light'>View Event</a>
                                
                         
                        </div>
                          
                      </div>
                    </div>
                    
                    
                    <div id="modal<?php echo $val['id']*23; ?>" class="modal">
                        <div class="modal-content center-align">
                          <h4>Are you sure you want to delete?</h4>
                           <p>- This action can NOT be undone - </p>
                            
                        </div>
                        
                        <div class="modal-footer">
                            <button class='btn green modal-close waves-effect waves-light'>Cancel</button>
                            <a href="<?php echo base_url();?>index.php/home/delete_event/<?php echo $val['id']*23; ?>" class='btn red modal-close  waves-effect waves-light'>Yes, Delete</a>
                        </div>
                        
                    </div>
                  
                     

                    <?php   if($x < 3)
                            {
                                $x = $x + 1;
                            } 
                            else
                            {
                                echo "</div><div class='row'>";
                                $x = 0 ;
                            }
                                                    } ?>
                     

               
                    
             
                
                
       
        
        </div>
        
            
    </body>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/materialize.js"></script>
    
    <script>
        $(document).ready(function(){
            $("#manage").addClass("active");
            $("#manage_2").addClass("active");
            $('.modal').modal();
        });
    </script>
</html>


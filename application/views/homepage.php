
<html>
    <head>        
        <title>Home | Thousand Plus Events</title>       
    </head>  
    
    <body>        
        
            <div class="row">
                
             <div class="row" style="margin-top:50px">
                
                 <div class="col s10 offset-s1 center-align" <?php if($_SESSION['name'] != 'Welcome User!'){echo "hidden";} ?> >
                    <div class="collection">
                        <a href="<?=  base_url() ?>index.php/home/profile" class="collection-item red white-text strong">Your Profile is not complete. Click here to fix this</a>
                    </div>
                 </div>
                 
                <div class="col s10 offset-s1 m2">
                    <a href="<?=  base_url() ?>index.php/home/create" class="blue-text">
                  <div class="card">
                    <div class="card-image">
                      <img src='<?=  base_url() ?>images/categories/IT.jpg'>

                    </div>

                    <div class="card-action center-align">
                       <b>
                            <a href="<?=  base_url() ?>index.php/home/create" class="blue-text">Create event</a>
                        </b>
                    </div>
                  </div>
                    </a>
                </div>

                <div class="col s10 offset-s1 m2">
                    <a href="<?=  base_url() ?>index.php/home/manage" class="blue-text">
                  <div class="card">
                    <div class="card-image">
                      <img src='<?=  base_url() ?>images/categories/edit.jpg'>

                    </div>

                    <div class="card-action center-align">
                       <b>
                            <a href="<?=  base_url() ?>index.php/home/manage" class="blue-text">View Events</a>
                        </b>
                    </div>
                  </div>
                    </a>
                </div>
                 
                  <div class="col s10 offset-s1 m2">
                    <a href="<?=  base_url() ?>index.php/collaborate" class="blue-text">
                  <div class="card">
                    <div class="card-image">
                      <img src='<?=  base_url() ?>images/categories/collab.jpg'>

                    </div>

                    <div class="card-action center-align ">
                      <b>
                            <a href="<?=  base_url() ?>index.php/collaborate" class="blue-text">Collaborate </a>
                        </b>
                    </div>
                  </div>
                    </a>
                </div>

                <div class="col s10 offset-s1 m2">
                    <a href="<?=  base_url() ?>index.php/home/profile" class="blue-text">
                  <div class="card">
                    <div class="card-image">
                      <img src='<?=  base_url() ?>images/categories/profile.jpg'>

                    </div>

                    <div class="card-action center-align">
                      <b>
                            <a href="<?=  base_url() ?>index.php/home/profile" class="blue-text">My Profile</a>
                        </b>
                    </div>
                  </div>
                    </a>
                </div>
                <div class="col s10 offset-s1 m2">
                    <a href="<?=  base_url() ?>index.php/vendors" class="blue-text">
                  <div class="card">
                    <div class="card-image">
                      <img src='<?=  base_url() ?>images/categories/vendor.png'>

                    </div>

                    <div class="card-action center-align">
                        <b>
                            <a href="<?=  base_url() ?>index.php/home/search" class="blue-text">Vendors</a>
                        </b>
                    </div>
                  </div>
                    </a>
                </div>   

                <div class="col s10 offset-s1 m2">
                    <a href="<?=  base_url() ?>index.php/collaborate" class="blue-text">
                  <div class="card">
                    <div class="card-image">
                      <img src='<?=  base_url() ?>images/categories/search.jpg'>

                    </div>

                    <div class="card-action center-align">
                        <b>
                            <a href="<?=  base_url() ?>index.php/collaborate" class="blue-text">Search</a>
                        </b>
                    </div>
                  </div>
                    </a>
                </div>   
              </div>        
        </div>
<!--
        
        <div class="fixed-action-btn">
          <a class="btn-floating btn-large red">
            <i class="large material-icons">mode_edit</i>
          </a>
          <ul>
            <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
            <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
            <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
            <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
          </ul>
        </div>
-->
        
     
        
    </body>
    <script src="<?php echo base_url(); ?>js/materialize.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    
    <script>
        $(document).ready(function(){
            
            $("#homepage").addClass("active");
            $("#homepage_2").addClass("active");
            $('.fixed-action-btn').floatingActionButton();
            $('.modal').modal();
            $(".dropdown-trigger").dropdown();
            
            if (<?= $_SESSION['reminder_toggle']; ?>){
                $('#modal_notifications').modal('open'); 
                
            }       
        });
        
        
    </script>
</html>


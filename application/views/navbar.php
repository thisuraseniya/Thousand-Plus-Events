<!--        Navbar     -->
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
</head>
        
        
       
  
        <ul id="dropdown1" class="dropdown-content">
            
            <li id="profile"><a href="<?=  base_url() ?>index.php/home/profile" class="nav-page">My Profile</a></li>
            <li class="divider"></li>
            <li><a href="<?=  base_url() ?>index.php/home/logout" class="nav-page">Log out</a></li>  
            
        </ul>
        <ul id="dropdown2" class="dropdown-content">
            
            <li id="manage"><a href="<?=  base_url() ?>index.php/home/manage" class="nav-page" >View Events</a></li> 
            <li class="divider"></li>
            <li id="create"><a href="<?=  base_url() ?>index.php/home/create" class="nav-page current">Create New</a></li>  
            
        </ul>
        
        <div class="navbar-fixed">            
            <nav>
              <div class="nav-wrapper">
                  <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="fas fa-bars blue-text"></i></a>
                  <a href="<?=  base_url() ?>index.php/home/homepage" class="brand-logo"><img src="<?=  base_url() ?>/images/logo1.png" height="80%" style="margin-top:2%;"></a>                
                  <ul class="right hide-on-med-and-down">
                      <li id="homepage"><a href="<?=  base_url() ?>index.php/home/homepage" class="nav-page">Home</a></li>
                      <li id="collab"><a href="<?=  base_url() ?>index.php/collaborate" class="nav-page">Collaborations</a></li>
                      <li id="vendors"><a href="<?=  base_url() ?>index.php/vendors" class="nav-page">Vendors</a></li>    
                      <li><a class="dropdown-trigger" href="#!" data-target="dropdown2">My Events<i class="material-icons right">arrow_drop_down</i></a></li>
                      <li><a class="modal-trigger" href="#modal_notifications"><i class="fa fa-bell"></i><span class="new badge red" style="vertical-align:80%" id="noti_badge"><?= $_SESSION['noti_count'] ?></span></a></li>
                      <li><a class="modal-trigger" href="<?=  base_url() ?>index.php/home/messages"><i class="fa fa-comment-alt"></i><span class="new badge blue" style="vertical-align:80%" id="msg_badge"><?= $_SESSION['noti_count'] ?></span></a></li>
                      <li><img src="<?= base_url(); ?><?= $_SESSION['pic']; ?>" alt="" class="circle" height="80%" style="margin-top:10%; margin-left:10px; margin-right:5px"></li> 
                      <li ><a class="dropdown-trigger" href="#!" data-target="dropdown1"><?= $_SESSION['name']; ?><i class="material-icons right">arrow_drop_down</i></a></li>                       
                  </ul>
              </div>
            </nav>             
        </div> 

      
<!--       Navbar end     -->


<ul id="slide-out" class="sidenav">
    <li><div class="user-view">
      <div class="background">
        <img src="<?=  base_url() ?>images/login_back.jpg" width="100%">
      </div>
      <a href="#!"><img class="circle" src="<?= base_url(); ?><?= $_SESSION['pic']; ?>" style="border:2px solid #ffffff"></a>
      <a href="#!"><span class="white-text name">&nbsp;</span></a>
      <a href="#!"><span class="white-text name">&nbsp;</span></a>
      
    </div></li>
    <li id="homepage_2"><a href="<?=  base_url() ?>index.php/home/homepage" class="nav-page">Home</a></li>
    <li id="collab_2"><a href="<?=  base_url() ?>index.php/collaborate" class="nav-page">Collaborations</a></li>      
    <li id="vendors_2"><a href="<?=  base_url() ?>index.php/vendors" class="nav-page">Vendors</a></li>               
    <li id="manage_2"><a href="<?=  base_url() ?>index.php/home/manage" class="nav-page" >View My Events</a></li> 
    <li id="create_2"><a href="<?=  base_url() ?>index.php/home/create" class="nav-page current">Create New Event</a></li>     
    <li id="profile_2"><a href="<?=  base_url() ?>index.php/home/profile" class="nav-page">My Profile</a></li>
    <li><a class="modal-trigger" href="#modal_notifications">Notifications<span class="new badge red" style="vertical-align:80%" id="noti_badge"><?= $_SESSION['noti_count'] ?></span></a></li>
    <li class="divider"></li>
    <li><a href="<?=  base_url() ?>index.php/home/logout" class="nav-page">Log out</a></li>  
  </ul>  


 <script>
    $(document).ready(function(){
        $('.sidenav').sidenav();
        $('.modal').modal();
        $(".dropdown-trigger").dropdown();
    });
     
     $("#homepage, #homepage_2, #collab, #collab_2, #vendors, #vendors_2, #profile, #profile_2, #manage, #manage_2, #create, #create_2").click(function(){
         $("#overlay").css("display", "block"); 
     });
</script>


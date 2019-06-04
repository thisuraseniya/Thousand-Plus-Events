<html>
  <head>
    <title>Vendors</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>     
      #map {
        height: 50%;
      }
     
    </style>
  </head>
  <body>
      
      <div class="row"  style="margin-top:50px">
        <div class="col s12">
            <div class="col s12 m3"><img src="<?= base_url().$view_business['pic'] ?>" width="100%"></div>  
            <div class="col s12 m5">
                <a style="font-size:50px"><?= $view_business['name'] ?></a><br>&nbsp;
                <?= $view_business['category'] ?><hr>
                Address - <b><?= $view_business['address'] ?></b><br>
                Telephone - <b><?= $view_business['telephone'] ?></b><br>
                Open from <b><?= date('h:i A', strtotime($view_business['open'])) ?></b> to <b><?= date('h:i A', strtotime($view_business['close'])) ?></b><br>
            </div>  
            <div class="col s12 m4 right-align"><div id="map"></div><br><a href="https://www.google.com/maps/search/<?= str_replace ( "/", "%2F", $view_business['address'], $count ) ?>/@<?= $view_business['lat'] ?>,<?= $view_business['lon'] ?>,14z" class="btn blue waves-effect waves-light" target="_blank">open in google maps</a></div> 
            
           
        </div>
      </div>
      
      
    <script src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>js/materialize.js"></script>  
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3ylkdwUlblwMdOgXSFfcd92uqgDfBKAo&callback=initMap">
        </script>
    <script>     
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: <?= $view_business['lat'] ?>, lng: <?= $view_business['lon'] ?>},
          zoom: 13  
        });
          
        marker = new google.maps.Marker({
                            position: {lat: <?= $view_business['lat'] ?>, lng: <?= $view_business['lon'] ?>},
                            map: map,
                            draggable: false
                        });
      }

     
    </script>
    
  </body>
</html>
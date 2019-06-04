
<html>
    <head>        
        <title>My Collaborations | Thousand Plus Events</title>
        
    </head> 
    
    <body> 
        <div class="row" style="margin-top:50px">
            <div class="col s12 m4">
                <div class="col s12 card">
                <center><h5>Find Vendors</h5>
                    Search through thousands of vendors whom you can get products and services from.</center><hr>
                     <div class="row" style="margin-bottom:0">                    
                    <div class="input-field col s12">
                      <i class="material-icons prefix">search</i>
                      <input type="text" id="search_text" name="search_text" placeholder="Search">
                      <label for="search_text">Search Vendors by name, category or location</label>                        
                    </div>
                    </div> 
                    <div class="row">
                        <hr>
                        <div id="result" class="col s12"></div></div>
                </div>
                
            </div>
             <div class="col s12 m4">
                 <div class="col s12 card">
                    <center><h5>My Businesses</h5></center>
                    <hr>
                    <center><span id="no_busi"><br>You do not have any businesses registered in our system.</span></center><br>
                    
                               <div class="row">
                                <?php  foreach($businesses as $b){ ?>
                                    <script>document.getElementById("no_busi").style.display = 'none'; </script>  
                                   
                                    <div class="col s12">
                                      
                                        <div class="card horizontal">
                                          <div class="card-image">
                                            <img src="<?= base_url().$b['pic'] ?>">
                                          </div>
                                          <div class="card-stacked">
                                            <div class="card-content">
                                               <p style="font-size:24px"><?= $b['name']; ?></p>
                                                    <?= $b['category']; ?><br><hr>
                                                    <?= $b['address']; ?>                                  
                                            </div>
                                            <div class="card-action right-align">
                                                <a href="<?= base_url()."index.php/vendors/delete_business/".($b['id']*23) ?>" class="btn red waves-effect waves-light">Delete</a>
                                              <a href="<?= base_url()."index.php/vendors/view/".($b['id']*23) ?>" class="btn green waves-effect waves-light">View</a>
                                              
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                        
                                <?php   }  ?>
                     </div> 
                               
                </div>
                
            </div>
            
            <div class="col s12 m4">
                 <div class="col s12 card">
                    <center><h5>Register Business</h5></center>
                    <hr>
                <form method="post">
                    <div class="input-field col s12">
                        <input id="name" name="name" type="text" class="validate" required>
                        <label for="name">Name of the Business*</label>
                    </div>
                    <div class="input-field col s12">
                        <select name="type" required>
                          <option value="" disabled selected>Select Type</option>
                            <option value="Caterer">Caterer</option> 
                            <option value="Electronic">Electronic</option>
                            <option value="Grocery">Grocery Store</option>
                            <option value="Hardware">Hardware</option>
                            <option value="Photography">Photography</option>
                            <option value="Supermarket">Supermarket</option>
                            <option value="Transport">Transport</option>                   
                            <option value="Venue">Venue</option>                   
                        </select>
                        <label>Business Type*</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="tele" name="telephone" type="text" class="validate">
                        <label for="tele">Telephone</label>
                    </div>
                    <div class="input-field col s12">
                      <textarea id="address" name="address" class="materialize-textarea" required></textarea>
                      <label for="address">Address*</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="open" name="open" type="text" class="timepicker">
                        <label for="open">Opening Time</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="close" id="close" class="timepicker">
                        <label for="close">Closing Time</label>
                    </div>
                    <div class="input-field col s12">
                        <label>Select Location<br>&nbsp;</label>
                    </div>
                        <input type="text" id="lat" name="lat" readonly="yes" hidden>
                        <input type="text" id="lng" name="lng" readonly="yes" hidden>
                     <div class="input-field col s12">
                        <div id="map"></div>
                    </div>
                   
                  
                    <div class="input-field col s12 right-align">
                        <button type="submit" value="add_vendor" name="add_vendor" id="add_vendor" class="btn green waves-effect waves-light">Add Business</button>
                    </div>
                </form>
                   
        <script>     

            var map;
            var marker = false; 

            function initMap() {     
                var centerOfMap = new google.maps.LatLng(7.9458846, 80.8053701);

                var options = {
                  center: centerOfMap, 
                  zoom: 7 
                };

                map = new google.maps.Map(document.getElementById('map'), options);

                google.maps.event.addListener(map, 'click', function(event) {        
                    var clickedLocation = event.latLng;

                    if(marker === false){                   
                        marker = new google.maps.Marker({
                            position: clickedLocation,
                            map: map,
                            draggable: true 
                        });

                        google.maps.event.addListener(marker, 'dragend', function(event){
                            markerLocation();
                        });
                    } else{

                        marker.setPosition(clickedLocation);
                    }

                    markerLocation();
                });
            }     

            function markerLocation(){           
                var currentLocation = marker.getPosition();

                document.getElementById('lat').value = currentLocation.lat(); 
                document.getElementById('lng').value = currentLocation.lng(); 
            }        
            google.maps.event.addDomListener(window, 'load', initMap);
        </script>
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3ylkdwUlblwMdOgXSFfcd92uqgDfBKAo&callback=initMap">
        </script>
                               
                </div>
               
            </div>
        </div>
         
     
        
    </body>
   
    <script></script>
    <script src="<?php echo base_url(); ?>js/materialize.js"></script>
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script>
        $(document).ready(function(){
            $("#vendors").addClass("active");
            $("#vendors_2").addClass("active");
            
            $('select').formSelect();
            $('.timepicker').timepicker({
                twelveHour: false
            });    
            function load_data(name){    
                $.ajax({
                    url:"<?php echo base_url(); ?>index.php/vendors/search_vendors",
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
           
             <?php
    
                if(isset($_GET['category']))
                {
                    $cat = $_GET['category'];
                    echo "load_data('$cat');";
                    echo "$('#search_text').val('$cat');";
                }
            ?>
            
        });
        
        
        
        
    </script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 80%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
</html>




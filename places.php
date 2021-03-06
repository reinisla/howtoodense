<html>

<div class="test"></div>

<head>
    <meta charset="UTF-8">
    <title>How to Odense</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
       <script>
        function highlightStar(obj,id) {
            removeHighlight(id);        
            $('#stars-'+id+' li').each(function(index) {
                $(this).addClass('highlight');
                if(index == $('#stars-'+id+' li').index(obj)) {
                    return false;   
                }
            });
        }

        function removeHighlight(id) {
            $('#stars-'+id+' > ul > li').removeClass('selected');
            $('#stars-'+id+' > ul > li').removeClass('highlight');
        }

        function addRating(obj,id) {
            $('#stars-'+id+' li').each(function(index) {
                $(this).addClass('selected');
                $('#stars-'+id+' #rating').val((index+1));
                if(index == $('#stars-'+id+' li').index(obj)) {
                    return false;   
                }
            });
            $.ajax({
                url: "add_rating.php",
                data:'id='+id+'&rating='+$('#stars-'+id+' #rating').val(),
                type: "POST"
            });
        }

        function resetRating(id) {
            if($('#stars-'+id+' #rating').val() != 0) {
                $('#stars-'+id+' li').each(function(index) {
                    $(this).addClass('selected');
                    console.log($('input#rating').val())
                    if((index+1) == $('#stars-'+id+' input#rating').val()) {
                        return false;   
                    }
                });
            }
        } 
        </script>
        <script type="text/javascript">
                function xmlParse(str) {
                if (typeof ActiveXObject != 'undefined' && typeof GetObject != 'undefined') {
                    var doc = new ActiveXObject('Microsoft.XMLDOM');
                    doc.loadXML(str);
                    return doc;
                }

                if (typeof DOMParser != 'undefined') {
                    return (new DOMParser()).parseFromString(str, 'text/xml');
                }

                return createElement('div', null);
            }
            var infoWindow = new google.maps.InfoWindow();
            var customIcons = {
                Heidis: {
                    icon: 'http://maps.google.com/mapfiles/ms/icons/blue.png'
                },
                AustralianBar: {
                    icon: 'http://maps.google.com/mapfiles/ms/icons/green.png'
                },
                AirPub: {
                    icon: 'http://maps.google.com/mapfiles/ms/icons/yellow.png'
                },
                LaBar: {
                    icon: 'http://maps.google.com/mapfiles/ms/icons/red.png'
                },
                OldIrish: {
                    icon: 'http://maps.google.com/mapfiles/ms/icons/purple.png'
                },
                Gap: {
                    icon: 'http://maps.google.com/mapfiles/ms/icons/pink.png'
                }
               
            };

            var markerGroups = {
                "Heidis": [],
                "AustralianBar": [],
                "AirPub": [],
                "LaBar": [],
                "OldIrish": [],
                "Gap": []

            };

            function load() {
                var map = new google.maps.Map(document.getElementById("map"), {
                    center: new google.maps.LatLng(55.394474, 10.381611),
                    zoom: 14,
                    mapTypeId: 'roadmap',
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                  scrollwheel: false,
                navigationControl: false,
                mapTypeControl: false,
                scaleControl: false,
                draggable: true,
                  zoomControlOptions: {
                     position: google.maps.ControlPosition.LEFT_BOTTOM
                  }
                });
                var infowindow = new google.maps.InfoWindow({
                  maxWidth: 160
                });



                

                //         downloadUrl("markers.xml", function (data) {
                var xml = xmlParse('<markers><marker name="Heidis Bier Bar" address="Vestergade 75" lat="55.394474" lng="10.381611" type="Heidis"  /><marker  name="Australian Bar" address="Brandts Passage 10" lat="55.395193" lng="10.381279" type="AustralianBar" /><marker name="Air Pub" address="Kongensgade 41" lat="55.397093" lng="10.381265" type="AirPub" /><marker name="La Bar" address="Vintapperstræde 51" lat="55.395805" lng="10.383671" type="LaBar" /><marker name="Old Irish Pub" address="Vintapperstræde 4" lat="55.395436" lng="10.383604" type="OldIrish" /><marker name="The Gap" address="Klingenberg 14" lat="55.394799" lng="10.387061" type="Gap" /></markers>');

                // var xml = data.responseXML; 
                var markers = xml.documentElement.getElementsByTagName("marker");
                for (var i = 0; i < markers.length; i++) {
                    var name = markers[i].getAttribute("name");
                    var address = markers[i].getAttribute("address");
                    var type = markers[i].getAttribute("type");

                    var point = new google.maps.LatLng(
                    parseFloat(markers[i].getAttribute("lat")),
                    parseFloat(markers[i].getAttribute("lng")));
                    var html = "<b>" + name + "</b> <br/>" + address;
                    
                    // var icon = customIcons[type] || {};
                    var marker = createMarker(point, name, address, type, map);
                    bindInfoWindow(marker, map, infoWindow, html);
                   
                }
                // });
            }

            function createMarker(point, name, address, type, map) {
                var icon = customIcons[type] || {};
                var marker = new google.maps.Marker({
                    map: map,
                    position: point,
                    icon: icon.icon,
                    // shadow: icon.shadow,
                    type: type
                });
                if (!markerGroups[type]) markerGroups[type] = [];
                markerGroups[type].push(marker);
                var html = "<b>" + name + "</b> <br/>" + address;
                var web = "http://mmdprojects.com/howtoodense/"+ type + ".html";
                bindInfoWindow(marker, map, infoWindow, html);
                bindInfoWindow2(marker,web);
                marker.setVisible(false);
                return marker;
            }

            function toggleGroup(type) {
                for (var i = 0; i < markerGroups[type].length; i++) {
                    var marker = markerGroups[type][i];
                    if (!marker.getVisible()) {
                        marker.setVisible(true);
                    } else {
                        marker.setVisible(false);
                    }
                }
            }


            function bindInfoWindow(marker, map, infoWindow, html) {
                google.maps.event.addListener(marker, 'mouseover', function () {
                    infoWindow.setContent(html);
                    infoWindow.open(map, marker);

                });
                
                
            }
             function bindInfoWindow2(marker,web) {
                google.maps.event.addListener(marker, 'click', function () {
                window.location = web;

                });
            }

            function downloadUrl(url, callback) {
                var request = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest();

                request.onreadystatechange = function () {
                    if (request.readyState == 4) {
                        request.onreadystatechange = doNothing;
                        callback(request, request.status);
                    }
                };

                request.open('GET', url, true);
                request.send(null);
            }

            function doNothing() {}
            google.maps.event.addDomListener(window, 'load', load);
            </script>
</head>

<body>
    <!--Header-->
    <?php
    require_once("dbcontroller.php");
    $db_handle = new DBController();
    $query ="SELECT * FROM ratings";
    $result = $db_handle->runQuery($query);
?>
    <header id="header" class="alt">
    <div id='navmenu'>
        <ul>
            <li ><a href='index.html'><span>Home</span></a></li>
           <li ><a href='places.php'><span>Places</span></a>
           <ul>
               <li><a href='places.php'><span>Clubs/Pubs</span></a></li>
               <li><a href='places.php'><span>Food</span></a></li>
              <li> <a href='places.php'><span>Outdor</span></a></li>
              <li> <a href='places.php'><span>Culture/Parks</span></a></li>
           </ul>
           </li>
           <li><a href='index.html'><span>About</span></a></li>
           <li><a href='index.html'><span>Contact</span></a></li>
           <li class='last'><a href='login.php'><span>Login</span></a></li>
        </ul>
    </div>
</header>
<!--Banner-->
            <section id="mapsbanner">
            <div id="map"></div>

            <div id="buttonwrapper" >
            <ul>
            <li><button class="mapbutton" type="button"  onclick="toggleGroup('Heidis')  "><img src="img/23.jpg" ><h2>Heidis</h2><h3>20:00 - 02:00</h3></button></li>
            <li><button class="mapbutton" type="button" onclick="toggleGroup('AustralianBar')" ><img src="img/23.jpg" ><h2>Australian Bar</h2><h3>20:00 - 05:00</h3></button></button></li>
            <li><button class="mapbutton" type="button"  onclick="toggleGroup('AirPub')" > <img src="img/23.jpg" ><h2>Air Pub</h2><h3>20:00 - 12:00</h3></button></li>
            <li><button class="mapbutton" type="button"  onclick="toggleGroup('LaBar')" > <img src="img/23.jpg" ><h2>La Bar</h2><h3>20:00 - 06:00</h3></button></li>
            <li><button class="mapbutton" type="button"  onclick="toggleGroup('OldIrish')" > <img src="img/23.jpg" ><h2>Old Irish Pub</h2><h3>5:00 - 02:00</h3></button></li>
            <li><button class="mapbutton" type="button"  onclick="toggleGroup('Gap')" > <img src="img/23.jpg" ><h2>The Gap</h2><h3>20:00 - 04:00</h3></button></li>
          
            </ul>
            </div>

            
            </section>


    <!--categories-->



    <div id="feat">

        <ul>
           
             <?php
                    if(!empty($result)) {
                        $i=0;
                        foreach ($result as $place) {
                ?>
            <div class="figure box">
                <li>
                    <a href="#"><img src="img/23.jpg"></a>
                </li>
                <p>
                    <h3 class="feed_title"><?php echo $place["title"]; ?></h3>
                    
                    <div id="stars-<?php echo $place["id"]; ?>">
                            <input name="rating" id="rating" value="<?php echo $place["rating"]; ?>" />
                            <ul onMouseOut="resetRating(<?php echo $place["id"]; ?>);">
                              <?php
                              for($i=1;$i<=5;$i++) {
                                  $selected = "";
                                  if(!empty($place["rating"]) && $i<=$place["rating"]) {
                                    $selected = "selected";
                                  }
                              ?>
                              <li class='<?php echo $selected; ?>' onmouseover="highlightStar(this,<?php echo $place["id"]; ?>);" onmouseout="removeHighlight(<?php echo $place["id"]; ?>);" onClick="addRating(this,<?php echo $place["id"]; ?>);">&#9733; 
                              </li>  
                              <?php }  ?>
                              <?php echo $place["reviews"]; ?> reviews
                            </ul>
                    </div>
                        
                    
                    <p><?php echo $place["description"]; ?></p>
                </p>
            </div>
                            <?php       
                    }
                    }
                ?>

        </ul>
    </div>



    <!--see more-->

    <div class="button-wrapper">
        <a class="button cta-button" href="#">seemore</a>
    </div>



    <!--footer-->
    <footer class="footer">

        <p class="content">Bad decisions make better stories</p>

        <p class="footer-links">
            <a href="places.php">Places</a> ·
            <a href="index.html">About</a> ·
            <a href="index.html">Contact</a> ·
            <a href="index.html">Login</a>
        </p>
        <p class="copy">RBGK &copy; 2015</p>
    </footer>
</body>

</html>
<?php
    require_once("dbcontroller.php");
    $db_handle = new DBController();
    $query ="SELECT * FROM ratings";
    $result = $db_handle->runQuery($query);
?>

<html>

<div class="test"></div>

<head>
    <meta charset="UTF-8">
    <title>How to Odense</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    
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
    
</head>

<body>
    <!--Header-->
    <header id="header" class="alt">
        <div id='navmenu'>
                        <ul>
                <li><a href='index.html'><span>Home</span></a></li>
                <li><a href='places.html'><span>Places</span></a></li>
                        <li><a href='index.html'><span>About</span></a></li>
                <li><a href='index.html'><span>Contact</span></a></li>
                        <li class='last'><a href='index.html'><span>Login</span></a></li>
            </ul>
        </div>
    </header>
    <!--Banner-->
    <section id="banner">
        <h2>google map</h2>
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
            <a href="index.html">Places</a> ·
            <a href="index.html">About</a> ·
            <a href="index.html">Contact</a> ·
            <a href="index.html">Login</a>
        </p>
        <p class="copy">RBGK &copy; 2015</p>
    </footer>
</body>

</html>
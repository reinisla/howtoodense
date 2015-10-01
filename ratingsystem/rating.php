<?php
    require_once("dbcontroller.php");
    $db_handle = new DBController();
    $query ="SELECT * FROM ratings";
    $result = $db_handle->runQuery($query);
?>

<html>
    <head>
        <title>PHP Dynamic Star Rating using jQuery</title>
        <link href="style.css" rel="stylesheet">

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


                <?php
                    if(!empty($result)) {
                        $i=0;
                        foreach ($result as $place) {
                ?>
                    <div class="box">
                        <h2 class="feed_title"><?php echo $place["title"]; ?></h2>
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
                            <ul>
                        </div>

                        <p><?php echo $place["description"]; ?></p>
                    </div>
                <?php		
                    }
                    }
                ?>


    </body>
</html>
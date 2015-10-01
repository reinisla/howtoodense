<?php
if(!empty($_POST["rating"]) && !empty($_POST["id"])) {
    require_once("dbcontroller.php");
    $db_handle = new DBController();
    $id = $_POST['id'];
    
    
    $reviews ="UPDATE ratings SET reviews = reviews + 1 WHERE id='$id'";
    $result = $db_handle->updateQuery($reviews);
    
    $sum ="UPDATE ratings SET sum = sum +'" . $_POST["rating"] . "'WHERE id='$id'";
    $result = $db_handle->updateQuery($sum);
    
    $query = mysql_query("SELECT * FROM ratings WHERE id='$id'");
    while($row = mysql_fetch_array($query))
    {
        $count = $row['sum'];
        $divide = $row['reviews'];
    }
    
    $average = $count/$divide;
    $av = round($average, 0);
                         
    $queryy ="UPDATE ratings SET rating = '$av' WHERE id='$id'";
    $result = $db_handle->updateQuery($queryy);
}
?>
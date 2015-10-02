<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>How to Odense</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</head>

<body>


<!--Header-->
<header id="header" class="alt">
    <div id='navmenu'>
        <ul>
            <li ><a href='index.html'><span>Home</span></a></li>
           
           <li ><a href='places.html'><span>Places</span></a>
           <ul>
               <li><a href='places.html'><span>Clubs/Pubs</span></a></li>
               <li><a href='places.html'><span>Food</span></a></li>
              <li> <a href='places.html'><span>Outdor</span></a></li>
              <li> <a href='places.html'><span>Culture/Parks</span></a></li>
           </ul>
           </li>
           <li><a href='index.html'><span>About</span></a></li>
           <li><a href='index.html'><span>Contact</span></a></li>
           <li class='last'><a href='index.html'><span>Login</span></a></li>
        </ul>
    </div>
</header>

       <div class="register-form">
<h2>Register</h2>
<form action="" method="POST">
    <p><label>User Name : </label>
    <input id="username" type="text" name="username" placeholder="username" /></p>
    
    <p><label>E-Mail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </label>
     <input id="password" type="email" name="email"/></p>
 
     <p><label>Password&nbsp;&nbsp; : </label>
     <input id="password" type="password" name="password" placeholder="password" /></p>
 
    <a class="btn" href="login.php">Login</a>
    <input class="btn register" type="submit" name="submit" value="Register" />
    </form>
</div>
<?php
    require('connect.php');
    // If the values are posted, insert them into the database.
    if (isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
 
        $query = "INSERT INTO `users` (username, password, email) VALUES ('$username', '$password', '$email')";
        $result = mysql_query($query);
        if($result){
            $msg = "User Created Successfully.";
        }
    }
    ?>
    </div>
</header>
  
            
            



<!--footer-->
<footer class="footer">

            <p class="content">Bad decisions make better stories</p>

            <p class="footer-links">
                <a href="index.html">Places</a>
                ·
                <a href="index.html">About</a>
                ·
                <a href="index.html">Contact</a>
                ·
                <a href="index.html">Login</a>
            </p>
            <p class="copy">RBGK &copy; 2015</p>
        </footer>


</body>

</html>





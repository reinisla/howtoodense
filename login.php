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
<?php  //Start the Session
session_start();
require_once("connect.php");
//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['username']) and isset($_POST['password'])){
//3.1.1 Assigning posted values to variables.
$username = $_POST['username'];
$password = $_POST['password'];
//3.1.2 Checking the values are existing in the database or not
$query = "SELECT * FROM `users` WHERE username='$username' and password='$password'";
 
$result = mysql_query($query) or die(mysql_error());
$count = mysql_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
if ($count == 1){
$_SESSION['username'] = $username;
}else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
echo "Invalid Login Credentials.";
}
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['username'])){
$username = $_SESSION['username'];
header('Location: http://mmdprojects.com/howtoodense/index.html');
//this function is missing logout function, and we know killing session is stupid
session_destroy(); 
}else{}
//3.2 When the user visits the page first time, simple login form will be displayed.
?>

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
<?php
	if(isset($msg) & !empty($msg)){
		echo $msg;
	}
 ?>

<h2>Login</h2>
<form action="" method="POST">
    <p><label>User Name : </label>
	<input id="username" type="text" name="username" placeholder="username" /></p>
 
     <p><label>Password&nbsp;&nbsp; : </label>
	 <input id="password" type="password" name="password" placeholder="password" /></p>
 
    <a class="btn" href="register.php">Signup</a>
    <input class="btn register" type="submit" name="submit" value="Login" />
    </form>
</div>

            
           



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


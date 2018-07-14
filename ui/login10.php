 
 <?php
session_start();
?>
<?php
    $nameErr =$passErr="";
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } 
  
if (empty($_POST["password"])) {
    $passErr = "Password is required";
  } 
}
    
 ?>
<?php
if(isset($_SESSION['usr_id'])!="") {
	
}

//check if form is submitted

	if(isset($_REQUEST["submit"])){
         echo "hello";
$names=$_REQUEST["name"];
$passwordS=$_REQUEST["password"];

$servername = "localhost";
$username = "pushpa";
$password = "1234";
$dbname = "bsnl";

$conn = mysql_connect($servername, $username, $password);

if(!$conn )
{
die('Could not connect: ' . mysql_error());
}

$connection=mysql_select_db("library",$conn);
echo "established";

       $result = mysql_query("SELECT * FROM users",$conn);

	while($row = mysql_fetch_array($result)) {
            $a=$row['userid'];
            $b=$row['password'];
            $c=$row['types'];
              if($names==$a and $passwordS==$b){
                  if($c=='student'){
               $_SESSION['username']=$a;
               header("Location:student1.php");
		}
                  if($c=='admin'){
                      $_SESSION['username']=$a;
               header("Location:admin.php");
                  }
              }
        
else {
		$errormsg = "Incorrect name or Password!!!";
	}

	
 }
}
?>
<html>
<head>
<title> login form design</title>
<link rel="stylesheet" type="text/css" href="style.css">  
<link rel="stylesheet" type="text/css" href="buttons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
 <body>
    <button onclick="goBack()" >&#8249;</button>
    <button onclick="goForward()" >&#8250;</button>
    <button onclick="goHome()" class="btn"><i class="fa fa-home"></i> Home</button>

    <script>
      function goBack() {
        window.history.back();
      }
    </script>
    <script>
     function goForward() {
      window.history.forward();
    }
    </script>
        <script>
     function goHome() {
      window.open('index20.html',"_self")
    }
    </script>


			              
<form role="form" method="post" name="loginform">
				
	<div class="loginbox">
		<img src="pic2.png" class="pic2">
		<h1>Login Here</h1>
		
			<p>User Name</p>
			<input type="text" name="name" placeholder="Enter Username">
<span class="error"> <?php echo $nameErr;?></span>
        <center><p id="demo" style="color:red;"></p></center>
			<p>Password</p>
			<input type="password" name="password" placeholder="Enter Password">
  <span class="error"> <?php echo $passErr;?></span>

        <input type="submit" name="submit" value="Login">
			<a href="register2.php">Don't have an acount?</a>

    </div>
</form>		
<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span> 
    
	</body>



</html>
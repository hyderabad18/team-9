<?php
// define variables and set to empty values
$nameErr = $emailErr = $rollErr= $branchErr= $phoneErr= $passErr=$numerr =$cmpErr=$valErr="";
$name = $email = "";
$check=0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } 
  if (empty($_POST["rollno"])) {
    $rollErr = "Rollno is required";
  } 
  if (empty($_POST["branch"])) {
    $branchErr = "Branch is required";
  } 
  if (empty($_POST["email-id"])) {
    $emailErr = "Email is required";
  } 
  if (empty($_POST["phone"])) {
    $phoneErr = "Number is required";
  } 
  if (empty($_POST["pass"])) {
    $passErr = "Password is required";
  } 
  if (empty($_POST["retype"])) {
    $reErr = "Password is required";
  } 
$x=$_POST["pass"];
$y=$_POST["retype"];
  if(!(strcmp($x,$y))){
   $cmpErr="";
}
else{
$cmpErr="Please enter the same password as above";
    $check=1;
}
 /* if (strlen($_POST["phone"]) == 10) 
  {
   $isPhoneNum = true;
  }
  else{
$numerr="Please enter valid 10 digits";
}*/
     // $phone is valid
  if(preg_match('/^[0-9]{10}$/', $_POST['phone']))
    {
      $numerr='';
      echo "hello";
    }
    else{
        $check =1;
        $numerr = 'Please enter only digits';
    }
    
    if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $_POST['pass'])) {
    $valErr= 'The password does not meet the requirements!';
        $check=1;
}
 


}
if(isset($_SESSION['usr_id'])!="") {
	
}
//check if form is submitted

if(isset($_REQUEST["submit"])){
        // echo "hello";
$names=$_REQUEST["name"];
$rolls=$_REQUEST["rollno"];
$branches=$_REQUEST["branch"];
$emails=$_REQUEST["email-id"];
$phones=$_REQUEST["phone"];
$passw=$_REQUEST["pass"];
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
$result = mysql_query("SELECT userid FROM users",$conn);

	while($row = mysql_fetch_array($result)) {
            $a=$row['userid'];
              if($rolls==$a){
                $flag=1;
                //$errormsg = "This Id already exits please enter a new one!!!";
               echo "<script language='javascript'>confirm('This userid already exits Please login now ')</script>";
               break;
		}
   else {
	$flag=0;	

	}	
 }
if($flag==0){
    if($check==1){
         echo "<script language='javascript'>confirm('Please fill the fields properly ')</script>";

    }
    else{

      $sql = "INSERT INTO `users`(`userid`, `name`, `passw`, `dept`, `mobile`, `mail`, `cards`, `types`) VALUES ('$rolls','$names','$password','$branches',$phones,'$emails',6,'student')";
      echo "Inserted";
    mysql_query($sql,$conn);
    }
    
   }
    }
?>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="style3.css">
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


    
    
<form method="post">
<div class="rloginbox">
    		<img src="pic2.png" class="pic2">

    <h1>Register Here</h1>
    <p>**Fill all the details</p><br>
    <br>
    <p>Name</p><input type="text" name="name" placeholder="Enter Name" required>
    <span class="error"><?php echo $nameErr;?></span>
    <center><p id="demo" style="color:red;"> </p></center>

 <br>
 <br>
    <p>Roll no</p><input type="text" name="rollno" placeholder="Enter rollno" required>
    <span class="error"><?php echo $rollErr;?></span>
 <br>
 <br>
  Branch:<input type="text" name="branch" placeholder="Enter Branch" required>
    <span class="error"> <?php echo $branchErr;?></span>
 <br>
 <br>

 Email-id:<input type="email"  name="email-id" placeholder="Enter email-id" required>
<span class="error"> <?php echo $emailErr;?></span>

 <br>
 <br>
 Phone number:<input type="text" name="phone" placeholder="Enter phone-no" required>
    <span class="error"> <?php echo $numerr;?></span>
 <br>
 <br>
Password:<input type="password" name="pass" placeholder=" Enter Password" required>
    <span class="error"><?php echo $passErr;?></span>
    <span class="error"><?php echo $valErr;?></span>
 <br>
 <br>
Re-type Password:<input type="password" name="retype" placeholder="Re-type password" required>
    <span class="error"> <?php echo $cmpErr;?></span>
 <br>
 <br>
<center>
 <input type="submit" name="submit">
 <br>
 <br>
    </center>
    
</div>
    </form>
</body>
</html>
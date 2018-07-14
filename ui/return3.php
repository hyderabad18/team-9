

<?php
if(isset($_SESSION['usr_id'])!="") {
	
}

//check if form is submitted

	if(isset($_REQUEST["Return"])){
        // echo "Hello";

$user=$_REQUEST["UserId"];
$book=$_REQUEST["BookId"];


$servername = "localhost";
$username = "pushpa";
$password = "1234";
$dbname = "library";

$conn = mysql_connect($servername, $username, $password);

if(!$conn )
{
die('Could not connect: ' . mysql_error());
}

$connection=mysql_select_db("library",$conn);
$sql = "UPDATE `books` SET `status`='available'  where bookid=('$book')";
    mysql_query($sql ,$conn);
  $result = mysql_query( "SELECT dor  FROM  books WHERE bookid='$book' ");
$row = mysql_fetch_assoc($result);
            $a=$row['dor'];
echo $a;
$d= date("Y-m-d");
//echo $d;
 $diff = abs(strtotime($d) - strtotime($a));
$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

$diff=printf("%d years, %d months, %d days\n", $years, $months, $days);
$b=$months*30;
$b=$days+$b;
echo $b;
$diff=$b*1;


$sql = "UPDATE `books` SET `userid`='' WHERE `bookid`='$book' ";
        mysql_query($sql,$conn);
      // echo "updated";
$sql1 = "UPDATE books  SET  doi='0000-00-00'  where bookid='$book' ";
        mysql_query($sql1,$conn);
      // echo "updated";
$sql1 = "UPDATE books  SET  dor='0000-00-00'  where bookid='$book' ";
        mysql_query($sql1,$conn);


echo   "<script >confirm('Fine to be paid $diff ')</script>";
      //     "Fine to be paid". $diff;
       
}
?>
<html>


<head>
 <title>Return Book</title>
     <link rel="stylesheet" type="text/css" href="style.css">
     <link rel="stylesheet" type="text/css" href="mystyle.css">

</head>
 <body style="background-image: url('library-3.jpg')">
<div class="sign">
      <a href="login10.php" class="login">Previous</a>
      <a href="register2.php" class="Sign-up">Next</a>

      </div>


<form role="form" method="post" name="return">

<div  class="loginbox">
    		<h1>Return Book</h1>
    
 <p>UserId</p><input type="text" name="UserId" placeholder="UserId" required></input>
 <br>
 <br>
<p>BookId</p><input type="text" name="BookId" placeholder="BookId" required></input>
 <br>
 <br>
    <p>Title</p><input type="text" name="Title" placeholder="Title" required></input>
 <br>
 <br>
 <input type="submit" name="Return" value="Return"></input>
 <br>
 <br>
</div>
</body>
</html>



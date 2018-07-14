<?php
if(isset($_SESSION['usr_id'])!="") {
	
}
//check if form is submitted

	if(isset($_REQUEST["add"])){
        // echo "hello";
        $tid=$_REQUEST["id"];
$users=$_REQUEST["username"];
$authors=$_REQUEST["author"];
$keys=$_REQUEST["key"];
$adds=$_REQUEST["add"];
$rack='A5';

$servername = "localhost";
$username = "pushpa";
$password = "1234";


$conn = mysql_connect($servername, $username, $password);

if(!$conn )
{
die('Could not connect: ' . mysql_error());
}

$connection=mysql_select_db("library",$conn);
//echo "established";
$flag=0;
$result = mysql_query("SELECT bookid FROM books",$conn);

	while($row = mysql_fetch_array($result)) {
            $a=$row['bookid'];
              if($tid==$a){
               //$_SESSION['usr_id']!="$names";
               $flag=1;
//$errormsg = "This Id already exits please enter a new one!!!";
               echo "<script language='javascript'>confirm('This titleId already exits ')</script>";
               break;
		}
else {
	$flag=0;	

	}

	
 }
if($flag==0){
        $sql = "INSERT INTO books(`bookid`, `title`, `author`, `rackno`, `keyword`) VALUES ('$tid','$users','$authors','$rack','$keys')";
//echo "Inserted";
    mysql_query($sql,$conn);
    }
    }
?>

<html>

<head>
 <title>Add Book</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<div class="sign">
      <a href="admin.php" class="login">Previous</a>
      <a href="admin.php" class="Sign-up">Home</a>

      </div>

<div class="heading">
   <p>SMART LIBRARY</p>
  </div>
    <div class="marquee">
    <marquee>GNITS LIBRARY</marquee>
    </div>


<form method="post">
<div class="loginbox">
    <h1>Add Book</h1>
 <p>Title Id</p><input type="text" name="id" placeholder="titleId" required></input>
 <br>
 <br>

 <p>Title</p><input type="text" name="username" placeholder="Title" required></input>
 <br>
 <br>
    <p>Author</p><input type="text" name="author" placeholder="Author" required></input>
 <br>
 <br>
 <p>Keyword</p><input type="text" name="key" placeholder="Keyword" required></input>
 <br>
 <br>
 <input type="submit" name="add" value="Add">
 <br>
 <br>
</form>
<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
</div>
</body>
</html>
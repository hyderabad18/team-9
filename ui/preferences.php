<?php
session_start();
?>
<?php
//check if form is submitted        
$key=$_SESSION["keyword"];

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
$sql = "SELECT DISTINCT title FROM books,keyword WHERE books.keyword=keyword.keyword AND books.keyword='$key'";
$result=mysql_query($sql,$conn);
while($row = mysql_fetch_array($result)) {
                 $x=$row['title'];
                 //$_SESSION['title']=$x;
                echo "<a href='predef4.php?id=$x'>";

}
    
?>

<html>
<body>

    </body>
</html>
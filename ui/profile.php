<html>
<head>
      <link rel="stylesheet" type="text/css" href="profilestyle.css">
    <style>
       body{
	margin: 0;
	padding: 0;
	background: url(library-4.jpg) repeat;
	background-position: center;
    background-size: cover;
	background-position: center;
	font-family: sans-serif;
    color:black;
    margin-top:20px;
    font-size: 30px;
    margin-left: 20px;
}

input[type="text"]{ 
        text-align:center;
        font-size: 16px;
        color:black;
        background-color:lightgoldenrodyellow;
      }

    </style>

    </head>
</html>
<?php
session_start();
?>
<?php
    //echo "hello";
    $userid=$_SESSION["username"];
   // echo $userid;
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
//echo "established";

$sql="SELECT * FROM users where userid='$userid'";
 $result=mysql_query($sql,$conn);
$row = mysql_fetch_array($result);
                   echo "Username &nbsp; &nbsp; &nbsp; &nbsp; :<input type='text' value='$row[userid]'/>"."<br>"."<br>";
                   echo "Name &nbsp;&nbsp;&nbsp;&nbsp;:<input type='text' value='$row[name]'/>"."<br>"."<br>";
                   echo "Department &nbsp;&nbsp;:<input type='text' value='$row[dept]'/>"."<br>"."<br>";
                   echo "Cards :<input type='text' value='$row[cards]'/>"."<br>"."<br>";         

?>
<!DOCTYPE html>
<html>
<head>
<style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 80%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #4CAF50;
    color: white;
}
</style>
</head>
<body>

<table id="customers">
  <tr>
    <th>Bookid</th>
    <th>Title</th>
    <th>Author</th>
    <th>Status</th>
    <th>Date of issue</th>
    <th>Date of return</th>
    <th>Fine</th>
  </tr>
    <?php
    $sql = "SELECT bookid,title,author,status,doi,dor FROM books where userid='$userid'";
    $result=mysql_query($sql,$conn);


    //if ($result->num_rows > 0) {
    // output data of each row
    while($row = mysql_fetch_array($result)) {
        
        $val=strcmp($row['doi'],"0000-00-00");
        if($val==0){
            
            $iss="-";
        }
        else{
            $iss=$row['doi'];
        }
        
        $val=strcmp($row['dor'],"0000-00-00");
        if($val==0){
            $ret="-";
        }
        else{
            $ret=$row['dor'];
        }
        
        
        
        
        
        
        echo "<tr><td>" . $row['bookid']. "</td><td>" . $row['title']."</td><td>". $row['author']."</td><td>" . $row['status']."</td><td>" . $iss."</td><td>" . $ret."</td></tr>";
        
    }

//} else {
 //   echo "0 results";
//}

  ?>
    </table>
    <br>
    <br>
    <br>

</body>
</html>

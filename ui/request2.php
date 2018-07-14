<?php
session_start();
?>

<html>
<head>
 <title>Request</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
    
<body>
<?php
    $userid=$_SESSION["username"];
    echo $userid;
	if(isset($_REQUEST["req"])){
       $titles=$_REQUEST["title"];
       echo $titles;
       $d= date("Y-m-d");
       echo $d;
    
//$d1 =date('Y-m-d',strtotime($d.'+15 days'));
        
     /*   <center>
    <button onclick="cancel()" >Cancel</button>
        </center>
        function cancel(){
            echo Cancel;
        }*/
        /*if($titles==$a  && $b=="available"){ 
                    $flag=0;
                    break;
		      }
              else if($titles==$a){
                  $flag=1;
                  break;
              }*/
             
$flag=-1;
        $res=-1;
$servername = "localhost";
$username = "pushpa";
$password = "1234";
$dbname = "library";
$conn = mysql_connect($servername, $username, $password);

if(!$conn )
{
die('Could not connect: ' . mysql_error());
}

echo $userid;
$connection=mysql_select_db("library",$conn);
echo "established";
        $found=0;
$result = mysql_query("SELECT title,userid FROM request",$conn);        
while($row = mysql_fetch_array($result)) {
            $a=$row['title'];
            $b=$row['userid'];
              if($titles==$a  && $b==$userid){ 
                    $found=1;
                    echo "<script language='javascript'>confirm('You have already placed a request for this book.')</script>";
                    break;
		      }
              else{
                  $found=0;
              }
}
if($found==0){
$result = mysql_query("SELECT title,status,bookid FROM books",$conn);
	while($row = mysql_fetch_array($result)) {
            $a=$row['title'];
            if($titles==$a){
                $check=1;
                break;
             }
              else{
                 $check=0;
             }   
         }
    if($check==1){
        mysql_data_seek($result, 0);
       while($row = mysql_fetch_array($result)) {
            $a=$row['title'];
            $b=$row['status'];
            $res=$row['bookid'];
            if($titles==$a  && $b=="available"){
                    $flag=0;
                    break;
            }   
            else{
                   $flag=1;
                }   
            }
       }
    
     if($check==0){
            echo "<script language='javascript'>confirm('Please enter a valid book name.')</script>";  
        }
    echo $res;
    
        if($flag==0){
            $sql = "UPDATE `books` SET `status`='reserved' WHERE `bookid`='$res' ";
            mysql_query($sql,$conn);
            $sql = "UPDATE `books` SET `userid`='$userid' WHERE `bookid`='$res' ";
            mysql_query($sql,$conn);
            $sql = "INSERT INTO `reserve`(`userid`, `title`, `date`, `bookid`) VALUES ('$userid','$titles','$d','$res')";
        

           // $sql="INSERT INTO `reserve` (`userid`, `title`, `date`, 'bookid') VALUES ('$userid', '$titles', '$d','$res')";
                mysql_query($sql,$conn);
                        echo "entered";



            echo "<script language='javascript'>confirm('This book is successfully reserved for you . ')</script>";    
            
        }
        if($flag==1){
         
            $sql="INSERT INTO `request` (`userid`, `title`, `date`) VALUES ('$userid', '$titles', '$d','$res')";
           
            mysql_query($sql,$conn);
            echo "Inserted";

             echo "<script language='javascript'>confirm('Your request has been received and the status can be   ')</script>";
        }
     }
}
    
    
    if(isset($_REQUEST["cancel"])){
        $titles=$_REQUEST["title"];
        echo $titles;
        $servername = "localhost";
        $username = "pushpa";
        $password = "1234";
        $dbname = "library";
        $conn = mysql_connect($servername, $username, $password);
        if(!$conn )
         {
            die('Could not connect: ' . mysql_error());
         }
        echo $userid;
        $connection=mysql_select_db("library",$conn);
        echo "established";        
        $result = mysql_query("SELECT title,userid FROM request",$conn);
	    while($row = mysql_fetch_array($result)) {
            $a=$row['title'];
            $b=$row['userid'];
              if($titles==$a  && $b==$userid){ 
                    $flag=0;
                    break;
		      }
              else{
                  $flag=1;
              }
            
         }
        if($flag==0){
            $sql = "DELETE FROM `request` WHERE `userid`= '$userid' AND `title`='$titles' ";
            mysql_query($sql,$conn);
            echo "<script language='javascript'>confirm('This book is cancelled ')</script>";
        }
        if($flag==1){
            echo "<script language='javascript'>confirm('This book is not reserved for you . ')</script>";    
        }

    }
?>
<div class="heading">
   <p>SMART LIBRARY</p>
  </div>
    <div class="marquee">
    <marquee>GNITS LIBRARY</marquee>
    </div>
    

<form>
    
<div class="loginbox">
    <h1>Request Book</h1>
 <p>Title:</p><input type="text" name="title" placeholder="Enter Title" required>
 <br>
 <br>

 
 
 <input type="submit" name="req" value="Request">
 <input type="submit" name="cancel" value="Cancel">

    <br>
 <br>
</div>
    </form>
</body>
</html>
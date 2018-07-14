<?php
session_start();
?>

<?php
    $userid=$_SESSION["username"];
    echo $userid;
	if(isset($_REQUEST["req"])){
       $titles=$_REQUEST["title"];
       echo $titles;
       $d= date("Y-m-d");
       echo $d;
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
        $res = mysql_query("SELECT title,userid FROM request where title='$titles' and userid='$userid' ",$conn);   
        $n=mysql_num_rows($res);
        echo $n;
        if($n==1){
                   echo "<script language='javascript'>confirm('You have already placed a request for this book.')</script>";
		      }
              else{
        //Case to check the number of avilable books
            $sql = "SELECT * FROM `availability` WHERE title='$titles' ";
            $res=mysql_query($sql,$conn);
            $row = mysql_fetch_assoc($res);
            $num=$row['available'];
            echo $num;
            if($num>0){
             echo "Books are available in the library.....So please issue them directly";      
            }
            else{
                $sql = "INSERT INTO `request`(`userid`, `title`, `service`, `date`) VALUES ('$userid','$titles','requested','$d')";
                mysql_query($sql,$conn);
                echo "Inserted";
                
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
        $n=0;
         $res = mysql_query("SELECT title,userid,service FROM request where title='$titles' and userid='$userid' ",$conn);
        while($row = mysql_fetch_array($res)) {
                $services=$row['service'];
            $n=$n+1;
            }
         //echo $email;

         //$n=mysql_num_rows($res);
         echo $n;
         if($n==1){
            $sql = "DELETE FROM `request` WHERE `userid`= '$userid' AND `title`='$titles' ";
            mysql_query($sql,$conn);
            
            //Modification starts here....
            if($services=='granted'){
            $sql = "UPDATE `availability` SET `available`=available+1 WHERE `title`='$titles'";
              mysql_query($sql,$conn);
              echo "updated100";
                
                $sql = "UPDATE `users` SET `cards`=cards+1 WHERE `userid`='$userid'";
                mysql_query($sql,$conn);
    
            }

                
            echo "<script language='javascript'>confirm('You have successfully cancelled your placed request....')</script>";
		      }
              else{
                  echo "<script language='javascript'>confirm('You have never placed a request!!! . ')</script>";
              }  
        
            }
    
?>
<html>
<head>
 <title>Request</title>
  <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="buttons.css">


</head>
    
<body>
    <button onclick="goBack()" >&#8249;</button>
    <button onclick="goForward()" class="forward">&#8250;</button>
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
      window.open('student1.php',"_self")
    }
    </script>

    

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
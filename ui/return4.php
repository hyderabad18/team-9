
<?php
//check if form is submitted

  if(isset($_REQUEST["Return"])){
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
    $sql = "SELECT dor FROM `books` WHERE `bookid`=$book ";
     $result=mysql_query($sql ,$conn);
     $row = mysql_fetch_assoc($result);
      //We are fetching the return date value and storing in $a.
     $a=$row['dor'];
      //We are fetching the current date into $d1.
     $d1=date('y-m-d',time());
       //echo "\n".$d1;
     $dt1=date_create($a);
     $dt2=date_create($d1);
     $dd=date_diff($dt1,$dt2);      
  //echo "    ";
//   echo $dd->format('%y , %m  ,%d ');
//echo "  ";
     $years=$dd->format('%y');
//echo $years;

     $mon=$dd->format('%m');
//echo $mon;

     $days=$dd->format('%d');
//echo $days;

//Calculating total number of days

    $days=$days+$mon*30;
    $days=$days+($years*365);
        if($days<=15){
            echo   "<script >confirm('No fine is to be paid')</script>";

        }
        else{

           $diff=$days*2;

           echo "Fine to be paid". $diff;
            echo   "<script >confirm('Fine to be paid $diff ')</script>";
      //     "Fine to be paid". $diff;
        }

      
      $sql = "UPDATE `books` SET `userid`='' WHERE `bookid`='$book' ";
        mysql_query($sql,$conn);
      // echo "updated";
     $sql1 = "UPDATE books  SET  doi='0000-00-00'  where bookid='$book' ";
        mysql_query($sql1,$conn);
      // echo "updated";
     $sql1 = "UPDATE books  SET  dor='0000-00-00'  where bookid='$book' ";
        mysql_query($sql1,$conn);

     $sql = "UPDATE `users` SET `cards`=cards+1 WHERE `userid`='$user'  ";
        mysql_query($sql,$conn);

        
    }

?>
<html>

 <head>
  <title>Return Book</title>
     <link rel="stylesheet" type="text/css" href="style.css">
     <link rel="stylesheet" type="text/css" href="mystyle.css">

 </head>
 <body style="background-image: url('library-3.jpg')">
    <button onclick="goBack()" >Go Back</button>
        <button onclick="goForward()" class="forward">Go Forward</button>

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

     <form role="form" method="post" name="return">

          <div  class="loginbox">
    		<h1>Return Book</h1>
    
            <p>UserId</p><input type="text" name="UserId" placeholder="UserId" required>
 <br>
 <br>
            <p>BookId</p><input type="text" name="BookId" placeholder="BookId" required>
 <br>
 <br>
            <p>Title</p><input type="text" name="Title" placeholder="Title" required>
 <br>
 <br>
            <input type="submit" name="Return" value="Return">
 <br>
 <br>
         </div>
     </form>
 </body>
</html>





<?php
if(isset($_SESSION['usr_id'])!="") {
	
}

//check if form is submitted

	if(isset($_REQUEST["Issue"])){
        // echo "Hello";

$user=$_REQUEST["UserId"];
//echo $user;
$book=$_REQUEST["BookId"];
//echo $book;
$titles=$_REQUEST["Title"];
        echo $titles;
 $d= date("Y-m-d");
 //echo $d;
$d1 =date('Y-m-d',strtotime($d.'+15 days'));

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
echo "established"; 
        
        //Case including the request
        $sql = "SELECT userid FROM `request` WHERE title='$titles' and userid='$user' and service='granted' ";
        $res=mysql_query($sql,$conn);
        $n=mysql_num_rows($res);
        echo $n;
    
        if($n==1){
            //Reserved person issue code...
            echo "can issue";
            $sql1 = "UPDATE books  SET  status='issued'  where bookid='$book' ";
              mysql_query($sql1,$conn);
      // echo "updated";
              $sql = "UPDATE `books` SET `userid`='$user' WHERE `bookid`='$book' ";
              mysql_query($sql,$conn);
      // echo "updated";
              $sql1 = "UPDATE books  SET  doi='$d'  where bookid='$book' ";
              mysql_query($sql1,$conn);
      // echo "updated";
              $sql1 = "UPDATE books  SET  dor='$d1'  where bookid='$book' ";
              mysql_query($sql1,$conn);
        // echo "updated";
       //echo "retrived";
              echo "<script language='javascript'>confirm('Book is issued ')</script>";
              $sql = "DELETE FROM `request` WHERE `userid`='$user' and `title`='$titles'";
              mysql_query($sql,$conn);
              echo "del";
     
              
           

              
                      
        }
        else{
            //Case to check the number of avilable books
            $sql = "SELECT * FROM `availability` WHERE title='$titles' ";
            $res=mysql_query($sql,$conn);
            $row = mysql_fetch_assoc($res);
            $num=$row['available'];
            echo $num;
            if($num>0){
             echo "You can issue";      
                //Issue code(previous)
            $sql1="SELECT cards FROM `users` WHERE `userid`='$user' ";
            $res=mysql_query($sql1,$conn);
            while($row = mysql_fetch_array($res)) {
                $a=$row['cards'];
            }
            $a=$a-1;
//echo $a;
            if($a>=0){
                
              $sql1 = "UPDATE books  SET  status='issued'  where bookid='$book' ";
              mysql_query($sql1,$conn);
      // echo "updated";
              $sql = "UPDATE `books` SET `userid`='$user' WHERE `bookid`='$book' ";
              mysql_query($sql,$conn);
      // echo "updated";
              $sql1 = "UPDATE books  SET  doi='$d'  where bookid='$book' ";
              mysql_query($sql1,$conn);
      // echo "updated";
              $sql1 = "UPDATE books  SET  dor='$d1'  where bookid='$book' ";
              mysql_query($sql1,$conn);
      // echo "updated";
       //echo "retrived";
              $sql1 = "UPDATE users  SET cards ='$a'  where userid='$user' ";
              mysql_query($sql1,$conn);
       //echo "updated";
                $num=$num-1;
                $sql1 = "UPDATE availability  SET available ='$num'  where title='$titles' ";
              mysql_query($sql1,$conn);
              echo "decreased";   
              echo "<script language='javascript'>confirm('Book is issued ')</script>";
           }
           else{
               echo "<script language='javascript'>confirm('This user does not have cards to issue a new book')</script>";
           }

        }
        else{
                echo "not available";
            }
        
            

        }
            
    
        }
        
    
?>
<html>
<head>
<title>Issue Book</title>
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
    <br>
    <br>
    <script>
     function goHome() {
      window.open('admin.php',"_self")
    }
    </script>

    

       

<form role="form" method="post" >
<div class="loginbox">
    <h1>IssueBook</h1>
 <p>UserId </p><input type="text" name="UserId" placeholder="User Id"  required>
 <br>
 <br>
<p>BookId</p><input type="text" name="BookId" placeholder="BookId" required>
<br>
<br>
 <p>Title</p><input type="text" name="Title" placeholder="Title"  required>
 <br>
 <br>
 <input type="submit"  name="Issue" value="Issue"> 
<a href="login10.php">Don't have an account?</a>
 <br>
 <br>
</div>
    </form>
</body>
</html>


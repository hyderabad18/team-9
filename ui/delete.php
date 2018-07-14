<?php
//check if form is submitted
if(isset($_REQUEST["delete"])){
    // When the add button of the form is clicked
    $tid=$_REQUEST["id"];
    $users=$_REQUEST["username"];
    $authors=$_REQUEST["author"];
    //Server connection
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
    //Checking whether book is available or not
     $sql  = "SELECT `bookid` FROM `books` WHERE `bookid`=$tid";
              $result=mysql_query($sql);
              //If the book is avalable then delete the book
              if(mysql_num_rows($result)>0){
                   $sql = "DELETE FROM `books` WHERE `bookid`=$tid";
                   if(mysql_query($sql)=== true){
                   echo "<script language='javascript'>confirm('The book is successfully deleted from the library ')</script>";
                       
                       //Modifcations......
                       $sql = "SELECT title FROM `availability` WHERE title='$titles' ";
                       $res=mysql_query($sql ,$conn);
                       $num=0;
                       while($row = mysql_fetch_array($res)) {
                           $avail=$row['available'];
                       $num=$num+1;
                      }
                      echo $num;
                      if($num==1){
                         $sql = "UPDATE `availability` SET `available`=available-1 WHERE `title`='$titles'";
                      mysql_query($sql,$conn);
                     }
                
             //Till here....
            
             }
             
                       
                       
                   }
              }
                   else{
                      echo "<script language='javascript'>confirm('Book not found ')</script>";
                  }


    }
?>

<html>
<head>
 <title>Delete Book</title>
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

       
<form method="post">
   <div class="loginbox">
    <h1>Delete Book</h1>
 <p>Book Id</p><input type="text" name="id" placeholder="BookId" required>
 <br>
 <br>
 <p>Title</p><input type="text" name="username" placeholder="Title" required>
 <br>
 <br>
 <p>Author</p><input type="text" name="author" placeholder="Author" required>
 <br>
 <br>
 <p>Reason</p><textarea cols="25" rows="3" placeholder="Enter the reason of deletion"></textarea>
 <br>
 <br>
 <input type="submit" name="delete" value="Delete">
 <br>
 <br>
    </div>
</form>

</body>
</html>
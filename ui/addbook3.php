<?php
//check if form is submitted
$msg=$errmsg="";
$sum=0;
$rackno=1;
$rackcode='A';
if(isset($_REQUEST["add"])){
    // When the add button of the form is clicked
    $tid=$_REQUEST["id"];
    $titles=$_REQUEST["title"];
    $authors=$_REQUEST["author"];
    $keys=$_REQUEST["key"];
   //Generating code for the rack no.
    if($sum<10){
        $rack=$rackcode.$rackno;
        $sum=$sum+1;
    }
    else{
        $sum=0;
        $rackno=$rackno+1;
    }
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
    $flag=0;
    //Used to check whether the book already exists
              $sql  = "SELECT `bookid` FROM `books` WHERE `bookid`=$tid";
              $result=mysql_query($sql);
              if(mysql_num_rows($result)>0){
                   //$_SESSION['usr_id']!="$names";
               $flag=1;
               $errmsg = "This Id already exits please enter a new one!!!";
              //echo "<script language='javascript'>confirm('This titleId already exits ')</script>";
                 
              }
	//If book is not present then add the book
         if($flag==0){
                  $sql = "INSERT INTO books(`bookid`, `title`, `author`, `rackno`, `keyword`) VALUES ('$tid','$titles','$authors','$rack','$keys')";
                  //echo "Inserted";
                  mysql_query($sql,$conn);
                  $msg="The book is successfully added to library";

                 // echo "<script language='javascript'>confirm('The book is successfully added to library ')</script>";
             
             //Modifications.....
             $sql = "SELECT title FROM `availability` WHERE title='$titles' ";
             $res=mysql_query($sql ,$conn);
             $num=0;
             while($row = mysql_fetch_array($res)) {
                $num=$num+1;
            }
            echo $num;
             if($num==1){
             $sql = "UPDATE `availability` SET `available`=available+1 WHERE `title`='$titles'";
              mysql_query($sql,$conn);
             //Till here....
            
             }
             else{
                 $sql="INSERT INTO `availability`(`title`, `available`) VALUES ('$titles','1')";
                 mysql_query($sql,$conn);
             }
          }
    }
?>

<html>
<head>
 <title>Add Book</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
.text-danger,.error{
    background-color:yellow;
    color:red;
    font-size: 25px;
    margin-left: 35%;
    
    

}
</style>
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

 <span class="text-danger"><?php if (isset($errmsg)) { echo $errmsg; } ?></span>   
<span class="text-danger"><?php if (isset($msg)) { echo $msg; } ?></span>      


<form method="post">

   <div class="loginbox">
    <h1>Add Book</h1>
 <p>Book Id</p><input type="text" name="id" placeholder="BookId" required>
 <br>
 <br>
 <p>Title</p><input type="text" name="title" placeholder="Title" required>
 <br>
 <br>
    <p>Author</p><input type="text" name="author" placeholder="Author" required>
 <br>
 <br>
 <p>Keyword</p><input type="text" name="key" placeholder="Keyword" required>
 <br>
 <br>
 <input type="submit" name="add" value="Add">
 <br>
 <br>
    </div>
</form>

</body>
</html>
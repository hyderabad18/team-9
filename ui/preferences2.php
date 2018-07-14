<?php
session_start();
?>
<html>
    <head>
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <style>
a{
    background-color: #f1f1f1;
    color: black;
    padding-top: 10px;
    font-size: 17px;
    margin-left: 50px;
    padding: 10px;
    padding-right: 10px;
    
}
            a:hover{
                color: blue;
            }
            
            .heading {

    color: blue;
    animation-name: example;
    animation-duration: 3s;
    animation-iteration-count: infinite;
    font-size:55px;
    
}

@keyframes example {
    0%   {color: blue; left:0px;}
    50%  {color: palevioletred; left:0px;}
    100% {color: peru; left:0px;}
}

        </style>
      
    <link rel="stylesheet" type="text/css" href="buttons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
</head>
 <body>
     <p>
    <button onclick="goBack()" >&#8249;</button>
    <button onclick="goForward()" >&#8250;</button>
    <button onclick="goHome()" class="btn"><i class="fa fa-home"></i> Home</button>
     </p>
     <br>
     <br>

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




 <h1 class="site-heading text-center text-white d-none d-lg-block">
      <span class="heading">Similar Books</span>
    </h1>
    <br>
    
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
                // $_SESSION['title']=$x;

               // echo "<a href='predef4.php' name=id value=$x>".$x."<br>";
                //  echo "<a href='predef4.php .? id={$row['title']}'"
//echo '<a href="predef4.php?id=Table">'.$x.'</a>'."<br>";
//echo '<a href="predef4.php?id">'.$x.'</a>'."<br>";
//echo '<a href="predef4.php?id=' . $x . '">$x</a>';
//echo '<a href="b.html?content=' . $val . '">Link</a>';
// echo $x ."<a href=\"predef4.php?id=". $x ."\">Link</a>";

//echo "<a href=\"predef4.php?id=". $x ."\">".$x."<br>";
    echo "<a href=\"predef4.php?id=". $x ."\" >".$x."<br> <br>";
}
    
?>


    </body>
</html>
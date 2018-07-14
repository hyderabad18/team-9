 <?php
session_start();
?>

<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" type="text/css" href="buttons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    margin-left: 30px;
    margin-top: 10px;
    font-size: 30px;
}

input[type="text"]{
      	width: 40%;
        text-align:center;
        font-size: 30px;
        color:black;
        background-color:lightgoldenrodyellow;
    
      }
input[type="submit"]{
        text-align:center;
        font-size: 25px;
        color:black;
        margin-left: 18%;
        background-color: aliceblue;

      }


input[type="submit"]:hover
{
	cursor: pointer;
	background: #ffc107;
	color: darkred;

}
        p{
            margin-right: 10px;
        }



    </style>
   
   
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




       <?php
          if(isset($_REQUEST["submit"])){
       // echo "hello";
$names=$_REQUEST["search"];
              //echo $names;
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

$sql="SELECT * FROM books";
        
              
              $result=mysql_query($sql,$conn);
              
              $z=0; 
              $flag=0;
              while($row = mysql_fetch_array($result)) {
                 $x=$row['title'];
                  
                if(!(strcasecmp($x,$names)))
                  {
                   $rack=$row["rackno"];
                   $title=$row["title"];
                   $Author=$row["author"];
                   $_SESSION['keyword']=$row["keyword"];
                    if($row["status"]=="available"){
                     $z=$z+1;   
                    }
                  }
                  if($z==0){
                      $flag=1;
                  }
                  
              }
              $row = mysql_fetch_array($result);
              //if($z>1){
                
                   echo "<p>Title &nbsp; &nbsp; &nbsp; &nbsp; :<input type='text' value='$title'/>"."<br>"."<br>";
                   echo "Author &nbsp;&nbsp;&nbsp;&nbsp;:<input type='text' value='$Author'/>"."<br>"."<br>";
                   echo "Rackno &nbsp;&nbsp;:<input type='text' value='$rack'/>"."<br>"."<br>";
                   echo "Available :<input type='text' value='$z'/>"."<br>"."<br>";         
          //}
          }
         
        ?>
        <form action=preferences2.php>
         <input type="submit" name="submits" value="Get similar books">
        </form>
    </body>
</html>


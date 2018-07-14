<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Smart Library</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    
    <!-- Custom styles for this template -->
    <link href="css/business-casual.min.css" rel="stylesheet">
      <style>
      ul {
  list-style: none;
  padding: 10px;
  margin: 0px;
  background: rgba(47, 23, 15, 0.9);
}

ul li {
  display: block;
  position: relative;
  float: left;
  background: rgba(47, 23, 15, 0.9);
    

}

/* This hides the dropdowns */


li ul { display: none; }

ul li a {
  display: block;
  padding: 1em;
  text-decoration: none;
  white-space: nowrap;
  width:180px;
  color: #e6a756;
    font-size: 19px;
   // text-align:center;
}

ul li a:hover { background: #e6a756; }

/* Display the dropdown */


li:hover > ul {
  display: block;
  position: absolute;
}

li:hover li { float: none; }

li:hover a { background: rgba(47, 23, 15, 0.9); 
          }

li:hover li a:hover { background: #e6a756; }

.main-navigation li ul li { border-top: 0; }

/* Displays second level dropdowns to the right of the first level dropdown */


ul ul ul {
  left: 100%;
  top: 0;
}

/* Simple clearfix */



ul:before,
ul:after {
  content: " "; /* 1 */
  display: table; /* 2 */
}

ul:after { clear: both; }
          .p{
              float:right;
          }
        a {
    text-decoration: none;
    display: inline-block;
    padding: 10px 10px;
}

a:hover {
    background-color: #ddd;
    color: black;
}


.login {
    background-color: #f1f1f1;
    color: black;
    float:right;
    padding-right: 10px;
    border-radius: 5px;
}

.Sign-up {
    background-color: #e6a756;
    color: rgba(47, 23, 15, 0.9) ;
    float:right;
    padding-top: 10px;
    padding-left: 20px;
    padding-right: 20px;
    padding-bottom: 10px;
    border-radius: 5px;
    text-align: justify;
}

.round {
    border-radius: 50%;
}
.sign{
              padding-right: 20px;
    padding-top: 10px;
          }


      </style>

  </head>

  <body>
      <div class="sign">
          <a href="index20.html" class="login">Logout</a>
      <label for="login" class="Sign-up"><?php echo $_SESSION["username"]; ?></label>
      
      </div>
      

    <h1 class="site-heading text-center text-white d-none d-lg-block">
      <span class="site-heading-upper text-primary mb-3">GNITS</span>
      <span class="site-heading-lower">SMART LIBRARY</span>
    </h1>

    <!-- Navigation -->
    <ul class="main-navigation">
        <li><a href="#" style="padding-left: 100px;">Home</a>
  </li>
  <li><a href="#" style="padding-left: 50px;">About</a>
    <ul>
      <li><a href="#">Library</a>
      </li>
      <li><a href="#">Staff</a>
        
      </li>
    </ul>
  </li>
  <li><a href="#">Collections</a>
    <ul>
      <li><a href="#">Novels</a>
        <ul>
          <li><a href="#">Science Fiction</a></li>
          <li><a href="#">Fantasy</a></li>
          <li><a href="#">Mysteries</a></li>
          <li><a href="#">Biographies</a></li>
        </ul>
      </li>
        <li><a href="#">Magazines</a></li>
      <li><a href="#">Newspapers</a></li>
    </ul>
</li>
        <li><a href="request1.php" style="padding-left: 50px;">Request</a>
  </li>
    </ul>
<br>
      <br>
      <br>
      <br>
      <br>
    <section class="page-section clearfix">
      <div class="container">
        <div class="intro">
          <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="img/intro.jpg" alt=""><br><br>
          <div class="intro-text left-0 text-center bg-faded p-5 rounded">
            <h2 class="section-heading mb-4">
              <span class="section-heading-lower">Search</span>
            </h2>
            <p class="mb-3">
                You can search by author<br>
                You can search by title<br>
                You can search by keyword
                        <form action="predef3.php">

                         <input type="text" placeholder="search" name="search">
                                       
        
            </p>
            <div class="intro-button mx-auto">
               <input type="submit" name="submit" class="btn btn-primary btn-xl" value="Search">

            </div>
              </form>
          </div>
        </div>
      </div>
    </section>

    
    <footer class="footer text-faded text-center py-5">
      <div class="container">
        <p class="m-0 small">Copyright &copy; GNITS</p>
      </div>
    </footer>

   
  </body>

</html>

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
                <link href="searchstyle.css" rel="stylesheet">
             <link rel="stylesheet" type="text/css" href="buttons.css">

     
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
    

      <style>
          .active {
  background-color: #e6a756;
  color: black;
  text-align:center;
    text-decoration-line:underline
}

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

/* Displays second level dropdowns to the right of the first level dropdown
          
          
          */


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
          <a href="profile1.php" class="Sign-up"><?php echo $_SESSION["username"]; ?></a>
          <button onclick="goBack()" >&#8249;</button>
          <button onclick="goForward()" >&#8250;</button>    
      </div>
      

    <h1 class="site-heading text-center text-white d-none d-lg-block">
      <span class="site-heading-upper text-primary mb-3">GNITS</span>
      <span class="site-heading-lower">SMART LIBRARY</span>
    </h1>

    <!-- Navigation -->
    <ul class="main-navigation">
        <li><a class ="active" href="#" style="padding-left: 100px;">Home</a>
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
        <li><a href="request4.php" style="padding-left: 50px;">Request</a>
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
                You can search by keyword</p>
                        <form action="predef3.php">

                           <center>               
                        <div class="autocomplete" style="width:300px;">
                <input id="myInput" type="text" name="search" placeholder="Search" required>
                 </div>
                        </center>

                     <div class="intro-button mx-auto">
              <input type="submit" class="btn btn-primary btn-xl" name="submit" value="Search" >
            </div>
                                       
        
        
              </form>
          </div>
        </div>
      </div>
    </section>
s
    
    <footer class="footer text-faded text-center py-5">
      <div class="container">
        <p class="m-0 small">Copyright &copy; GNITS</p>
      </div>
    </footer>
      
       <script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
      });
}

/*An array containing all the country names in the world:*/
var countries = ["Automation and Robotics","C Programming","data structures and c","Structured Programming with C","Java1:Basic syntax and semantics","Java The complete Refence","Object Oriented Programming using Java"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);
</script>


   
  </body>

</html>

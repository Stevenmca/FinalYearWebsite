<?php 
include("includes/header.php");

?>
<br>
<div class="main_column column">

	<img src="http://www.i2clipart.com/cliparts/f/3/7/c/clipart-map-pin-f37c.png">
	
<br>

<h3>Stuggling to find your away around uni?</h3>
<p><br>
<h4>Select your campus and get a map to help you!</h4>
<style>


.dropbtn:hover, .dropbtn:focus {
    background-color: #000;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown a:hover {background-color: #ddd}

.show {display:block;}
</style>
</head>
<body>

<div class="dropdown">
<button onclick="myFunction()" class="dropbtn">Campus</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="jmap.php">Jordanstown</a>
    <a href="cmap.php">Colraine</a>
    <a href="mmap.php">Magee</a>
  </div>
</div>
<br><br><br><br><br><br><br><br><br><br>
<br>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>


     

  

</body>
</html>


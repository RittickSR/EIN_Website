<?php
session_start();

?>
<html>
<head>
     
    <title>ADD EMPLOYEES</title>
    <link rel="stylesheet" type="text/css" href="style/erlogin.css">
     <link rel="stylesheet" type="text/css" href="style/login.css">
   </head>
<body>
     
 <nav class="navbar">
    <span class="open-slide">
      <a href="#" onclick="openSlideMenu()">
        <svg width="30" height="30">
            <path d="M0,5 30,5" stroke="#fff" stroke-width="5"/>
            <path d="M0,14 30,14" stroke="#fff" stroke-width="5"/>
            <path d="M0,23 30,23" stroke="#fff" stroke-width="5"/>
        </svg>
      </a>
         <a href="logout.php">SIGN OUT</a>
    </span>

   
  </nav>

  <div id="side-menu" class="side-nav">
    <a href="#" class="btn-close" onclick="closeSlideMenu()">&times;</a>
    <a href="employerlogin.php">HOME</a>
    <a href="employadd.php">ADD EMPLOYEE</a>
    <a href="editaccess.php">Edit</a>
    <a href="employrem.php">REMOVE</a>
    <a href="employeradd.php">ADD EMPLOYER</a>
      <a href="sign.php">REGISTER EMPLOYEE</a>
  </div>

<div id="main">
    <h1>ADD EMPLOYER</h1>
      <div class="login">
    ENTER USERNAME AND PASSWORD
    <form id="loginf" method="post" action="">
USERNAME
        <input name="uname" type="text" class="formc"   required><br>
PASSWORD
        <input name="pass" type="text" class="formc"   required><br>
       
        <input name="submit" type="submit" class="formsub"   >
         </form></div>
  </div>


  <?php
  if(isset($_POST['submit']))
    {
    	$username=$_POST['uname'];
    	$password=$_POST['pass'];
    	$db=$_SESSION['username'];
        $con= mysqli_connect('localhost','root','',"$db") or die('UNABLE TO CONNECT');
        $query="INSERT INTO employerlist (username,password)  values('$username','$password')";
        $query_run= mysqli_query($con,$query);
        if($query_run==true)
        {
        	 echo '<script type="text/javascript"> alert("employer details inserted")</script>';
        }
        else
        {
        	 echo '<script type="text/javascript"> alert("employer details unable to insert")</script>';
        }
    }



  ?>
   <script>
    function openSlideMenu(){
      document.getElementById('side-menu').style.width = '250px';
      document.getElementById('main').style.marginLeft = '250px';
    }

    function closeSlideMenu(){
      document.getElementById('side-menu').style.width = '0';
      document.getElementById('main').style.marginLeft = '0';
    }
  </script>
   
    </body></html>
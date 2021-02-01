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
    <h1>EMPLOYEE NUMBER</h1>
      <div class="login">
    ENTER LOGIN DETAILS
    <form id="loginf" method="post" action="">
EIN NUMBER
        <input name="uname" type="text" class="formc"   required><br>
       
        <input name="submit" type="submit" class="formsub"   >
         </form></div>
  </div>
<?php
  if(isset($_POST['submit']))
    {
        $username=$_POST['uname'];
      $db=$_SESSION['username'];
         $con= mysqli_connect('localhost','root','',"$db") or die('UNABLE TO CONNECT');
      $con1= mysqli_connect('localhost','root','',"sample") or die('UNABLE TO CONNECT');
      $sql="SELECT * FROM user where ein='$username'";
      $result = mysqli_query($con1,$sql) or die('ERROR');
   
    $row = mysqli_fetch_array($result);
      $na=$row["name"];
      $ename=$row["ename"];
                       
      
     
    if($ename==NULL)
     {
          $query="INSERT INTO employeelist (EIN,name) values ('$username','$na')";
        $query1="INSERT INTO details (EIN,name) values ('$username','$na')";
          $query_run= mysqli_query($con,$query);
        $query_run= mysqli_query($con,$query1);
       
       
          echo '<script type="text/javascript"> alert("SUBMT")</script>';
          if($query_run==true)
          {
           echo '<script type="text/javascript"> alert("REGISTERED")</script>';
          }
          else
          { 
            echo '<script type="text/javascript"> alert("FAIL")</script>';
          }
          $sq="UPDATE user SET ename='$db' WHERE ein='$username'";
          $result = mysqli_query($con1,$sq) or die('ERROR');
      }
      else 
      {
       echo '<script type="text/javascript"> alert("he already works into another comapany")</script>';
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
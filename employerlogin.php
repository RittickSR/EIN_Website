  <?php
         session_start();

?>

<html>
<head>
<title>
EMPLOYER LOGIN</title>
    <link rel="stylesheet" type="text/css" href="style/erlogin.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>        
   </head>
<body>
 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Responsive Side Menu</title>
  <link rel="stylesheet" href="style.css">
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
        <a href="resetPasswordempr.php">RESET PASSWORD</a>
    </span>
 
   
  </nav>

  <div id="side-menu" class="side-nav">
    <a href="#" class="btn-close" onclick="closeSlideMenu()">&times;</a>
    <a href="#">HOME</a>
    <a href="employadd.php">ADD EMPLOYEE</a>
    <a href="editaccess.php">Edit</a>
    <a href="employrem.php">REMOVE</a>
       <a href="sign.php">REGISTER EMPLOYEE</a>
  </div>


     <div id="main">
    <h1>employee details</h1>
   
      <div class="table-responsive">  
  
    <table id="editable_table" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>NAME</th>
       <th>EIN</th>
       
      </tr>
     </thead>
     <tbody>
     <?php
         $db=$_SESSION['username'];
         $con= mysqli_connect('localhost','root','',"$db") or die('UNABLE TO CONNECT');
         $result = mysqli_query($con,"SELECT * FROM details" );
     while($row = mysqli_fetch_array($result))
     {
      echo '
      <tr>
       <td>'.$row["name"].'</td>
       <td>'.$row["EIN"].'</td>
       
      </tr>
      ';
     }
     ?>
     </tbody>
    
        </table>
   </div>  
  </div>


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
</body>
</html>

</body>
</html>

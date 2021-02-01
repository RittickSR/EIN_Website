<?php

require 'dbconfig/cofig.php';

session_start();

?>

<html>

<head>

    <title>

        </title>

        <link rel="stylesheet" type="text/css" href="style/erlogin.css">

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  

          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>            

    <script src="jquery.tabledit.min.js"></script></head>

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

    <a href="employrem.php">remove</a>

      <a href="employeradd.php">ADD EMPLOYER</a>
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

       <th>salary</th>

       <th>pf</th>

         <th>pension</th>

    
 <th>esi</th>
          <th>total</th>
             <th>month</th>

      </tr>

     </thead>

     <tbody>

     <?php
$sum=0;
         $s=0;
         $s2=0;
         $s3=0;
         $db=$_SESSION['username'];

          $con1= mysqli_connect('localhost','root','',"$db") or die('UNABLE TO CONNECT');

         $result = mysqli_query($con1,"SELECT * FROM details");

     while($row = mysqli_fetch_array($result))

         {$s=$row["month"];
         
         $row["pf"]=$row["salary"]*0.12;

        $row["pension"]=$row["pf"]*0.0833;

             $row["esi"]=$row["salary"]*0.0175;

             $row["empcut"]=$row["salary"]*0.0475+$row["salary"]*0.0367+$row["salary"]*0.0833;

     $row["total"]=$row["salary"]-$row["pf"]-$row["pension"]-$row["esi"];
if($s == $s2)
{
   $s3=$s3+$row["pf"]+$row["pension"]+$row["esi"];
    $s2=$s;
}
          else
          {$s3=$row["pf"]+$row["pension"]+$row["esi"];
          $s2=$s;}
             $sum=$sum+$row["pf"]+$row["pension"]+$row["esi"]+$row["empcut"];;
          $query = "
 UPDATE details 
 SET 
  pf = '".$row["pf"]."', 
 pension = '".$row["pension"]."',
 Esi='".$row["esi"]."',
 bonus='$s3',
 total ='".$row["total"]."'
 WHERE EIN = '".$row["EIN"]."'
 ";
mysqli_query($con1, $query);

      echo '

      <tr>
     <td>'.$row["name"].'</td>
       <td>'.$row["EIN"].'</td>

       <td>'.$row["salary"].'</td>

       <td>'.$row["pf"].'</td>

       <td>'.$row["pension"].'</td>


       <td>'.$row["esi"].'</td>
    
       <td>'.$row["total"].'</td>

   <td>'.$row["month"].'</td>

      </tr>

      ';

     }

     
          $con1= mysqli_connect('localhost','root','',"$db") or die('UNABLE TO CONNECT');
$e=$row["EIN"];
         $s=$row["salary"];
        $m= $row["month"];
         $p=$row["pf"];
         $pe=$row["pension"];
         $t=$row["total"];
         $result = mysqli_query($con1,"SELECT * FROM details");
         while($row = mysqli_fetch_array($result))
         {$query= "SELECT * FROM records where EIN='$e'' && month='$m'";
        if( mysqli_query($con1,$query))
        {$query = "
 UPDATE records 
 SET salary = '$s', 
  pf = '$p', 
 pension = '$pe',
 month = '$m',
 total ='$t'
 WHERE EIN = '$e'
 ";

 mysqli_query($con, $query);

}
          else
          {
}
         }?>



     </tbody>

    </table>

   </div>  

  </div>

<p style="font-size:30px;">Grand Total to be paid= <?php

    echo $sum;

    ?></p>





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

<script>$(document).ready(function(){  

     $('#editable_table').Tabledit({

      url:'action.php',

      columns:{

       identifier:[1, 'EIN'],

       editable:[[2, 'salary'], [3, 'pf'],[4, 'pension'],[7,'month']]

      },

      restoreButton:false,

      onSuccess:function(data, textStatus, jqXHR)

      {

       if(data.action == 'delete')

       {

        $('#'+data.name).remove();

       }

      }

     });

 

});

</script>

</body></html>


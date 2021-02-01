<?php
    session_start();
?>
<html>
    
    <head>
        <title> Employee Salary</title>
        <link href="employee1.css" type="text/css" rel="stylesheet">
    </head>
    <body> 
         <ul>
            
  <li class="dropdown">
    <a href="#top" class="dropbtn"><img src="https://www.google.com/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&ved=2ahUKEwjnuqqJxtLgAhUQTn0KHVyIC6sQjRx6BAgBEAU&url=https%3A%2F%2Fwww.123rf.com%2Fphoto_69471234_stock-vector-thin-line-settings-gear-icon-on-white-background.html&psig=AOvVaw3kZ93FW0wg-R70KtGDdB5V&ust=1551034617195082" width="20" height="20"></a>
    <div class="dropdown-content">
      <a href="resetPassword.php">Reset Password</a>
      <a href="logout.php">Log Out</a>
    </div>
  </li>
            <li><a href="#home"><?php echo $_SESSION['username']?></a></li>

</ul>
        <?php
    $m=$_SESSION['username'];
        $con1= mysqli_connect('localhost','root','','sample') or die('UNABLE TO CONNECT');
                $sq="SELECT * from user where ein='$m'";
                $result = mysqli_query($con1,$sq);
                $row1 = mysqli_fetch_array($result);
                    $ename=$row1['ename'];
                
        $con= mysqli_connect('localhost','root','',"$ename") or die('UNABLE TO CONNECT');
        $sqlget="SELECT * FROM details where ein='$m'";
        $sqldata= mysqli_query($con,$sqlget) ; 
       echo "<table>";
        echo "<tr><th>NAME</th><th>SALARY</th><th>PF</th><th>PENSION</th><th>ESI</th><th>MONTH</th><th>TOTAL</th></tr>";
        while($row =mysqli_fetch_array($sqldata)) {
            echo "<tr><td>";
            echo $row['name'];
            echo "</td><td>";
            echo $row['salary'];
            echo "</td><td>";
            echo $row['pf'];
            echo "</td><td>";
            echo $row['pension'];
            echo "</td><td>";
            echo $row['Esi'];
            echo "</td><td>";
        echo $row['month'];
            echo "</td><td>";
            echo $row['total'];
            echo "</td></tr>";
            
        }
     echo "</table>"; 
        ?>

        </body>
</html>

    
    
    


        
    

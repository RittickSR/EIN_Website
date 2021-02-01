<html>
    
    <head>
        <title> Employer Salary</title>
        <link href="employee1.css" type="text/css" rel="stylesheet">
    </head>
     
    <body>
        <h1>Your Salary</h1>
        
        <div class="btn-group">
  <button>Reset Password</button>
  <button>Log Out</button>
</div>
        
    </body>
</html>

<?php
  $server = mysql_connect("localhost:3306", "root", "root"); 
  $db = mysql_select_db("Employee data", $localhost:3306); 
  $query = mysql_query("SELECT * FROM Employee details"); 
?>

         <table>
            <tr>
                <td>Name</td>
                <td>Company Name</td>
                <td>Month</td>
                <td>Salary</td>
            </tr>

            <?php
               while ($row = mysql_fetch_array($query)) {
?>
                   <tr>
                   <td><?php echo $row['Name'];?></td>
                <td><?php echo $row['Company Name'];?></td>
                    <td><?php echo $row['Month'];?></td>
                    <td><?php echo $row['Salary'];?></td>
                   </tr>
             <?php
               }

            ?>
        </table>
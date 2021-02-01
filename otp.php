<?php 
session_start();
require 'dbconfig/cofig.php';
            $username=$_SESSION['username'];
            $test=$_POST['otp'];
            $query="select * from employer1 WHERE username='$username'";
             $resource =mysqli_query($con,$query) or die (mysqli_error());
             $rowcount=mysqli_num_rows($resource);
             $row =mysqli_fetch_array($resource);
             $otp=$row['otp'];
            
            if($test!=$otp)
            {
                echo '<script type="text/javascript"> alert("Wrong otp")</script>';
            }
    else
    {
        header('Location: employerlogin.php');
    }

?>
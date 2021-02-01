
<?php  
session_start();
$db=$_SESSION['username']; 
         $con= mysqli_connect('localhost','root','',"$db") or die('UNABLE TO CONNECT');
$input = filter_input_array(INPUT_POST);

$salary = mysqli_real_escape_string($con, $input["salary"]);

$pf = mysqli_real_escape_string($con, $input["pf"]);
$pension = mysqli_real_escape_string($con, $input["pension"]);
$month = mysqli_real_escape_string($con, $input["month"]);
$total=mysqli_real_escape_string($con, $input["total"]);
if($input["action"] === 'edit')
{
 $query = "
 UPDATE details 
 SET salary = '".$salary."', 
  pf = '".$pf."', 
 pension = '".$pension."',
 month = '".$month."',
 total ='".$total."'
 WHERE EIN = '".$input["EIN"]."'
 ";

 mysqli_query($con, $query);

}
if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM details
 WHERE EIN = '".$input["EIN"]."'
 ";
 mysqli_query($con, $query);
}

echo json_encode($input);

?>

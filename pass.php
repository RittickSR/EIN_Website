<?php 
function passhash($password)
{
    $hashed=hash('sha256',$password);
    return $hashed;
}
?>
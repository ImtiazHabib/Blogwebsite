<?php 

  $connect = mysqli_connect("localhost","root","","ssb311newsportal");

  if($connect)
  {
  	
  }
  else
  {
  	die(" Database connection failed" . mysqli_error($connect));
  }


?>
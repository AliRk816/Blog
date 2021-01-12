<?php
   $con = mysqli_connect('localhost','root','','blogali');
   if($con->connect_error) {
   die("Connected to".$con-> connect_error);
   }

?>
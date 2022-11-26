<?php

$con = new mysqli("localhost", "thai", "123", "mystore");
if(!$con) {
       //die("Connection failed: " . mysqli_connect_error()); 
       die("Connection failed: " . mysqli_error($con));
}

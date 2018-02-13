<?php

$conn = mysqli_connect('localhost', 'root', '', 'Address_Book');

if (mysqli_connect_errno()) {

	echo 'Database connection failed '.mysqli_connect_error();
	die();
}

?>
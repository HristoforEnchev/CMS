<?php 

$password = "forkoborko";

echo $hashed_pass = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12)); //!!!!!!!!!!!!

$password_input = "forkoborko";

echo "<br>";


// $password_input = crypt($password_input, $hashed_pass);

// echo $password_input . "<br>";


if (password_verify($password_input, $hashed_pass)) {   //!!!!!!!!!!!!!!!!!!
	echo "EQUAL PASSWORDS";
} else {
	echo "problem";
}











//phpinfo();
 ?>
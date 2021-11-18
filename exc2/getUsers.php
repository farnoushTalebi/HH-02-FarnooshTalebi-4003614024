<?php
$con=mysqli_connect('localhost','farnoush','12345','exc2') or die('con error');
mysqli_set_charset($con,'utf8');
$query="select * from users";
$result = mysqli_query($con, $query) or die('query error');

while($users = mysqli_fetch_array($result) ){
	$gender=($users['gender']==1)?'مرد':'زن';
	echo "<p>{$users['name']} {$users['family']}, {$users['phone']}, $gender, {$users['birthDate']}, {$users['address']}</p>";									
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
session_start();

$conn = mysqli_connect('localhost','root','','pub_management_sys');
if(!$conn){
    die('Could not Connect!'.mysqli_error());
}


$username = "";
$tablenbr = "";
$amount = "";

if(isset($_POST['register'])){
	$username = mysqli_real_escape_string($conn, $_POST['uname']);
	$pass1 = mysqli_real_escape_string($conn, $_POST['pass']);
	$pass2 = mysqli_real_escape_string($conn, $_POST['repass']);
	
	//checking if a user already exists
	
	$query1 = "SELECT * FROM employees WHERE username='$username'";
	$result1 = mysqli_query($conn,$query1);
	$user = mysqli_fetch_assoc($result1);
	if($user){
		echo'User already exists!';
	}
	$password = md5($pass1); //encryption
	
	$query2 = "INSERT INTO employees (username, password)
		VALUES('$username', '$password')";
	mysqli_query($conn, $query2);
	$_SESSION['username'] = $username;
	$_SESSION['success'] = "Logging in...";
	header('location: tables.php');
	
}

if(isset($_POST['login'])){
	$username = mysqli_real_escape_string($conn, $_POST['uname']);
	$password = mysqli_real_escape_string($conn, $_POST['pass']);
	
	$password = md5($password); //encryption
	
	$query1 = "SELECT * FROM employees WHERE username='$username' AND password='$password'";
	$query2 = mysqli_query($conn, $query1);
	
	if(mysqli_num_rows($query2)==1){
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "Logging in...";
		header('location: tables.php');
	}
	else{
		echo 'Username or password incorrect!';
		header('location: login.php?link=invalid username or password');
	}
	
}

if(isset($_POST['ok'])){
	$tablenbr = $_POST['tblnumber'];
	$username = $_SESSION['username'];
	
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	
	if($username != ''){
		$_SESSION['username'] = $username;
	}
	if($_SESSION['username']){
		$username = $_SESSION['username'];
	}
	
	$_SESSION['tablenbr'] = $tablenbr;
	header('location: menu1.php');
	
	//$_SESSION['tablenbr'] = $tablenbr;
	
	
	//header('location: menu1.php'); 
	
	
}


//testing  ***********************************************************

/*if($tablenbr != ''){
	$_SESSION['tablenbr'] = $tablenbr;
	echo 'new session value assigned for table number <br>';
}
else{
	echo 'table number doesnt exist <br>';
}
if($_SESSION['tablenbr']){
	$tablenbr = $_SESSION['tablenbr'];
	echo 'new value for table from session <br>';
	echo $tablenbr;
}
else{
	echo 'session does not exist <br>';
}*/

//end of testing  ****************************************************


if(isset($_POST['delete'])){
	//delete a prev ordered item
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	
	$deletesql = "DELETE FROM orders
	WHERE table_nbr='$tablenbr' ORDER BY order_date DESC LIMIT 1;";
	$deletequery = mysqli_query($conn, $deletesql);
	if($deletequery){
		header('location: menu1.php');
	}
	else{
		die('ERROR deleting!');
	}
	
}


//posts of drinks (total of 34) (ends on line

if(isset($_POST['vodka7up'])){
	//41
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['vodka7up'];
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('41', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('41', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}


if(isset($_POST['vodkaCran'])){
	//2
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['vodkaCran'];
	
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('42', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('42', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['vodkaBull'])){
	//3
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['vodkaBull'];
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('43', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('43', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}
if(isset($_POST['vodkaTonic'])){
	//4
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['vodkaTonic'];
	
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('44', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('44', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['vodkaGlsR'])){
	//5
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['vodkaGlsR'];
	
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('45', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('45', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['vodkaGlsP'])){
	//6
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['vodkaGlsP'];
	
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('46', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('46', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['vodkaBtlR'])){
	//7
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['vodkaBtlR'];
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('47', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('47', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['vodkaBtlP'])){
	//8
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['vodkaBtlP'];
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('48', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('48', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['whiskeyGlsR'])){
	//9
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['whiskeyGlsR'];
	
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('49', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('49', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}
if(isset($_POST['whiskeyGlsP'])){
	//10
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['whiskeyGlsP'];
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('50', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('50', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['whiskeyBtlR'])){
	//11
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['whiskeyBtlR'];
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('51', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('51', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['whiskeyBtlP'])){
	//12
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['whiskeyBtlP'];
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('52', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('52', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['pina'])){
	//13
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['pina'];
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('53', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('53', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['mojito'])){
	//14
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['mojito'];
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('54', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('54', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['ginBasil'])){
	//15
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['ginBasil'];
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('55', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('55', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['margarita'])){
	//16
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['margarita'];
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('56', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('56', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['lambo'])){
	//17
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['lambo'];
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('57', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('57', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['bloody'])){
	//18
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['bloody'];
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('58', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('58', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['teqSilver'])){
	//19
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['teqSilver'];
	
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('59', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('59', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['teqGold'])){
	//20
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['teqGold'];
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('60', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('60', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['brainDmg'])){
	//21
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['brainDmg'];
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('61', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('61', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['b52'])){
	//22
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['b52'];
	
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('62', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('62', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['samBlack'])){
	//23
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['samBlack'];
	
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('63', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('63', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['samWhite'])){
	//24
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['samWhite'];
	
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('64', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('64', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['waterS'])){
	//25
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['waterS'];
	
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('65', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('65', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['lemonade'])){
	//26
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['lemonade'];
	
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('66', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('66', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['milkshake'])){
	//27
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['milkshake'];
	
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('67', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('67', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['coffee'])){
	//28
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['coffee'];
	
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('69', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('69', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['tea'])){
	//29
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['tea'];
	
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('70', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('70', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['orange'])){
	//30
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['orange'];
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('68', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('68', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['freeShot'])){
	//31
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['freeShot'];
	
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('71', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('71', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	
}

if(isset($_POST['freeGls'])){
	//32
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['freeGls'];
	
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('72', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('72', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	
}

if(isset($_POST['freeVirgin'])){
	//33
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['freeVirgin'];
	
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('73', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('73', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}

if(isset($_POST['freeCoffee'])){
	//34
	
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$drink34 = $_POST['freeCoffee'];
	
	$amount = $_POST['amount'];
	if($amount != ''){
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('74', '$drink34',
		'$amount', (SELECT drink_price*'$amount' FROM drinks WHERE drink_desc='$drink34'),
		'1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
	else{
		$order34 = "INSERT INTO orders (drink_id, drinkname, order_amount, order_payment,
		hasPaid, discount, table_nbr) VALUES ('74', '$drink34', '1',
		(SELECT drink_price FROM drinks WHERE drink_desc='$drink34'), '1', '0', '$tablenbr')";
		$result34 = mysqli_query($conn,$order34);
		if($result34){
			
			$_SESSION['drinks'] = $result34;
			header('location: menu1.php');
		}
		else{
			die('ERROR inserting!');
		}
	}
}



/* if(isset($_POST['print'])){
	//set table status to pending close
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	
	$printsql = "SELECT * FROM table_dets WHERE table_nbr='$tablenbr'";
	$printq1 = mysqli_query($conn,$printsql);
	$printr1 = mysqli_fetch_assoc($printq1);
	if($printr1){
		$printupdate = "UPDATE table_dets SET table_status='Pending Close'
		WHERE table_nbr='$tablenbr'";
		mysqli_query($conn,$printupdate);
		header('location: closetable.php');
	}
	else{
		die('Failed to print!'.mysqli_errno());
	}
	
}
*/

if(isset($_POST['discountBtn'])){
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$discAmount = $_POST['discount'];
	$insertDisc = "UPDATE orders SET discount='$discAmount'
	WHERE table_nbr='$tablenbr' ORDER BY order_date DESC LIMIT 1;";
	$queryDisc = mysqli_query($conn, $insertDisc);
	if($queryDisc){
		$_SESSION['discAmount']=$discAmount;
		header('location: closetable.php');
	}
	else{
		die('ERROR discounting!');
	}
	
	
	
	
}

if(isset($_POST['close'])){
	//to close a table
	if($tablenbr != ''){
		$_SESSION['tablenbr'] = $tablenbr;
	}
	if($_SESSION['tablenbr']){
		$tablenbr = $_SESSION['tablenbr'];
	}
	$sql = "UPDATE orders SET hasPaid='0' WHERE table_nbr='$tablenbr'";
	$queryclose = mysqli_query($conn, $sql);
	if($queryclose){
		$sqll = "UPDATE orders SET table_nbr='9999' WHERE hasPaid='0'";
		$querysqll = mysqli_query($conn, $sqll);
		unset($_SESSION['tablenbr']);
		session_destroy();
		session_write_close();
		unset($_SESSION['disAmount']);
		session_destroy();
		session_write_close();
		header('location: tables.php');
	}
	else{
		die('ERROR closing!');
	}
	/*
	$sql = "UPDATE table_dets SET table_status='Available' WHERE
	table_nbr='$tablenbr'";
	mysqli_query($conn, $sql);
	header('location: tables.php');
	*/
	
}


if(isset($_POST['clearAllOrders'])){
	$report5 = "DELETE FROM orders";
	$report55 = mysqli_query($conn,$report5);
	if($report55){
		$_SESSION['report5']=$report55;
		header('location: reports.php');
	}
	else{
		die('ERROR executing query!');
	}
}


?>
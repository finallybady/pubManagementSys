<?php

include('connection.php');

?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
	<title>Reports Screen</title>
    <link rel="icon" type="image/x-icon" href="cocktail.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script>
			function myFunc(){
				if(window.prompt("Only admins allowed, enter password","")!="pub123"){
					window.location = "login.php"
				}
			}
	</script>
	<style>
            body{
                margin: 5px;
                font-family: Helvetica, Verdana, sans-serif;
                background-image: url('grey map.jpg');
                background-size:cover;
                background-repeat: no-repeat;
				background-position: center;
				background-attachment: fixed;
				height:900px;
            }
            .h1{
                margin:auto;
                width: fit-content;
                color: white;
                font-size: larger;
            }
            .h11{
                margin: auto;
                width:fit-content;
            }
            .login {
                background-color: #bfbfbf;
                background-size: cover;
                border-radius: 2em;
                position: relative;
                padding: 2em;
                width: 40%;
				height: 25em;
                margin: auto;
                font-size: 16px;
                font-weight: bold;
                line-height: 1.6;
				overflow: auto;
            }
            input{
                padding: 12px;
                border-radius: 1em;
                font-size: 13px;
                display: inline-block;
                box-sizing: border-box;
                width: 100%;
                border:1px solid darkblue;
            }
            input:focus,
            select:focus,
            textarea:focus,
            button:focus {
                outline: none;
            }
            button:hover{
                opacity: 0.8;
            }
			.b1{
                display: block;
                text-align: center;
                margin:12px auto 0 auto;
                
                padding: 1vw;
                cursor: pointer;
                width:10em;
				height: auto;
                font-family: Helvetica, Verdana, sans-serif;
                font-weight: bold;
				font-size: 2vw;
                border-radius: 10px;
				border-width: 1px;
            }
            
            .Login{
                display: block;
                text-align: center;
                margin:12px auto 0 auto;
                background-color: pink;
                padding: 1em;
                width:50%;
                font-family: Helvetica, Verdana, sans-serif;
                font-weight: bold;
                border-radius: 10px;
            }
            .footer{
                position: fixed;
                background-color: grey;
                opacity: 0.7;
                color: white;
                bottom: 0;
                left:0;
                text-align: center;
                width:100%;
                font-size: 14px;
                display: block;
            }
			a:link, a:visited {
				text-decoration: none;
				
				
			}
			a:hover, a:active {
				text-decoration: none;
			}
	</style>
</head>
<body onload="myFunc()">
<body>
	<div class="h1">
        <h1>Reports</h1>
    </div>
	
	
	
	<div class="login" id="toprint">
	
			
		<h3 style="background-color:red;">All Orders Made In The Last 24 Hours</h3>
		<table style="text-align:left;" border="0" width="100%">
		<tr>
			<th>Quantity</th>
			<th>Drink Name</th>
			<th>Order Price</th>
		</tr>
		<?php
			//$rep1 = $_SESSION['report1'];
			$querystr = "SELECT * FROM orders WHERE
			order_date >= now() - INTERVAL 1 DAY;";
				$result1 = mysqli_query($conn,$querystr);
				if(mysqli_num_rows($result1)>0){
					while($row = mysqli_fetch_assoc($result1)){
						echo "<tr>
							<td>".$row['order_amount']."</td>
							<td>".$row['drinkname']."</td>
							<td>".$row['order_payment']."</td>
							
							</tr>";
					}
				}
		?>
		</table>
		<h3 style="background-color:orange;">Total Number Of Drinks</h3>
		<table style="text-align:left;" border="0" width="100%">
		<tr>
			<th></th>
			<th></th>
			<td></th>
		</tr>
		<?php
			//$rep1 = $_SESSION['report1'];
			$querystr = "SELECT COUNT(*) FROM orders";
				$result1 = mysqli_query($conn,$querystr);
				if(mysqli_num_rows($result1)>0){
					while($row = mysqli_fetch_assoc($result1)){
						echo "<tr>
							<td>".$row['COUNT(*)']."</td>
							</tr>";
					}
				}
		?>
		</table>
		<h3 style="background-color:yellow;">Categories</h3>
		<table style="text-align:left;" border="0" width="100%">
		<tr>
			<th>Category Name</th>
			<th>Amount</th>
			<td></th>
		</tr>
		<?php
			//$rep1 = $_SESSION['report1'];
			$querystr = "SELECT COUNT(orders.order_id), drinks_category.category_name
			FROM orders JOIN drinks ON orders.drink_id = drinks.drink_id
			JOIN drinks_category
			ON drinks.drink_category=drinks_category.dcat_id
			GROUP BY category_name;";
				$result1 = mysqli_query($conn,$querystr);
				if(mysqli_num_rows($result1)>0){
					while($row = mysqli_fetch_assoc($result1)){
						echo "<tr>
							<td>".$row['category_name']."</td>
							<td>".$row['COUNT(orders.order_id)']."</td>
							</tr>";
					}
				}
		?>
		</table>
		<h3 style="background-color:green;">Drink Types</h3>
		<table style="text-align:left;" border="0" width="100%">
		<tr>
			<th>Type Name</th>
			<th>Amount</th>
			<td></th>
		</tr>
		<?php
			//$rep1 = $_SESSION['report1'];
			$querystr = "SELECT COUNT(orders.order_id), drinks_type.type_name
			FROM orders JOIN drinks ON orders.drink_id = drinks.drink_id
			JOIN drinks_type
			ON drinks.drink_type_id=drinks_type.type_id
			GROUP BY type_name;";
				$result1 = mysqli_query($conn,$querystr);
				if(mysqli_num_rows($result1)>0){
					while($row = mysqli_fetch_assoc($result1)){
						echo "<tr>
							<td>".$row['type_name']."</td>
							<td>".$row['COUNT(orders.order_id)']."</td>
							</tr>";
					}
				}
		?>
		</table>
		
		
	</div>
	<div>
	<form action="connection.php" method="POST">
			<button type="submit" class="b1" style="background-color:cyan;"
			name="clearAllOrders">Clear All Orders</button>
			<button type="button" class="b1" onclick="document.location='login.php'"
			style="background-color: blue; color:white;">Back</button>
			<button type="button" class="b1" onClick="printOrder()"
			style="background-color:black; color:white;">Print</button>
		</form>
	</div>
	
	<div class='footer'>
        <p>&copy; Copyright
            <script>document.write(new Date().getFullYear());
            </script> The Grand Finale<br>All rights reserved</p>
    </div>
	
	
	<script>
	function goBack(){
		window.history.go(-1);
	}
		
	function printOrder() {
		var printContents = document.getElementById("toprint").innerHTML;
		w=window.open();
		w.document.write(printContents);
		w.print();
		w.close();
	}
		
	</script>
	
</body>
</html>
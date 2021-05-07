<?php
	
	include('connection.php');
	//session_start();
	
	if(!isset($_SESSION['username'])){
		$_SESSION['msg']="You must be logged in first!";
		header('location: login.php');
	}
	
	if(!isset($_SESSION['tablenbr'])){
		$_SESSION['msg1']="You must enter a table number first!";
		header('location: tables.php');
	}
	
	if(isset($_POST['close'])){
		unset($_SESSION['tablenbr']);
		session_destroy();
		session_write_close();
		unset($_SESSION['disAmount']);
		session_destroy();
		session_write_close();
		header("location: tables.php");
	}

?>

<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
<head>
	<title>Menu-Checkout</title>
    <link rel="icon" type="image/x-icon" href="cocktail.png" />
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		body{
            margin: 5px;
            font-family: Helvetica, Verdana, sans-serif;
            background-image: url('grey map.jpg');
            background-size:cover;
            background-repeat: no-repeat;
			background-position: center;
			background-attachment: fixed;
			height:800px;
			overflow:auto;
        }
		input{
			margin: auto;
            padding: 12px;
            border-radius: 1em;
            font-size: 13px;
            display: block;
            box-sizing: border-box;
            width: 40%;
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
        .footer{
            position: fixed;
            background-color: grey;
            opacity: 0.4;
            color: white;
            bottom: 0;
            left:0;
            text-align: center;
            width:100%;
            font-size: 14px;
            display: block;
        }
		.modal {
			display: none;
			position: fixed;
			z-index: 1;
			padding: 3em;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			overflow: auto;
			background-color: rgb(0,0,0);
			background-color: rgba(0,0,0,0.6);
		}
		.bigDiv{
			display: flex;
			align-items: center;
		}
		.login {
			background-color: beige;
            background-size: cover;
            border-radius: 2em;
			display:block;
            position: relative;
            padding: 2em;
            width: 40%;
			margin-left:auto;
			margin-right: auto;
			height: auto;
            font-size: 16px;
            font-weight: bold;
            line-height: 1.6;
			text-align: center;
			flex: 1.6;
        }
		.eeee{
			background-color: beige;
            background-size: cover;
            border-radius: 2em;
			display: block;
            padding: 1em;
            width: 25%;
			height: 20em;
            font-size: 16px;
            font-weight: bold;
            line-height: 1.6;
			text-align:center;
			overflow: auto;
			
		}
		.btw{
			flex: 0.5;
		}
		.output{
			background-color: beige;
            background-size: cover;
            border-radius: 2em;
			display: block;
            padding: 1em;
            width: 25%;
			height: 20em;
            font-size: 16px;
            font-weight: bold;
            line-height: 1.6;
			text-align:center;
			overflow: auto;
			flex: 1.2;
		}
		.b1{
            display: inline;
            text-align: center;
            margin:2% 5.5% 2% 5.5%;
            background-color: black;
            padding: 1vw;
            cursor: pointer;
            width:15vw;
			height: 8vw;
            font-family: Helvetica, Verdana, sans-serif;
            font-weight: bold;
			font-size: 1.2vw;
			color: white;
            border-radius: 10px;
			border-width: 1px;
        }
		.b11{
            display: inline;
            text-align: center;
            margin:2% 6.5% 2% 5.5%;
            background-color: green;
            padding: 1em;
            cursor: pointer;
            width:20%;
			height: 6vw;
            font-family: Helvetica, Verdana, sans-serif;
            font-weight: bold;
			font-size: 1.7vw;
            border-radius: 10px;
			border-width: 2px;
        }
		.b12{
            display: inline-block;
            text-align: center;
            margin:2% 5.5% 2% 5.5%;
            
            padding: 1em;
            cursor: pointer;
            width:15vw;
			height: 4.5vw;
            font-family: Helvetica, Verdana, sans-serif;
            font-weight: bold;
			font-size: 1.5vw;
            border-radius: 10px;
			border-width: 1px;
        }
		.h1{
            margin:auto;
            width: fit-content;	
            color: black;
            font-size: larger;
			background-color: grey;
			padding: 0px 5px 0px 5px;
			border-radius:10px;
        }
		.h11{
            margin: auto;
            width:fit-content;
        }
		.Login{
            display: block;
            text-align: center;
            margin:12px auto 0 auto;
            background-image: linear-gradient(to bottom right, #660066, cyan);
            padding: 1em;
            border: #333333 solid 2px;			
            width:60%;
            font-family: Helvetica, Verdana, sans-serif;
            font-weight: bold;
            border-radius: 10px;
		}
		.modal-content {
			background-color: #bfbfbf;
			margin: auto;
			padding: 1em;
			border: 1px solid #888;
			width: 60%;
			border-radius: 2em;
		}

		.close {
			color: #aaaaaa;
			float: right;
			font-size: 3em;
			font-weight: bold;
		}

		.close:hover,
		.close:focus {
			color: #000;
			text-decoration: none;
			cursor: pointer;
		}
		.toTheLeft {
				position: absolute;
				padding: 2px;
				color: green;
				right: 10px;
				top: 10px;
				z-index: -1;
				width: auto;
				height:auto;
				background-color: lightgrey;
				border-radius:1em;
		}
		.toTheBot {
			position: relative;
			top:60%;
			text-align: center;
		}
	</style>
</head>
<body>

	<div class="h1">
        <h1>Order for Table <?php echo $_SESSION['tablenbr'];  ?></h1>
	</div>

	<div class="toTheLeft">
		<p>Logged in as: <strong><?php echo $_SESSION['username']; ?>
		</strong></p>
	</div>
	
	<div id="toprint" class="login">
		<p><u>Order for Table <?php echo $_SESSION['tablenbr'];  ?></u></p>
		
		<table style="text-align:left;" border="0" width="100%">
			<tr>
				<th></th>
				<th></th>
			</tr>
			<?php 
				$table_nbr=$_SESSION['tablenbr'];
				$querystr = "SELECT drinkname, order_payment FROM orders
				WHERE table_nbr='$table_nbr';";
				$resultdrinks = mysqli_query($conn,$querystr);
				if(mysqli_num_rows($resultdrinks)>0){
					while($row = mysqli_fetch_assoc($resultdrinks)){
						echo "<tr>
							<td>".$row['drinkname']."</td>
							<td>".$row['order_payment']."</td>
							</tr>";
					}
				}
			?>
		</table>
		<p><u>
		<?php
			if(isset($_SESSION['discAmount'])){
				$discount = $_SESSION['discAmount'];
				echo('Discount: ').$discount;
			}
			else{
				$discount=0;
				echo('Discount: ').$discount;
			}
		?>
		</u></p>
		<div class="toTheBot"><u>Total: 
		<?php
			$tablenbr = $_SESSION['tablenbr'];
			if(isset($_POST['discount'])){
				$totalquery = "SELECT SUM(order_payment) - (SELECT SUM(discount))
				FROM orders WHERE table_nbr='$tablenbr';";
				$totalprice = mysqli_query($conn,$totalquery);
				while($row1 = mysqli_fetch_assoc($totalprice)){
					echo $row1['SUM(order_payment) - (SELECT SUM(discount))'];
				}
			}
			else{
				$totalquery = "SELECT SUM(order_payment) - (SELECT SUM(discount))
				FROM orders WHERE table_nbr='$tablenbr';";
				$totalprice = mysqli_query($conn,$totalquery);
				while($row1 = mysqli_fetch_assoc($totalprice)){
					echo $row1['SUM(order_payment) - (SELECT SUM(discount))'];
				}
			}
			
			//$discount = $_SESSION['discAmount'];
			
			//$totalquery = "SELECT SUM(order_payment) - (SELECT SUM(discount))
			//FROM orders WHERE table_nbr='$tablenbr';";
			//$totalprice = mysqli_query($conn,$totalquery);
			//while($row1 = mysqli_fetch_assoc($totalprice)){
			//	echo $row1['SUM(order_payment) - (SELECT SUM(discount))'];
			//}
		?> L.L</u></div><br>
		<div class="toTheBot" style="font-size:12px">You have been served by:
		<?php echo $_SESSION['username']; ?></div>
	</div>
	
	<div class="Login">
		<form action="connection.php" method="POST">
			<button type="button" class="b11" onClick="goBack()"
			style="background-image: linear-gradient(to bottom right, cyan, black);"
			>Back</button>
			<input type="number" placeholder="discount amount" value="0" 
			name="discount"/>
			<button type="submit" class="b11" style="background-image: linear-gradient(to bottom right, black, #660066);
			color: white;" name="discountBtn">Discount</button>
			<button type="button" class="b11" onClick="printOrder()" name="print"
			>Print</button>
			<button type="submit" class="b11" name="close" style="color:white;
			background-image: linear-gradient(to bottom right, black, red);">
			Close</button>
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
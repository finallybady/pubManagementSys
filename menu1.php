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
	
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
<head>
	<title>Menu</title>
    <link rel="icon" type="image/x-icon" href="cocktail.png" />
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>
		function getNumbers(val){
			document.getElementById("scr1").value+=val;
		}
		function clearAll(){
			document.getElementById("scr1").value = "";
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
			height:700px;
			overflow:auto;
        }
		input{
			margin: auto;
            padding: 1px;
            border-radius: 1em;
            font-size: 6px;
            display: block;
            box-sizing: border-box;
            width: 77%;
            border:1px solid darkblue;
			visibility: hidden;
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
            opacity: 0.7;
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
		
		.modal-content {
			background-color: #bfbfbf;
			margin: auto;
			padding: 1em;
			border: 1px solid #888;
			width: 60%;
			border-radius: 2em;
		}
		
		.bigDiv{
			display: flex;
			align-items: center;
		}
		.login {
			background-color: #bfbfbf;
            background-size: cover;
            border-radius: 2em;
            position: relative;
            padding: 2em;
            width: 60%;
			margin-left:auto;
			margin-right: auto;
			height: auto;
            font-size: 16px;
            font-weight: bold;
            line-height: 1.6;
			flex: 1.5;
        }
		.btw{
			background: rgba(154, 166, 157, 0.1);
			background-size: cover;
			flex: 0.5;
			display: inline-block;
			border-radius: 2em;
			padding-top: 1em;
			padding-bottom: 1em;
			height: auto;
			width:15%;
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
			flex: 1;
		}
		.b1{
            display: inline;
            text-align: center;
            margin:2% 5.5% 2% 5.5%;
            background-color: black;
            padding: 0.5vw;
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
            background-color: red;
            padding: 0.5em;
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
            
            padding: 0.5em;
            cursor: pointer;
            width:15vw;
			height: 4.5vw;
            font-family: Helvetica, Verdana, sans-serif;
            font-weight: bold;
			font-size: 1.5vw;
            border-radius: 10px;
			border-width: 1px;
        }
		.bsc{
			display: inline-block;
            text-align: center;
			background-color: black;
			margin:2% 5.5% 2% 5.5%;
			color: white;
            padding: 0.5em;
            cursor: pointer;
            width:3em;
			height: 3em;
            font-family: Helvetica, Verdana, sans-serif;
            font-weight: heavy;
			font-size: 1.7vw;
            border-radius: 5em;
			border: #333333 solid 2px;
			position: relative;
			right:-26px;
		}
		
		.b22{
			display: inline-block;
            text-align: center;
			background-color: black;
			margin:2% 5.5% 2% 5.5%;
			color: white;
            padding: 0.5em;
            cursor: pointer;
            width:auto;
			height: 3em;
            font-family: Helvetica, Verdana, sans-serif;
            font-weight: heavy;
			font-size: 1.7vw;
            border-radius: 1em;
			border: #333333 solid 2px;
			position: relative;
			right:-28px;
		}
		.b22:hover,
		.bsc:hover{
			background-color: #00cbd6;
			color: black;
			opacity:1;
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
            background-color: #00b3b3;
            padding: 1em;
            border: #333333 solid 2px;			
            width:70%;
            font-family: Helvetica, Verdana, sans-serif;
            font-weight: bold;
            border-radius: 10px;
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
		td {
			text-align: left;
		}
		tr:hover {
			background-color: #73e8ff;
		}
	</style>
</head>
<body>

	<div class="h1">
        <h1>Menu for Table <?php echo $_SESSION['tablenbr'];  ?></h1>
	</div>
	
	<div class="toTheLeft">
		<p>Logged in as: <strong><?php echo $_SESSION['username']; ?>
		</strong></p>
	</div>
	
	<div class="bigDiv">
	
	
	<!-- output div ******************************************************************-->
	
	<div class="output">
		<p><u>Ordered Drinks on table <?php echo $_SESSION['tablenbr'];  ?></u></p>
		
		<table class="" border="0" width="100%">
			
			<?php 
				$table_nbr=$_SESSION['tablenbr'];
				$querystr = "SELECT drinkname, order_amount, order_payment
				FROM orders WHERE table_nbr='$table_nbr';";
				$resultdrinks = mysqli_query($conn,$querystr);
				if(mysqli_num_rows($resultdrinks)>0){
					while($row = mysqli_fetch_assoc($resultdrinks)){
						echo "<tr>
							<td>".$row['order_amount']."</td>
							<td>".$row['drinkname']."</td>
							<td>".$row['order_payment']."</td>
							</tr>";
					}
				}
			?>
		</table>
		
		<p><u>Total: 
		<?php
			$tablenbr = $_SESSION['tablenbr'];
			$totalquery = "SELECT SUM(order_payment) FROM orders
				WHERE table_nbr='$tablenbr';";
			$totalprice = mysqli_query($conn,$totalquery);
			while($row1 = mysqli_fetch_assoc($totalprice)){
				echo $row1['SUM(order_payment)'];
			}
		?> L.L</u><p><br>
		<p style="font-size:12px">You have been served by:
		<?php echo $_SESSION['username']; ?></p>
	</div>
	
	
	<!-- Numbers div *****************************************************************-->
	
	<div class="btw">
	<form action="connection.php" method="POST">
		<input type="number" name="amount" id="scr1"/>
		<button type="button" class="bsc" name="one"
		onClick="getNumbers('1')" value="1">1</button>
		<button type="button" class="bsc" name="two"
		onClick="getNumbers('2')" value="2">2</button>
		<button type="button" class="bsc" name="three"
		onClick="getNumbers('3')" value="3">3</button>
		<button type="button" class="bsc" name="four"
		onClick="getNumbers('4')" value="4">4</button>
		<button type="button" class="bsc" name="five"
		onClick="getNumbers('5')" value="5">5</button>
		<button type="button" class="bsc" name="six"
		onClick="getNumbers('6')" value="6">6</button>
		<button type="button" class="bsc" name="seven"
		onClick="getNumbers('7')" value="7">7</button>
		<button type="button" class="bsc" name="eight"
		onClick="getNumbers('8')" value="8">8</button>
		<button type="button" class="bsc" name="nine"
		onClick="getNumbers('9')" value="9">9</button>
		<button type="button" class="bsc" name="zero"
		onClick="getNumbers('0')" value="0">0</button>
		<button type="button" class="b22" onClick="clearAll()"
		>Reset</button>
	</div>
	
	<!-- drinks buttons div **********************************************************-->
	<div class="login">
	
		<button type="button" id="myBtn" class="b12" style="background-color:#FFA07A;">
		Vodka</button>

		<div id="myModal" class="modal">

			<div class="modal-content">
				<span class="close">&times;</span>
				
				<button type="submit" class="b1" style="background-color:#FFA07A;"
				name="vodka7up" value="Vodka 7-Up">Vodka 7-UP</button>
				<button type="submit" class="b1" style="background-color:#FFA07A;"
				name="vodkaCran" value="Vodka Cranberry">Vodka Cranberry</button>
				<button type="submit" class="b1" style="background-color:#FFA07A;"
				name="vodkaBull" value="Vodka Redbull">Vodka RedBull</button>
				<button type="submit" class="b1" style="background-color:#FFA07A;"
				name="vodkaTonic" value="Vodka Tonic">Vodka Tonic</button>
				<button type="submit" class="b1" style="background-color:#FFA07A;"
				name="vodkaGlsR" value="Vodka Glass Regular">Vodka Gls Reg</button>
				<button type="submit" class="b1" style="background-color:#FFA07A;"
				name="vodkaGlsP" value="Vodka Glass Premium">Vodka Gls Pre</button>
				<button type="submit" class="b1" style="background-color:#FFA07A;"
				name="vodkaBtlR" value="Vodka Bottle Regular">Vodka Btl Reg</button>
				<button type="submit" class="b1" style="background-color:#FFA07A;"
				name="vodkaBtlP" value="Vodka Bottle Premium">Vodka Btl Pre</button>
				
			</div>

		</div>
		
		<button type="button" id="myBtn2" class="b12" style="background-color:#fa8072;">
		Whiskey</button>

		<div id="myModal2" class="modal">

			<div class="modal-content">
				<span class="close">&times;</span>
				
				<button type="submit" class="b1" style="background-color:#fa8072;"
				value="Whiskey Glass Regular" name="whiskeyGlsR">Whiskey Gls Reg</button>
				<button type="submit" class="b1" style="background-color:#fa8072;"
				value="Whiskey Glass Premium" name="whiskeyGlsP">Whiskey Gls Pre</button>
				<button type="submit" class="b1" style="background-color:#fa8072;"
				value="Whiskey Bottle Regular" name="whiskeyBtlR">Whiskey Btl Reg</button>
				<button type="submit" class="b1" style="background-color:#fa8072;"
				value="Whiskey Bottle Premium" name="whiskeyBtlP">Whiskey Btl Pre</button>	
				
			</div>

		</div>
		
		<button type="button" id="myBtn2" class="b12" style="background-color:#CD5C5C;">
		IBM Cocktails</button>

		<div id="myModal3" class="modal">

			<div class="modal-content">
				<span class="close">&times;</span>
				
				<button type="submit" class="b1" style="background-color:#CD5C5C;"
				value="Pina Colada" name="pina">Pina Colada</button>
				<button type="submit" class="b1" style="background-color:#CD5C5C;"
				value="Mojito" name="mojito">Mojito</button>
				<button type="submit" class="b1" style="background-color:#CD5C5C;"
				value="Gin Basil" name="ginBasil">Gin Basil</button>
				<button type="submit" class="b1" style="background-color:#CD5C5C;"
				value="Margarita" name="margarita">Margarita</button>
				<button type="submit" class="b1" style="background-color:#CD5C5C;"
				value="Flaming Lamborghini" name="lambo">Flaming Lamborghini</button>	
				<button type="submit" class="b1" style="background-color:#CD5C5C;"
				value="Bloody Mary" name="bloody">Bloody Mary</button>	
				
			</div>

		</div>
		
		<button type="button" id="myBtn2" class="b12" style="background-color:#DC143C;">
		Shots</button>

		<div id="myModal4" class="modal">

			<div class="modal-content">
				<span class="close">&times;</span>
				
				<button type="submit" class="b1" style="background-color:#DC143C;"
				value="Tequila Silver Shot" name="teqSilver">Tequila Silver Shot</button>
				<button type="submit" class="b1" style="background-color:#DC143C;"
				value="Tequila Gold Shot" name="teqGold">Tequila Gold Shot</button>
				<button type="submit" class="b1" style="background-color:#DC143C;"
				value="Brain Damage Shot" name="brainDmg">Brain Damage Shot</button>
				<button type="submit" class="b1" style="background-color:#DC143C;"
				value="B-52 Shot" name="b52">B-52 Shot</button>
				<button type="submit" class="b1" style="background-color:#DC143C;"
				value="Sambuca Black Shot" name="samBlack">Sambuca Black Shot</button>
				<button type="submit" class="b1" style="background-color:#DC143C;"
				value="Sambuca White Shot" name="samWhite">Sambuca White Shot</button>
				
			</div>

		</div>
		
		<button type="button" id="myBtn2" class="b12" style="background-color:#B22222;">
		Virgin Drinks</button>

		<div id="myModal5" class="modal">

			<div class="modal-content">
				<span class="close">&times;</span>
				
				<button type="submit" class="b1" style="background-color:#B22222;"
				value="Water Bottle Small" name="waterS">Water Bottle Small</button>
				<button type="submit" class="b1" style="background-color:#B22222;"
				value="Lemonade" name="lemonade">Lemonade</button>
				<button type="submit" class="b1" style="background-color:#B22222;"
				value="Milkshake" name="milkshake">Milkshake</button>
				<button type="submit" class="b1" style="background-color:#B22222;"
				value="Coffee" name="coffee">Coffee</button>
				<button type="submit" class="b1" style="background-color:#B22222;"
				value="Tea" name="tea">Tea</button>
				<button type="submit" class="b1" style="background-color:#B22222;"
				value="Orange Juice" name="orange">Orange Juice</button>	
				
			</div>

		</div>
		
		<button type="button" id="myBtn2" class="b12" style="background-color:#8B0000;">
		Free Items</button>

		<div id="myModal6" class="modal">

			<div class="modal-content">
				<span class="close">&times;</span>
				
				<button type="submit" class="b1" style="background-color:#8B0000;"
				value="Free Shot" name="freeShot">Free Shot</button>
				<button type="submit" class="b1" style="background-color:#8B0000;"
				value="Free Glass" name="freeGls">Free Glass</button>
				<button type="submit" class="b1" style="background-color:#8B0000;"
				value="Free Virgin Cocktail" name="freeVirgin">Free Virgin Cocktail</button>
				<button type="submit" class="b1" style="background-color:#8B0000;"
				value="Free Coffee" name="freeCoffee">Free Coffee</button>	
				
			</div>

		</div>
	</form>
		<br>
		<div>
			
			<button class="b11" onclick="document.location='tables.php'"
			style="background-image: linear-gradient(to bottom right, #660066, cyan);"
			>Back</button>
		
			<button class="b11" onclick="document.location='closetable.php'"
			style="background-image: linear-gradient(to bottom right, white, #0000b3);"
			name="close">Close</button>
		
			<form action="connection.php" method="POST">
				<button type="submit" class="b11"
				style="background-image: linear-gradient(to bottom right, yellow, red);"
				name="delete">Delete</button>
				
			</form>
		
		</div>
	</div>
	
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

		var modal = document.getElementsByClassName("modal");
		var btn = document.getElementsByClassName("b12");
		var span = document.getElementsByClassName("close");

		// open the modal 
		btn[0].onclick = function() {
			modal[0].style.display = "block";
		}
		btn[1].onclick = function() {
			modal[1].style.display = "block";
		}
		btn[2].onclick = function() {
			modal[2].style.display = "block";
		}
		btn[3].onclick = function() {
			modal[3].style.display = "block";
		}
		btn[4].onclick = function() {
			modal[4].style.display = "block";
		}
		btn[5].onclick = function() {
			modal[5].style.display = "block";
		}

		// close the modal with x
		span[0].onclick = function() {
			modal[0].style.display = "none";
		}
		span[1].onclick = function() {
			modal[1].style.display = "none";
		}
		span[2].onclick = function() {
			modal[2].style.display = "none";
		}
		span[3].onclick = function() {
			modal[3].style.display = "none";
		}
		span[4].onclick = function() {
			modal[4].style.display = "none";
		}
		span[5].onclick = function() {
			modal[5].style.display = "none";
		}

		// close modal
		window.onclick = function(event) {
			if (event.target == modal[0]) {
				modal[0].style.display = "none";
			}
			if (event.target == modal[1]) {
				modal[1].style.display = "none";
			}
			if (event.target == modal[2]) {
				modal[2].style.display = "none";
			}
			if (event.target == modal[3]) {
				modal[3].style.display = "none";
			}
			if (event.target == modal[4]) {
				modal[4].style.display = "none";
			}
			if (event.target == modal[5]) {
				modal[5].style.display = "none";
			}
		}
		
			
	</script>

</body>
</html>

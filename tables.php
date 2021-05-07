<?php
	session_start();
	
	if(!isset($_SESSION['username'])){
		$_SESSION['msg']="You must be logged in first!";
		header('location: login.php');
	}
	
	if(isset($_POST['logout'])){
		unset($_SESSION['username']);
		session_destroy();
		session_write_close();
		header("location: login.php");
	}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Tables</title>
        <link rel="icon" type="image/x-icon" href="cocktail.png" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>
			function getNumbers(val){
				document.getElementById("screen").value+=val;
			}
			function clearAll(){
				document.getElementById("screen").value = "";
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
            }
            input{
				margin: auto;
                padding: 12px;
                border-radius: 1em;
                font-size: 13px;
                display: block;
                box-sizing: border-box;
                width: 77%;
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
                opacity: 0.7;
                color: white;
                bottom: 0;
                left:0;
                text-align: center;
                width:100%;
                font-size: 14px;
                display: block;
            }
            .b1{
                display: inline-block;
                text-align: center;
                margin:12px auto 0 auto;
                background-color: beige;
                padding: 1vw;
                cursor: pointer;
                width:7vw;
				height: auto;
                font-family: Helvetica, Verdana, sans-serif;
                font-weight: bold;
				font-size: 2vw;
                border-radius: 10px;
				border-width: 1px;
            }
			.b11{
                display: inline-block;
                text-align: center;
                margin:12px auto 0 auto;
                background-color: red;
                padding: 1vw;
                cursor: pointer;
                width:auto;
				height: auto;
                font-family: Helvetica, Verdana, sans-serif;
                font-weight: bold;
				font-size: 2vw;
                border-radius: 10px;
				border-width: 1px;
            }
			.b12{
                display: inline-block;
                text-align: center;
                margin:12px auto 0 auto;
                background-color: green;
                padding: 1vw;
                cursor: pointer;
                width:7vw;
				height: auto;
                font-family: Helvetica, Verdana, sans-serif;
                font-weight: bold;
				font-size: 2vw;
                border-radius: 10px;
				border-width: 1px;
            }
			.h1{
                margin:auto;
                width: fit-content;
				
                color: white;
                font-size: larger;
				background-color: black;
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
			.login {
				
				background-color: #bfbfbf;
                background-size: cover;
                border-radius: 2em;
                position: relative;
                padding: 2em;
                width: 40%;
                margin: auto;
                font-size: 16px;
                font-weight: bold;
                line-height: 1.6;
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
			a:link, a:visited {
				text-decoration: none;
				background-color: white;
				background-image: linear-gradient(to bottom right, #660066, #0000b3);
				color: black;
				padding: 1vw;
				border-radius: 1em;
				margin:auto;
				width:10em;
				position:relative;
				text-align:center;
				display: block;
			}
			a:hover, a:active {
				text-decoration: none;
				background-color: grey;
			}
        </style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    </head>
    <body>
        <div class="h1">
            <h1>Enter table number</h1>
		</div>
		<div class="toTheLeft">
			<p>Logged in as: <strong><?php echo $_SESSION['username']; ?>
			</strong></p>
		</div>
        <div class="login">
            <form action="connection.php" method="POST">
                <input type="number" id="screen" placeholder="enter table number"
                        name="tblnumber"/>
				<div class="Login">		
                <button type="button" class="b1" id="btn1" onClick="getNumbers('1')" value="1">1</button>
                <button type="button" class="b1" id="btn2" onClick="getNumbers('2')" value="2">2</button>
                <button type="button" class="b1" id="btn3" onClick="getNumbers('3')" value="3">3</button>
                <button type="button" class="b1" id="btn4" onClick="getNumbers('4')" value="4">4</button>
                <button type="button" class="b1" id="btn5" onClick="getNumbers('5')" value="5">5</button>
                <button type="button" class="b1" id="btn6" onClick="getNumbers('6')" value="6">6</button>
                <button type="button" class="b1" id="btn7" onClick="getNumbers('7')" value="7">7</button>
                <button type="button" class="b1" id="btn8" onClick="getNumbers('8')" value="8">8</button>
                <button type="button" class="b1" id="btn9" onClick="getNumbers('9')" value="9">9</button>
				<br>
                <button type="button" class="b11" onClick="clearAll()">Clear</button>
				<button type="button" class="b1" id="btn0" onClick="getNumbers('0')" value="0">0</button>
                <button type="submit" id="okbtn" class="b12" name="ok"
				>OK</button>
				</div>
            </form>
			<form action="tables.php" method="POST"> 
                <!-- <p><a href="login.php?logout=1">Logout</a></p> -->
				<button type="submit" class="b11" name="logout"
				style="background-color:#000352; color: white;">Logout</button>
            </form>
        </div>
        <div class='footer'>
            <p>&copy; Copyright
                <script>document.write(new Date().getFullYear());
                </script> The Grand Finale<br>All rights reserved</p>
        </div>
		
    </body>
	
	<!--<script type="text/javascript">
		$(document).ready(function(){
			$('#screen').on('input change',function(){
				if($(this).val()!=''){
					$('#okbtn').prop('disabled',false);
				}
				else{
					$('#okbtn').prop('disabled',true);
				}
			});
		});
	</script> -->
</html>

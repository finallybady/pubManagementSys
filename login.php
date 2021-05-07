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
        <title>Welcome-Login In</title>
        <link rel="icon" type="image/x-icon" href="cocktail.png" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                margin: auto;
                font-size: 16px;
                font-weight: bold;
                line-height: 1.6;
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
            
            .Login{
                display: block;
                text-align: center;
                margin:12px auto 0 auto;
                background-color: pink;
                padding: 1em;
                cursor: pointer;
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
    <body>
        <div class="h1">
            <h1>Welcome!</h1>
        </div>
		
        <div class="login">
            <div class="h11">
            <form action="connection.php" method="POST" >
               <label for="uname">User Name: </label>
               <input type="text" placeholder="User name" name="uname"
                      required>
                <label for="pass">Password:</label>
                <input type="password" placeholder="Password" name="pass" required>
                <button type="submit" class="Login" name="login">Login</button>
            </form>
			<hr>
			<p>Don't have an account?<a href="signup.php">Sign-up</a></p>
			<p><a href="reports.php">Reports and more</a></p>
            </div>
        </div>
        <div class='footer'>
            <p>&copy; Copyright
                <script>document.write(new Date().getFullYear());
                </script> The Grand Finale<br>All rights reserved</p>
        </div>
    </body>
</html>

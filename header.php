<?php
session_start();
include_once("config.php");
include_once("lib.php");
//ini_set('max_execution_time', 300); 
$server = $_SESSION['server'];
if(!isset($_SESSION['username']) || strlen($_SESSION['username'])<1)
    header("Location: index.php");
if(!isset($_SESSION['password']) || strlen($_SESSION['password'])<1)
    header("Location: index.php");
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>
        </title>
        <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
        <link rel="stylesheet" href="css/style.css" />
        <style>
            /* App custom styles */
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">
        </script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.2.0/jquery.mobile-1.2.0.min.js">
        </script>
		<script src="js/iDB.js"></script>
    </head>

    <body onload="init()">
        <!-- Home -->
        <div data-role="page" id="page1">
            <div id="header" data-theme="a" data-role="header" data-position="fixed">
                <h2>
                    <?php echo $_SESSION['username']; ?>
                </h2>
				<div class="ui-grid-a">
	<div class="ui-block-a"><a data-role="button" onclick="window.location='mailbox.php?mailbox=INBOX'" data-icon="home" data-iconpos="left" >
                    Inbox
                </a></div>
	
	<div class="ui-block-b"><a data-role="button" onclick="window.location='todo.php'" data-icon="star" data-iconpos="left" >
                    To-Do
                </a></div>
</div>
                <a data-role="button" href="options.php" data-icon="grid" data-iconpos="left" class="ui-btn-right">
                    Options
                </a>
                
				
            </div>
            <div data-role="content">

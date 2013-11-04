<?php
session_start();

if(!isset($_SESSION['email'])){
	header('Location:index.php');
	die();
} 
 require 'web/home.tmpl.php';

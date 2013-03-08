<?php

session_start();

if ($_SESSION["valido"]!=1) {
	header("Location: Index.php");
	exit();
	}
?>
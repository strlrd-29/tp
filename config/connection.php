<?php
require_once 'dbconfig.php';

try {
	$connection = new PDO("mysql:host=$server_name;dbname=$db_name", $user_name, $password);
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
};

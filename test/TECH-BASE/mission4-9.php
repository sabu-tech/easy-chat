<?php
  $dsn='mysql:dbname=tb220600db;host=localhost';
	$user = 'tb-220600';
	$password = 'e2Jrg7mBzm';
  $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
  $sql = 'DROP TABLE tbtest';
	$stmt = $pdo->query($sql);
?>
<?php
  $dsn='mysql:dbname=tb220600db;host=localhost';
	$user = 'tb-220600';
	$password = 'e2Jrg7mBzm';
  $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
  // $id = 2;
  $id = 4;
	$sql = 'delete from tbtest where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
?>
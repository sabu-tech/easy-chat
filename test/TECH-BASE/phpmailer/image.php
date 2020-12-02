<?php
$dsn = "mysql:host=localhost; dbname=tb220600db; charset=utf8";
$username = "tb-220600";
$password = "e2Jrg7mBzm";
$id = rand(1, 5);
try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}
    $sql = "SELECT * FROM images WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $image = $stmt->fetch();
?>

<h1>画像表示</h1>
<img src="images/<?php echo $image['name']; ?>" width="300" height="300">
<a href="upload.php">画像アップロード</a>
<?php
    session_start();
    $date = date("Y/m/d H:i:s"); 
    $dsn='mysql:dbname=*******;host=localhost';
    $user = '******';
    $password = '*******';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    $sql = "CREATE TABLE IF NOT EXISTS chatDeta"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(255),"
    . "comment TEXT"
    .");";
    $stmt = $pdo->query($sql);
    $sql = $pdo -> prepare("INSERT INTO  chatDeta (name, comment) VALUES (:name,:comment)");
    $sql -> bindParam(':name', $name, PDO::PARAM_STR);
    $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
    if(isset($_POST["submitButton"])){
      $name = $_POST["username"].",".$date;//投稿した名前を変数化
      $comment = nl2br($_POST['comment']); //投稿したコメントを変数化
      $sql -> execute();
    }
    echo "<h1>掲示板</h1>";
    $name= $_POST["username"];
    $userpassword = $_POST["userpassword"];
    //投稿フォーム
    print'<form action="" method="post">';
      print'<input type="hidden"  name="username"  value="'.$name.'">';
      print'コメント：<textarea name="comment" cols="100" rows="2" maxlength="20"></textarea>';
      print'<input type="hidden" name="userpassword" value="'.$userpassword.'">';
      print'<input type="submit" name="submitButton" value="投稿">';
    print'</form>';
    $sql = 'SELECT * FROM chatDeta';//入力したでデータコードを表示する
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
      //$rowの中にはテーブルのカラム名が入る
      //それぞれを出力
      echo $row['id'].',';
      echo $row['name'].'<br>';
      echo $row['comment'].'<br>';
      echo "<hr>";
    }
    ?>

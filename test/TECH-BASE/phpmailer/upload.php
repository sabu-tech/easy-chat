<?php
require_once('config.php');
//データベースへ接続、テーブルがない場合は作成
try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec("create table if not exists userDeta(
      id int not null auto_increment primary key,
      image varchar(255),
      name varchar(255),
      created timestamp not null default current_timestamp
    )");
} catch (PDOException $e) {
  echo $e->getMessage();
}
  if (isset($_POST['upload'])) {//送信ボタンが押された場合
      $image = uniqid(mt_rand(), true);//ファイル名をユニーク化
      $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
      $file = "images/$image";
      $sql = "INSERT INTO images(name) VALUES (:name)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':image', $image, PDO::PARAM_STR);
      if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
          move_uploaded_file($_FILES['image']['tmp_name'], './images/' . $image);//imagesディレクトリにファイル保存
          if (exif_imagetype($file)) {//画像ファイルかのチェック
              $message = '画像をアップロードしました';
              $stmt->execute();
          } else {
              $message = '画像ファイルではありません';
          }
      }
  }
?>

<h1>画像アップロード</h1>
<!--送信ボタンが押された場合-->
<?php if (isset($_POST['upload'])): ?>
  <p><?php echo 'aaa'; ?></p>
  <p><a href="image.php">画像表示へ</a></p>
<?php else: ?>
  <form method="post" enctype="multipart/form-data">
      <p>アップロード画像</p>
      <input type="file" name="image">
      <button><input type="submit" name="upload" value="送信"></button>
  </form>
<?php endif;?>
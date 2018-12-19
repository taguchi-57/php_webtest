<?php
//セッションの開始
session_start();
require_once("../lib/util.php");
//文字エンコードのチェック
if (!cken($_POST)) {
  //mb_internal_encoding現在の内部エンコーディングを表示
  $encoding = mb_internal_encoding();
  $err = "Encoding Error! The expected encoding is" . $encoding;
  //エラーメッセージを出して、以下のコードを全てキャンセルする
  exit($err);
}
//HTMLエスケープ（XSS対策）
$_POST = es($_POST);
?>

<?php
//データベースユーザ
$user = 'root';
$DBpassword = 'root';
//利用するデータベース
$DBName = 'testlogin';
//MySQLサーバー
$host = 'localhost:8889';
//MySQLのDSN文字列
$dsn = "mysql:host={$host};dbname={$DBName};charset=utf8";
?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>ユーザーネームの変更ページ<?php echo $_SESSION["loginname"] ?></title>
</head>
<body>
  <form action="username_changed.php" method="post">
    <ul>
      <li>新しいユーザー名:<input type="text" name="change_username" placeholder="新しいユーザー名"></li>
      <li><input type="submit" name="" value="新しいユーザーネームに変更する"> </li>
    </ul>
  </form>
</body>
</html>

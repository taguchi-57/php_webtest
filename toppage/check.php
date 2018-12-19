<?php
//セッションスタート
session_start();//セッションを開始します
?>

<?php
//文字エンコードの検証
if (!cken($_POST)) {
  $encoding = mb_internal_encoding();
  $err = "Encoding Error! The expected encoding is" . $encoding;
  //エラーメッセージを出して、以下のコードを全てキャンセルする
  exit($err);
}
//HTMLエスケープ(XSS対策)
$_POST = es($_POST);
?>

<?php
$_SESSION['username'] = $_POST['username'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['password'] = $_POST['password'];
?>






<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>入力確認</title>
  </head>
  <body>
    <div>
      <p><form action="send.php" method="POST"></p>

    </div>

  </body>
</html>

<?php
class connect2testlogin {
  //データベースの接続設定は変数のように変える必要なし
  //よって定数を使ってみる
  //データベースユーザー
  const USER = 'root';
  const DBpassword = 'root'
  const DB_NAME = 'testlogin';
  const HOST = 'localhost:8889';
  //const UTF = 'utf8';
  //データベースに接続する関数
  function pdo(){
    $dsn = "mysql:dbname="self::DB_NAME";host="self::HOST";charset"self::UTF;
    $user = self::USER;
    $pass = self::PASS;
    try {
      $pdo = new PDO($dsn, $user, $pass);
    } catch (\Exception $e) {
      echo 'error';
      $e ->getMessage();
    }
  }
}
?>

<?php
//セッションの開始
session_start();
require_once("../lib/util.php");
//文字エンコードのチェック
if (!cken($_POST)) {
  //mb_internal_encoding現在の内部エンコーディングを表示
  $encoding = mb_internal_encoding();
  $err = "Encoding Error! The expected emcoding is" . $encoding;
  //エラーメッセージを出して、以下のコードを全てキャンセルする
  exit($err);
}
//HTMLエスケープ（XSS対策）
$_POST = es($_POST);
?>

<?php
$_SESSION["newloginname"] = $_POST["change_username"];
?>

<?php
//データベースユーザー
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
    <title>ユーザーネーム変更完了ページ<?php echo $_SESSION["loginname"] ?></title>
  </head>
  <body>
    <?php
    $newloginname = $_SESSION["newloginname"];
    $loginname = $_SESSION["loginname"];
    //プリペアドステートメントのエミュレーションを無効にする
  try {
     $pdo = new PDO($dsn, $user, $DBpassword);
     //プリペアドステートメントのエミュレーションを無効にする
     $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
     //例外がスローされる設定にする
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     echo "データベース{$DBName}に接続しました。", "<br>";
     //SQL文を作る（プレースホルダーを使った式）
     $sql = "UPDATE login SET loginname = :newloginname WHERE loginname = :loginname";
     //SQL文を作る（プレースホルダーを使った式）
     $stm = $pdo->prepare($sql);
     //プレースホルダーに値をバインドする
     $stm->bindValue(':newloginname', $newloginname, PDO::PARAM_STR);
     $stm->bindValue(':loginname', $loginname, PDO::PARAM_STR);
     //SQL文を実行する
     if ($stm->execute()) {//SQL文を実行します
       //レコードの変更後のリストを取得する
       $sql = "SELECT * FROM login";
       //プリペアドステートメント
       $stm = $pdo->prepare($sql);
       //SQL文を実行する
       $stm->execute();
       //結果の取得（連想配列で受け取る）
       $result = $stm->fetchAll(PDO::FETCH_ASSOC);//レコードを追加する
       //テーブルのタイトル行
       echo "<table>";
       echo "<thead><tr>";
       echo "<th>", "id", "</th>";
       echo "<th>", "ログイン名", "</th>";
       echo "<th>", "メール", "</th>";
       echo "<th>", "パスワード", "</th>";
       echo "</th></thead>";
       //値を取り出して行を表示する
       echo "<tbody>";
       foreach ($result as $row) {
         //1行ずつテーブルに入れる
         echo "<tr>";
         echo "<td>", es($row['id']), "</td>";
         echo "<td>", es($row['loginname']), "</td>";
         echo "<td>", es($row['mail']), "</td>";
         echo "<td>", es($row['password']), "</td>";
         echo "</tr>";
       }
       echo "</tbody>";
       echo "</table>";
     } else {
       echo '<span class="error">追加エラーがありました</span><br>';
     };
   } catch (\Exception $e) {
     echo '<span class="error">エラーがありました</span><br>';
     echo $e->getMessage();
   }
  ?>
  <hr>
  <p><a href="../toppage/top.html">topに戻る</a></p>
  <p><a href="username_change.php">もう一度変更</a></p>
  </body>
</html>

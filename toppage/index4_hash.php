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
$_SESSION["loginname"] = $_POST["username"];
$_SESSION["mail"] = $_POST["mail"];
$_SESSION["password"] = $_POST["password"];
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
  <title></title>
</head>
<body>
  <div>
    <?php
    $loginname = $_SESSION["loginname"];
    $mail = $_SESSION["mail"];
    $password = $_SESSION["password"];
    //ハッシュ化
    $password = password_hash($password, PASSWORD_DEFAULT);
    //MySQlデータベースに接続する
    try {
      $pdo = new PDO($dsn, $user, $DBpassword);
      //プリペアドステートメントのエミュレーションを無効にする
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      //例外がスローされる設定にする
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "データベース{$DBName}に接続しました。", "<br>";
      //SQL文を作る（プレースホルダーを使った式）
      $sql = "INSERT INTO login (loginname, mail, password) VALUES (:loginname, :mail, :password)";
      //プリペアドステートメントを作る
      $stm = $pdo->prepare($sql);
      //プレースホルダーに値をバインドする
      $stm->bindValue(':loginname', $loginname, PDO::PARAM_STR);
      $stm->bindValue(':mail', $mail ,PDO::PARAM_STR);
      $stm->bindValue(':password', $password ,PDO::PARAM_STR);
      //SQL文を実行する
      if ($stm->execute()) {//SQL文を実行します
        //レコード追加後のリストを取得する
        $sql = "SELECT * FROM login";
        //プリペアドステートメント
        $stm = $pdo->prepare($sql);
        //SQL文を実行する
        $stm->execute();
        //結果の取得（連想配列で受け取る）
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);//レコードを追加するSQL文が成功したならば全てのレコードを表示します
        //テーブルのタイトル行
        echo "<table>";
        echo "<thead><tr>";
        echo "<th>", "id", "</th>";
        echo "<th>", "ログイン名", "</th>";
        echo "<th>", "メール", "</th>";
        echo "<th>", "パスワード", "</th>";
        echo "</th></thead>";
        //値を取り出して行に表示する
        echo "<tbody>";
        foreach ($result as $row) {
          //１行ずつテーブルに入れる
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
    <p><a href="<?php echo "top.html" ?>">戻る</a></p>
    <p><a href="<?php echo "username_change.php" ?>">パスワード変更画面</a></p>
  </div>
</body>
</html>

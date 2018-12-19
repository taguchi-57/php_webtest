<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>メールアドレスの形式をチェックしたい</title>
  </head>
  <body>
    <div>
      <?php
      //libを読み込む
      require_once ('../lib/util.php');

      if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $pattern = '/¥A([a-z0-9_¥-¥+¥/¥?]+)(¥.[a-z0-9_¥-¥+¥/¥?]+)*' .
                   '@([a-z0-9¥-]+¥.)+[a-z]{2.6}¥z/i';
        if (preg_match($pattern,$email)) {
          echo "<p>『" . es($email) . '」はメールアドレスとして正しい形です。</p>';
        } else {
          echo '<p>「' . es($email) . '」はメールアドレスとして正しい形式ではありません';
        }
      }
      ?>
      <form action="210.php" method="post">
        <p>メールアドレスを入力してください</p>
        <input type="email" name="email" value="">
        <input type="submit" value="確認する">
      </form>
    </div>
  </body>
</html>

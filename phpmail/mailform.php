<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
  <meta charset="utf-8">
  <script type="text/javascript"></script>
  <title></title>
</head>
<body>
  <form action="./mail.php" method="POST">
    <p>受信者</p><input type="text" name="to" value="">
    <p>タイトル</p><input type="text" name="title" value="">
    <p>本文</p><textarea name="content" rows="10" cols="50"></textarea>
    <input type="submit" name="send" value="送信">
  </form>
</body>
</html>

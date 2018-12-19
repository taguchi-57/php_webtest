<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
        mb_language("japanese");
        mb_internal_encoding("UTF-8");

        $to = $_POST['to'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        if (mb_send_mail($to, $title, $content)) {
          echo "メールを送信しました";
        } else {
          echo "メールの送信に失敗しました";
        }
     ?>

  </body>
</html>

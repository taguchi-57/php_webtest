<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>日付や時刻の一部を取り出して扱いたい</title>
  </head>
  <body>
    <div>
      <p>現在の日時から要素別に表示</p>
      <?php
      //現在の日時から要素を取得します
      $today = getdate();
      echo "<p>";
      echo $today;
      //現在の日時を要素別に表示します
      echo "年" . $today['year'] . '<br>';
      echo "月:" . $today['mon'] . '<br>';
      echo "日:" . $today['mday'] . '<br>';
      echo "曜日:" . $today['wday'] . '<br>';
      echo "時:" . $today['hours'] . '<br>';
      echo "分:" . $today['minutes'] . '<br>';
      echo "秒:" . $today['seconds'] . '<br>';
      echo "1月1日からの日数" . $today['yday'] . '<br>';
      echo "</p>";

      echo "<p>過去のタイムラインのスタンプから要素別に表示";
      $past = strtotime('2009-07-30 12:40:50');
      echo "過去のタイムスタンプ:" . $past . '<br>';
      //過去のタイムスタンプから要素を取得します
      $past = getdate($past);

      echo "年:" . $past['year'] . '<br>';
      echo "月:" . $past['month'] . '<br>';
      echo "日:" . $past['mday'] . '<br>';
      echo "曜日:" . $past['weekday'] . '<br>';
      echo "時:" . $past['hours'] . '<br>';
      echo "分:" . $past['minutes'] . '<br>';
      echo "秒:" . $past['seconds'] . '<br>';
      echo "1月1日からの日数:" . $past['yday'] . '<br>';



       ?>
    </div>

  </body>
</html>

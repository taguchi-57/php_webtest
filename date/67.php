<?php
$now = new DateTime('2013-04-03');
echo $now->format('Y年m月d日');
 ?>

<?php
$now = new DateTime();
$now->add(DateInterval::createFromDateString('任意の数　加減算する単位'));
echo "$now->format('表示形式')";
 ?>

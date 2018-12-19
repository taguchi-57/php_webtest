<?php
//XSS対策のためのhtmlエスケープ
function es($data, $charset="UTF-8"){
  //$dataが配列の時
  if (is_array($data)) {
    //再帰呼び出し
    return array_map(__METHOD__, $data);
  } else {
    //HTMLエスケープ
    return htmlspecialchars($data,ENT_QUOTES, $charset);
  }
}
function cken(array $data) {
  $result = true;
  foreach ($data as $key => $value) {
    if (is_array($value)) {
      //含まれている値が配列の時文字列に直結する
      $value = implode("", $value);//配列に入っている値を連結したストリングにします
    }
    if (!mb_check_encoding($value)) {
      //文字エンコードが一致しない時
      $result = false;
      //foreachでの走査をブレイクする
      break;
    }
  }
  return $result;
}
?>

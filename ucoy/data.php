
<meta charset="utf-8">
<?php

$link = mysql_connect('localhost:3307', 'admin', 'MinaMi0319');
if (!$link) {
	die('MySQL接続エラー(南のローカルサーバー上でしか動かないよ ><;)' . mysql_error());
}

$db_selected = mysql_select_db('goty', $link);
if (!$db_selected) {
	die('MySQLデータベース接続エラー' . mysql_error());
}

mysql_set_charset('utf8');

$sql1 = 'SELECT id, shimei, shozoku, gakunen, tel, email, suisenbun from tbl_jisen';
$result1 = mysql_query($sql1);

if (!$result1) {
	die('INSERTクエリーが失敗しました1。' . mysql_error());
}

echo '自薦者一覧<br>';
while ($row = mysql_fetch_assoc($result1)) {
	print($row['id'] . ' : ');
	print($row['shimei'].'<br>');
	print($row['shozoku'].'<br>');
	print($row['gakunen'].'<br>');
	print($row['tel'].'<br>');
	print($row['email'].'<br>');
	print($row['suisenbun'].'<br>');
	print('<br><br>');
}

$sql2 = 'SELECT id, shimei, shozoku, gakunen, tel, email, jisseki from tbl_tasen';
$result2 = mysql_query($sql2);

if (!$result2) {
	die('INSERTクエリーが失敗しました2。' . mysql_error());
}

echo '他薦者一覧<br>';
while ($row = mysql_fetch_assoc($result2)) {
	print($row['id'] . ' : ');
	print($row['shimei'].'<br>');
	print($row['shozoku'].'<br>');
	print($row['gakunen'].'<br>');
	print($row['tel'].'<br>');
	print($row['email'].'<br>');
	print($row['jisseki'].'<br>');
	print('<br><br>');
}

mysql_close($link);

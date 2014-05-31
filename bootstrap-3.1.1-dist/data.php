
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

echo '自薦者一覧\n';
while ($row = mysql_fetch_assoc($result1)) {
	print($row['id'] . ' : ');
	print($row['shimei'].'\n');
	print($row['shozoku'].'\n');
	print($row['gakunen'].'\n');
	print($row['tel'].'\n');
	print($row['email'].'\n');
	print($row['suisenbun'].'\n');
	print('\n');
}

$sql2 = 'SELECT id, shimei, shozoku, gakunen, tel, email, jisseki from tbl_tasen';
$result2 = mysql_query($sql2);

if (!$result2) {
	die('INSERTクエリーが失敗しました2。' . mysql_error());
}

echo '他薦者一覧\n';
while ($row = mysql_fetch_assoc($result2)) {
	print($row['id'] . ' : ');
	print($row['shimei'].'\n');
	print($row['shozoku'].'\n');
	print($row['gakunen'].'\n');
	print($row['tel'].'\n');
	print($row['email'].'\n');
	print($row['jisseki'].'\n');
	print('\n');
}

mysql_close($link);

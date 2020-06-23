<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>サンプル</title>
</head>

<body>

<?php

try
{

//<--1.データベースに接続（PDO）-->
//staff_add_doneと同じ
$dsn = 'mysql:dbname=shop;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');

$sql = 'SELECT code,name FROM mst_staff WHERE 1';
//「スタッフの名前を全て取り出せ」
$stmt = $dbh->prepare($sql);
$stmt->execute();

$dbh = null;

print 'スタッフ一覧<br/><br/>';

print'<form method="post" action="staff_edit.php">';
//修正画面へ飛べるように
while(true)
{
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    //$stmtから1レコード取り出す
    if($rec==false)
    {
        break;
        //もうデータが無ければ、ループから脱出
    }
    print'<input type="radio" name="staffcode" value="'.$rec['code'].'">';
    print $rec['name'];
    print '</br>';
}

}
catch (Exception $e)
{
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>

</body>

</html>
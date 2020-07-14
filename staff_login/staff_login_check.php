<?php

try
{

    //前の画面で入力されたデータ（「form」=>「postメソッド」の中）を$_POST（POSTリクエスト）で取り出し、変数にコピー
    //・GETリクエスト：データがURLにも引き渡される
    //・POSTリクエスト：データがURLには引き渡されない
    //よって、パスワード等を含む場合は「POSTリクエスト」を使用
    $staff_code = $_POST['code'];
    $staff_pass = $_POST['pass'];

    //サニタイジング（Sanitizing、無害化、セキュリティ対策）
    $staff_code = htmlspecialchars($staff_code);
    $staff_pass = htmlspecialchars($staff_pass);

    $staff_pass = md5($staff_pass);
    //「md5」はパスワードの暗号化
    //「hidden」typeを使うとしてもソースコードでは見えてしまう


//<--1.データベースに接続（PDO）-->
//staff_add_doneと同じ
$dsn = 'mysql:dbname=shop;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');

//<--2.SQL文指令-->
$sql = 'SELECT name FROM mst_staff WHERE code=? AND password=?';
//「スタッフの名前とパスワードを取り出せ」
$stmt = $dbh->prepare($sql);
    $data[] = $staff_code;
    $data[] = $staff_pass;
    $stmt->execute($data);

//<--3.データベースから切断-->
$dbh = null;

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    //$stmtから1レコード取り出す
    if($rec==false)
    {
        print'スタッフコードかパスワードが間違っています。<br />';
        print'<a href="staff_login.html">戻る</a>';
    }else{
        header('Location: staff_top.php');

    }

}
catch (Exception $e)
{
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}

?>
<?php
session_start();
// 自動で合言葉を設定
session_regenerate_id(true);
//合言葉を毎回変更
if (isset($_SESSION['member_login']) == false) {
    print 'ようこそゲスト様　';
    print '<a href="member_login.html">会員ログイン</a><br />';
    print '<br />';
} else {
    print 'ようこそ';
    print $_SESSION['member_name'];
    print '様';
    print '<a href="member_logout.php">ログアウト</a><br />';
    print '<br />';
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>サンプル</title>
</head>

<body>


    <?php

    try {

        $cart = $_SESSION['cart'];
        //保管していたカートの中身を戻す
        $max=count($cart);

        //<<--1.データベースに接続（PDO）-->>
        //pro_add_doneと同じ
        $dsn = 'mysql:dbname=shop;host=localhost';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->query('SET NAMES utf8');

        foreach ($cart as $key => $val) {
        //<<--2.SQL文指令-->>
        $sql = 'SELECT code,name,price,image FROM mst_product WHERE code=?';
        //1件のレコードに絞られる為、この後whileループは使わない
        $stmt = $dbh->prepare($sql);
        $data[0] = $val;
        $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            //$stmtから1レコード取り出す
            $pro_name[] = $rec['name'];
            $pro_price[] = $rec['price'];

            if($rec['image'] == '') {
                $pro_image[] = '';
            } else {
                $pro_image[] = '<img src="../product/image/' . $rec['image'] . '">';
                //もし画像があれば、表示するためのHTMLタグを準備
            }
        }

        //<<--3.データベースから切断-->>
        $dbh = null;




    } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしております。';
        exit();
    }

    ?>

    <form>
        <input type="button" onclick="history.back()" value="戻る">
    </form>

</body>

</html>
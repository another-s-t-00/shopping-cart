<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>サンプル</title>
</head>

<body>


    <?php

    try {

        $pro_code = $_GET['procode'];
        //入力枠からではない為、サニタイジングは不必要

        //<<--1.データベースに接続（PDO）-->>
        //pro_add_doneと同じ
        $dsn = 'mysql:dbname=shop;host=localhost';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->query('SET NAMES utf8');

        //<<--2.SQL文指令-->>
        $sql = 'SELECT name,price FROM mst_product WHERE code=?';
        //1件のレコードに絞られる為、この後whileループは使わない
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_code;
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        //$stmtから1レコード取り出す
        $pro_name = $rec['name'];
        $pro_price = $rec['price'];

        //<<--3.データベースから切断-->>
        $dbh = null;
    } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしております。';
        exit();
    }

    ?>

    商品情報参照<br />
    <br />
    商品コード<br />
    <?php print $pro_code; ?>
    <br />
    商品名<br />
    <?php print $pro_name; ?>
    <br />
    価格<br />
    <?php print $pro_price; ?>円
    <br />
    <br />
    <form>
        <input type="button" onclick="history.back()" value="戻る">
    </form>

</body>

</html>
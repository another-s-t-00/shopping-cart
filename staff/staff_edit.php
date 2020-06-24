<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>サンプル</title>
</head>

<body>


    <?php

    try {

        $staff_code = $_POST['staffcode'];
        //入力枠からではない為、サニタイジングは不必要

        //<<--1.データベースに接続（PDO）-->>
        //staff_add_doneと同じ
        $dsn = 'mysql:dbname=shop;host=localhost';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->query('SET NAMES utf8');

        //<<--2.SQL文指令-->>
        $sql = 'SELECT name FROM mst_staff WHERE code=?';
        //1件のレコードに絞られる為、この後whileループは使わない
        $stmt = $dbh->prepare($sql);
        $data[] = $staff_code;
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        //$stmtから1レコード取り出す
        $staff_name = $rec['name'];

        //<<--3.データベースから切断-->>
        $dbh = null;
    } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしております。';
        exit();
    }

    ?>

    スタッフ修正<br />
    <br />
    スタッフコード<br />
    <?php print $staff_code; ?>
    <br />
    <br />
    <form method="post" action="staff_edit_check.php">
        <input type="hidden" name="code" value="<?php print $staff_code; ?>">
        スタッフ名<br />
        <input type="text" name="name" style="width:200px" value="<?php print $staff_name; ?>"><br />
        <!-- 名前は入力済み -->
        パスワードを入力してください。<br />
        <input type="password" name="pass" style="width:100px"><br />
        パスワードをもう１度入力してください。<br />
        <input type="password" name="pass2" style="width:100px"><br />
        <br />
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>
    <input type="" name="name" style="width:200px" value="<?php print $staff_name; ?>"><br />

    <br />
    <br />
    <br />
    <br />
    <br />
    <br />



</body>

</html>
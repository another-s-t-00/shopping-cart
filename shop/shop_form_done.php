<?php
session_start();
// 自動で合言葉を設定
session_regenerate_id(true);
//合言葉を毎回変更
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>

    <?php

    try{

    require_once('../common/common.php');
    //インクルードする（読み込む）

    $post = sanitize($_POST);

    //前の画面で入力されたデータ（「form」=>「postメソッド」の中）を$_POST（POSTリクエスト）で取り出し、変数にコピー
    //・GETリクエスト：データがURLにも引き渡される
    //・POSTリクエスト：データがURLには引き渡されない
    //よって、パスワード等を含む場合は「POSTリクエスト」を使用
    $onamae = $post['onamae'];
    $email = $post['email'];
    $postal1 = $post['postal1'];
    $postal2 = $post['postal2'];
    $address = $post['address'];
    $tel = $post['tel'];


    print $onamae . '様<br/>';
    print 'ご注文ありがとうございました。<br/>';
    print $email . 'にメールをお送りしましたのでご確認ください。<br/>';
    print '商品は以下の住所に発送させていただきます。<br/>';
    print $postal1 . '-' . $postal2 . '<br/>';
    print $address . '<br/>';
    print $tel . '<br/>';

        $honbun = '';
        $honbun .= $onamae . "様\n\nこの度はご注文ありがとうございました。\n";
        $honbun .= "\n";
        $honbun .= "ご注文商品\n";
        $honbun .= "-------------------\n";

        $cart = $_SESSION['cart'];
        $quantity = $_SESSION['quantity'];
        //保管していたカートの中身を戻す
        $max = count($cart);

        //<<--1.データベースに接続（PDO）-->>
        $dsn = 'mysql:dbname=shop;host=localhost';
        $user = 'root';
        $password = '';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->query('SET NAMES utf8');

        for ($i = 0; $i < $max; $i++) {

            //<<--2.SQL文指令-->>
            $sql = 'SELECT name,price FROM mst_product WHERE code=?';
            //1件のレコードに絞られる為、この後whileループは使わない
            $stmt = $dbh->prepare($sql);
            $data[0] = $cart[$i];
            $stmt->execute($data);

            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            //$stmtから1レコード取り出す

            $name = $rec['name'];
            $price = $rec['price'];
            $suryo = $quantity[$i];
            $shokei = $price*$suryo;

            $honbun .= $name .'';
            $honbun .= $price .'円 x';
            $honbun .= $suryo .'個 =';
            $honbun .= $shokei . "円 \n";
        }

        //<<--3.データベースから切断-->>
        $dbh = null;

        $honbun .= "送料は無料です。\n";
        $honbun .= "-------------------\n";
        $honbun .= "\n";
        $honbun .= "代金は以下の口座にお振込ください。\n";
        $honbun .= "ろくまる銀行 やさい支店 普通口座 1234567\n";
        $honbun .= "入金確認が取れ次第、梱包、発送させていただきます。\n";
        $honbun .= "\n";

        $honbun .= "□□□□□□□□□□□□□□□□□□\n";
        $honbun .= "　～安心野菜のろくまる農園～\n";
        $honbun .= "\n";
        $honbun .= "〇〇県六丸郡六丸村123-4\n";
        $honbun .= "電話 090-6060-xxxx\n";
        $honbun .= "メール info@rokumarunouen.co.jp\n";
        $honbun .= "□□□□□□□□□□□□□□□□□□\n";
        // print '<br/>';
        // print nl2br($honbun);

        $title = 'ご注文ありがとうございます。';
        $header = 'From: info@rokumarunouen.co.jp';
        $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
        mb_language('Japanese');
        mb_internal_encoding('UTF-8');
        mb_send_mail($email, $title, $honbun, $header);

        $title = 'お客様からご注文がありました。';
        $header = 'From: '. $email;
        $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
        mb_language('Japanese');
        mb_internal_encoding('UTF-8');
        mb_send_mail('info@rokumarunouen.co.jp', $title, $honbun, $header);

    } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしております。';
        exit();
    }

    ?>

</body>

</html>
<?php
//<<--セッションを開始-->>
session_start();
//自動で合言葉を設定
session_regenerate_id(true);
//合言葉を毎回変更

//<<--共通関数を読み込む-->>
require_once('../common/common.php');
//インクルードする（読み込む）

$post = sanitize($_POST);

$max = $post['max'];
//商品の種類の数をコピー
for ($i = 0; $i < $max; $i++) {
    //商品の数だけ回るforループ
    $quantity[] = $post['quantity' . $i];
    //前の画面で入力された数量を、配列に入れていく
}

$cart=$_SESSION['cart'];

for ($i = $max; 0 <= $i; $i--) {
    //商品の数だけ逆から回るforループ
    if (isset($_POST['delete'.$i]) == true) {
        array_splice($cart, $i, 1);
        array_splice($quantity, $i, 1);
    }
}

$_SESSION['cart'] = $cart;
$_SESSION['quantity'] = $quantity;
//セッションに保管

header('Location:shop_cartlook.php');
?>
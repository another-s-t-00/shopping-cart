<?php

if (isset($_POST['disp']) == true) {
    if (isset($_POST['procode']) == false) {
        header('Location: pro_ng.php');
        //スタッフが選択されてなければエラー
    }
    $pro_code = $_POST['procode'];
    header('Location: pro_disp.php?procode=' . $pro_code);
    //スタッフ参照画面へ飛ぶ
    //※飛ばす前に何かを表示してしまうと、飛ばなくなる
}

if (isset($_POST['add']) == true) {
    header('Location: pro_add.php');
    //スタッフ追加画面へ飛ぶ
}

if (isset($_POST['edit']) == true) {
    if (isset($_POST['procode']) == false)
    {
        header('Location: pro_ng.php');
    }
    $pro_code=$_POST['procode'];
    header('Location: pro_edit.php?procode='.$pro_code);
    //スタッフ修正画面へ飛ぶ
}

if (isset($_POST['delete']) == true) {
    if (isset($_POST['procode']) == false)
    {
        header('Location: pro_ng.php');
    }
    $pro_code=$_POST['procode'];
    header('Location: pro_delete.php?procode='.$pro_code);
    //スタッフ削除画面へ飛ぶ
}

?>
<?php

if (isset($_POST['add']) == true) {
    header('Location: staff_add.php');
}


if (isset($_POST['edit']) == true) {
    if (isset($_POST['staffcode']) == false)
    {
        header('Location: staff_ng.php');
    }
    $staff_code=$_POST['staffcode'];
    header('Location: staff_edit.php?staffcode='.$staff_code);
    //スタッフ修正画面へ飛ぶ
    //※飛ばす前に何かを表示してしまうと、飛ばなくなる
}

if (isset($_POST['delete']) == true) {
    if (isset($_POST['staffcode']) == false)
    {
        header('Location: staff_ng.php');
    }
    $staff_code=$_POST['staffcode'];
    header('Location: staff_delete.php?staffcode='.$staff_code);
    //スタッフ削除画面へ飛ぶ
}

?>
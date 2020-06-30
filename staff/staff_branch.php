<?php

if (isset($_POST['edit']) == true) {
    header('Location: staff_edit.php');
    //スタッフ修正画面へ飛ぶ
    //※飛ばす前に何かを表示してしまうと、飛ばなくなる
}

if (isset($_POST['delete']) == true) {
    header('Location: staff_delete.php');
    //スタッフ削除画面へ飛ぶ
}

?>
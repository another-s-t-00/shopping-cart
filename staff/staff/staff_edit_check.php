<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>サンプル</title>
</head>
<body>

<?php

//前の画面で入力されたデータ（「form」=>「postメソッド」の中）を$_POST（POSTリクエスト）で取り出し、変数にコピー
//・GETリクエスト：データがURLにも引き渡される
//・POSTリクエスト：データがURLには引き渡されない
//よって、パスワード等を含む場合は「POSTリクエスト」を使用
$staff_code=$_POST['code'];
$staff_name=$_POST['name'];
$staff_pass=$_POST['pass'];
$staff_pass2=$_POST['pass2'];

//サニタイジング（Sanitizing、無害化、セキュリティ対策）
$staff_name=htmlspecialchars($staff_name);
$staff_pass=htmlspecialchars($staff_pass);
$staff_pass2=htmlspecialchars($staff_pass2);

//1.スタッフ名チェック
//入力が成功すると、スタッフ名を出力
if($staff_name=='')
{
    print 'スタッフ名が入力されていません。<br/>';
}
else
{
    print 'スタッフ名:';
    print $staff_name;
    print '<br/>';
}

//2.パスワードチェック
//入力が成功すると、何も表示されない（セキュリティ対策）
if($staff_pass=='')
{
    print 'パスワードが入力されていません。<br/>';
}

if($staff_pass!=$staff_pass2)
{
    print 'パスワードが一致しません。<br/>';
}

//3.ボタンの作成
//どれか一つでも入力ミスがあれば、「戻る」ボタンのみ表示
if($staff_name=='' || $staff_pass=='' || $staff_pass!=$staff_pass2)
//「もしくは」は「||」で表す（OR条件）
//「かつ」は「&&」で表す（AND条件）
{
    print '<form>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    //「onclick="history.back()"」は入力したデータを消さずに前の画面に戻る
    print '</form>';
}
//入力ミスが無ければ、非公開で情報を引き連れて
//次のページへ飛ばす「OK」ボタン（submit）を追加作成
else
{
    $staff_pass=md5($staff_pass);
    //「md5」はパスワードの暗号化
    //「hidden」typeを使うとしてもソースコードでは見えてしまう
    print '<form method="post" action="staff_edit_done.php">';
    print '<input type="hidden" name="code" value="'.$staff_code.'">';
    print '<input type="hidden" name="name" value="'.$staff_name.'">';
    print '<input type="hidden" name="pass" value="'.$staff_pass.'">';
    print '<br/>';
    print '<input type="button" onclick="history.back()" value="戻る">';
    print '<input type="submit" value="OK">';
    //「submit」が、押された瞬間送信するのに対し（無条件で「form」の「action」を実行）
    //「button」は、押した時の処理を自分で記述しない限り送信されない（自分で動作を作成）
    print '</form>';
}

?>

</body>
</html>
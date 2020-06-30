<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>サンプル</title>
</head>
<body>

スタッフ追加<br/>
<br/>
<!-- 以下に「form」（意味を持たせた空間）の機能を作っていく -->
<form method="post" action="staff_add_check.php">
スタッフ名を入力してください。<br/>
<input type="text" name="name" style="width:200px"><br/>
パスワードを入力してください。<br/>
<input type="password" name="pass" style="width:100px"><br/>
パスワードをもう１度入力してください。<br/>
<input type="password" name="pass2" style="width:100px"><br/>
<br/>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</body>
</html>
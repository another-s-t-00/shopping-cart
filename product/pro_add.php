<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>サンプル</title>
</head>

<body>

    商品追加<br />
    <br />
    <!-- 以下に「form」（意味を持たせた空間）の機能を作っていく -->
    <form method="post" action="pro_add_check.php" enctype="multipart/form-data">
        商品名を入力してください。<br />
        <input type="text" name="name" style="width:200px"><br />
        価格を入力してください。<br />
        <input type="text" name="price" style="width:50px"><br />
        画像を選んでください。<br />
        <input type="file" name="image" style="width:400px"><br />
        <br />
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>

</body>

</html>
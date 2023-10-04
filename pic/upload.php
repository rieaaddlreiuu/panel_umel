<?php
ini_set('display_errors', 'On');
$db = getDb();
$dir = '../pictures/' . $usr['name'];
$nm = $usr['name'];
mkdir($dir);
if (isset($_POST['upload'])) { //送信ボタンが押された場合
    $image = uniqid(mt_rand(), true); //ファイル名をユニーク化
    $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1); //アップロードされたファイルの拡張子を取得
    $file = "../pictures/$nm/$image";
    if (!empty($_FILES['image']['name'])) { //ファイルが選択されていれば$imageにファイル名を代入
        move_uploaded_file($_FILES['image']['tmp_name'], '../pictures/' . $image); //imagesディレクトリにファイル保存
        if (exif_imagetype($file)) { //画像ファイルかのチェック
            $message = '画像をアップロードしました<br>パス : ../pictures/' . $image.'<br><img src="../pictures/'.$nm.'/' . $image.'">';
        } else {
            $message = '画像ファイルではありません';
        }
    }
}
?>

<h1>画像アップロード</h1>
<!--送信ボタンが押された場合-->
<?php if (isset($_POST['upload'])): ?>
    <p>
        <?php echo $message; ?>
    </p>
<?php else: ?>
    <form method="post" enctype="multipart/form-data">
        <p>アップロード画像</p>
        <input type="file" name="image">
        <button><input type="submit" name="upload" value="送信"></button>
    </form>
<?php endif; ?>
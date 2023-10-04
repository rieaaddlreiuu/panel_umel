<?php
ini_set('display_errors', 'On');
$db = getDb();
$dir = '../pictures/' . $usr['name'];
$nm = $usr['name'];
$w = $_POST['w'];
$h = $_POST['h'];
$name = $_POST['name'];
mkdir($dir);
if (isset($_POST['upload'])) { //送信ボタンが押された場合
    $image = uniqid(mt_rand(), true); //ファイル名をユニーク化
    $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1); //アップロードされたファイルの拡張子を取得
    $file = "../pictures/$image";
    if (!empty($_FILES['image']['name'])) { //ファイルが選択されていれば$imageにファイル名を代入
        move_uploaded_file($_FILES['image']['tmp_name'], '../pictures/' . $image); //imagesディレクトリにファイル保存
        if (exif_imagetype($file)) { //画像ファイルかのチェック
            $message = '画像をアップロードしました<br>パス : ../pictures/' . $image . '<br><img src="../pictures/' . $nm . '/' . $image . '">';
            $stt = $db->prepare('insert into panel(id, width, height, pic_path, name) values
            (:w,:h,:pic_path,:name)');
            $stt->bindValue(':w',$w);
            $stt->bindValue(':h',$h);
            $stt->bindValue(':pic_path', $file);
            $stt->bindValue(':name', $name);
            $stt->execute();
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
        幅 : <input type="number" name="w"><br>
        高さ : <input type="number" name="h"><br>
        名前 : <input type="text" name="name">
        <p>アップロード画像</p>
        <input type="file" name="image">
        <button><input type="submit" name="upload" value="送信"></button>
    </form>
<?php endif; ?>
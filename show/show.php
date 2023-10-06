<form action="./check_register.php?id=<?=$_GET['id']?>" method="POST">
<?php
require '../index.php';
require '../features/DbM.php';
$db = getDb();
$stt = $db->prepare('select * from panel where id=:id');
$stt->bindValue(':id', $_GET['id']);
$stt->execute();
$data = $stt->fetch(PDO::FETCH_ASSOC);
$n_ver = $data['width'];//横
$n_hol =$data['height'];//縦
for ($ny = 0; $ny < $n_hol; $ny++) {
                for ($nx = 0; $nx < $n_ver; $nx++) {
                    ?>
                  <input type="checkbox" name="data[]" id="<?= -1-($n_ver*$ny+$nx)?>" value="<?= -1-($n_ver*$ny+$nx)?>" hidden>
                  <?php
                }
            }
?>
<input type="submit"></form>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wanna display an input image</title>
</head>

<body>
    <p>
        result: <br>
    <div style="line-height:0;" id="result_area"></div>
    </p>
    <script>
        const result_area = document.getElementById("result_area");
        let n_ver = <?=$data['width']?>;//横
        let n_hol = <?=$data['height']?>;//縦
        result_area.innerHTML = "";

        let image = new Image();
        image.src = "<?=$data['pic_path']?>";
        image.onload = () => {
            let canvas = document.createElement("canvas");
            let context = canvas.getContext("2d");
            let splitted_width = Math.floor(image.width / n_ver);
            let splitted_height = Math.floor(image.height / n_hol);
            canvas.width = splitted_width;
            canvas.height = splitted_height;
            let htmls = "<form action='./check_register.php' method='POST' >";
            nx = 0;
            for (let ny = 0; ny < n_hol; ny++) {
                nx = 0;
                y = splitted_height * ny;
                for (let x = 0; nx < n_ver; nx++) {
                    x = splitted_width * nx;
                    context.drawImage(image, x, y, splitted_width, splitted_height, 0, 0, splitted_width, splitted_height);
                    let url = canvas.toDataURL();
                    htmls += "<img src='" + url + "' onclick='func(this)' id='"+(n_ver*ny+nx)+"' class='datas'>";
                
                }
                htmls += "<br>"
            }
            result_area.innerHTML = htmls;
          let set = document.getElementsByClassName("datas");
          for(let i=0;i<set.length;i++){
            set[i].style = "filter: invert(0.5);";
          }
        }

        function func(element) {
            if (element.value == 1) {
                element.style = "filter: invert(0.5);";
                element.value = 0;
              document.getElementById(-1-element.id).checked = "";
            } else {
                element.style = "";
                element.value = 1;
              document.getElementById(-1-element.id).checked = "checked";
            }
        }
    </script>
</body>

</html>
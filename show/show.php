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
        let n_ver = 2;//横
        let n_hol = 2;//縦
        result_area.innerHTML = "";

        let image = new Image();
        image.src = "./133306044.png";
        image.onload = () => {
            let canvas = document.createElement("canvas");
            let context = canvas.getContext("2d");
            let splitted_width = Math.floor(image.width / n_ver);
            let splitted_height = Math.floor(image.height / n_hol);
            canvas.width = splitted_width;
            canvas.height = splitted_height;
            let htmls = "";
            nx = 0;
            for (let ny = 0; ny < n_hol; ny++) {
                nx = 0;
                y = splitted_height * ny;
                for (let x = 0; nx < n_ver; nx++) {
                    x = splitted_width * nx;
                    context.drawImage(image, x, y, splitted_width, splitted_height, 0, 0, splitted_width, splitted_height);
                    let url = canvas.toDataURL();
                    htmls += "<img src='" + url + "' onclick='func(this)'>";
                }
                htmls += "<br>"
            }
            result_area.innerHTML = htmls;
        }

        function func(element) {
            if (element.value == 1) {
                element.style = "";
                element.value = 0;
            } else {
                element.style = "filter: invert(0.5);";
                element.value = 1;
            }
        }
    </script>
</body>

</html>
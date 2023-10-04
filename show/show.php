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
        分割数: 
        縦に <input type="text" id="n_vertical" size="2" value="2">分割 
        x 
        横に <input type="text" id="n_holizontal" size="2" value="2">分割
    </p>
    <p>
        <input type="file" id="input_image" accept="image/*">
        <input type="submit" id="submit" value="分割!">
    </p>
    <p>
        result: <br>
        <div id="result_area"></div>
    </p>
    <script src="./wanna_input.js"></script>
</body>
</html>
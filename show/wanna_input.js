
submit.addEventListener("click", () => {
    const object = document.getElementById("input_image");
    const submit = document.getElementById("submit");
    const select_ver = document.getElementById("n_vertical");
    const select_hol = document.getElementById("n_holizontal");
    const result_area = document.getElementById("result_area");
    const reader = new FileReader();
    let n_ver = parseInt(select_ver.value);
    let n_hol = parseInt(select_hol.value);
    let file = object.files;
    reader.readAsDataURL(file[0]);
    result_area.innerHTML = "";

    reader.onload = () => {
        let image = new Image();
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
        image.src = reader.result;
    }
})

function func(element) {
    if (element.value == 1) {
        element.style = "";
        element.value = 0;
    } else {
        element.style = "filter: invert(0.5);";
        element.value = 1;
    }
}
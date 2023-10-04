const object = document.getElementById("input_image");
const submit = document.getElementById("submit");
const select_ver = document.getElementById("n_vertical");
const select_hol = document.getElementById("n_holizontal");
const result_area = document.getElementById("result_area");
const reader = new FileReader();

submit.addEventListener("click", () => {
    let n_ver = parseInt(select_ver.value);
    let n_hol = parseInt(select_hol.value);
    let file = object.files;
    reader.readAsDataURL(file[0]);

    // result全削除
    // https://www.ikemo3.com/inverted/javascript/remove-child-elements/
    result_area.innerHTML = "";

    reader.onload = () => {
        let image = new Image();
        image.onload = () => {
            // canvasの用意
            let canvas = document.createElement("canvas");
            let context = canvas.getContext("2d");

            // 描画に小数があるとぼやけて表示されてしまうらしいので
            // 思い切って端っこは切り捨てることにした
            let splitted_width  = Math.floor(image.width  / n_hol);
            let splitted_height = Math.floor(image.height / n_ver);
            canvas.width = splitted_width;
            canvas.height = splitted_height;

            // ここで分割処理
            // https://developer.mozilla.org/ja/docs/Web/HTML/Element/td
            let table = document.createElement("table");

            for (let y = 0, ny = 0; ny < n_hol; y += splitted_height, ++ny) {
                let tr = document.createElement("tr");
                for (let x = 0, nx = 0; nx < n_ver; x += splitted_width, ++nx) {
                    // https://developer.mozilla.org/ja/docs/Web/API/Canvas_API/Tutorial/Using_images#slicing
                    context.drawImage(image, x, y, splitted_width, splitted_height, 0, 0, splitted_width, splitted_height);
                    let url = canvas.toDataURL();
                    let td = document.createElement("td");
                    td.style = "border: 1px solid;";
                    td.innerHTML = "<img src='" + url + "'>";
                    tr.appendChild(td); 
                }
                table.appendChild(tr);
            }

            // "分割した画像をまとめた表"を表示する
            // https://developer.mozilla.org/ja/docs/Web/API/Node/appendChild
            result_area.appendChild(table);
        }
        image.src = reader.result;
    }
})
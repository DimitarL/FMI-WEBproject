import { ajax_json } from './ajax.js';

let hasLectoreRole;

isLector();

if (hasLectoreRole) {
    // let btn = document.createElement("BUTTON");
    // btn.innerHTML = "Списък с присъстващи";
    // btn.id = "getFile";
    // document.getElementById("presentButton").appendChild(btn);

    document.getElementById("presentButton").style.visibility = "visible";

    document.getElementById('getFile').addEventListener('click', function() {
        let callback = function(data) {
            let a = document.createElement('a');
            let url = window.URL.createObjectURL(new Blob([data]));
            a.href = url;
            a.download = 'present.txt';
            document.body.append(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);
        }
        ajax_json("GET", "../php/get_present.php", { success: callback });
    })
} else {
    console.log("student");
}

function isLector() {
    let callback = function(msg) {
        if (msg == "1") {
            hasLectoreRole = true;
        } else {
            hasLectoreRole = false;
        }
    }
    ajax_json("GET", "../php/is_lector.php", { success: callback });
}
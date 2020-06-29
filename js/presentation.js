import { ajax_json } from './ajax.js';

document.getElementById('showPresentation').addEventListener('load', timer, false);

function timer() {

    let timer = setInterval(function() {
        showPresentation();
    }, 1000);
}

window.onload = function() {
    timer();
}

function showPresentation() {
    let callback = function(data) {
        if (data == "") {
            document.getElementById('currentPresentation').innerHTML = "В момента няма презентиращи";

        } else {
            document.getElementById('currentPresentation').innerHTML = '<a href="' + data + '"target="_blank">Линк</a>';
        }
    }
    ajax_json("GET", "../php/presentation.php", { success: callback });
}
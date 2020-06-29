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
        document.getElementById('currentPresentation').innerHTML = data;
    }
    ajax_json("GET", "../php/presentation.php", { success: callback });
}
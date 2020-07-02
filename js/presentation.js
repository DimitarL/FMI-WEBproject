import { ajax_json } from './ajax.js';

document.getElementById('showPresentation').addEventListener('load', timer, false);

function timer() {

    let timer = setInterval(function() {
        showPresentation();
    }, 1000);
}

window.onload = function() {
    addUsernameToPresentTable();
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

function addUsernameToPresentTable() {
    let callback = function(data) {
        if (data != "1") {
            alert(data);
        }
    }
    ajax_json("POST", "../php/present_manipulation.php", { success: callback });
}

function deleteUsernameFromPresentTable(link) {
    console.log("deleteUsernameFromPresentTable");
    let callback = function(data) {
        console.log(data + " data");
        if (data != "1") {
            alert(data);
        }
    }
    ajax_json("DELETE", "../php/present_manipulation.php", { success: callback });
}

function goToCalendar() {
    let redirect = "../php/calendar.php";
    deleteUsernameFromPresentTable(redirect);
}

function goToLogIn() {
    let redirect = "../php/loginStart.php";
    deleteUsernameFromPresentTable(redirect);
}
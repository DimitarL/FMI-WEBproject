import { ajax_json } from './ajax.js';
import { printStudents } from './get_present.js';
import { printContent } from './sideNotes.js';

// document.getElementById('showPresentation').addEventListener('load', timer, false);

document.getElementById('goToCalendar').addEventListener('click', goToCalendar);
document.getElementById('goToLogIn').addEventListener("click", goToLogIn);


function customTimer() {
    let timer = setInterval(function() {
        showPresentation();
        printStudents();
        printContent();
    }, 1000);
}

window.onload = function() {
    addUsernameToPresentTable();
    customTimer();
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
    let callback = function(data) {
        if (data != "1") {
            alert(data);
        } else {
            window.location = link;
        }
    }
    ajax_json("DELETE", "../php/present_manipulation.php", { success: callback });
}

function goToCalendar() {
    let redirect = "../php/calendar.php";
    deleteUsernameFromPresentTable(redirect);
}

function goToLogIn() {
    let redirect = "../index.php";
    deleteUsernameFromPresentTable(redirect);
}
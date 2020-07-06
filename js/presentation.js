import { ajax_json } from './ajax.js';
import { printStudents } from './get_present.js';
import { printContent } from './sideNotes.js';

document.getElementById('goToCalendar').addEventListener('click', goToCalendar);
document.getElementById('goToLogIn').addEventListener("click", goToLogIn);

// let topicId;

function customTimer() {
    let timer = setInterval(function() {
        showPresentation();
        printStudents();
        printContent();
    }, 1000);
}

window.addEventListener("load", function() {
    customTimer();

    setTimeout(function() {
        addToPresentTable();
    }, 1000);

}, false);

// window.onload = function() {
//     customTimer();
// addUsernameToPresentTable();
// }

function showPresentation() {
    let callback = function(data) {
        if (data == "") {
            document.getElementById('currentPresentation').innerHTML = "В момента няма презентиращи";
        } else {
            data = JSON.parse(data);
            document.getElementById("topicId").innerText = data['topicId'];
            document.getElementById("topicTitle").innerText = data['topic'];
            document.getElementById('currentPresentation').innerHTML = '<a href="' + data['presentationLink'] + '"target="_blank">Линк</a>';
        }
    }
    ajax_json("GET", "../php/presentation.php", { success: callback });
}

function addToPresentTable() {
    let callback = function(data) {
        if (data != "1" && data != "") {
            alert(data);
        }
    }
    let topicId = parseInt(document.getElementById("topicId").innerText);
    ajax_json("POST", "../php/present_manipulation.php", { success: callback }, JSON.stringify(topicId));
}

function updatePresentTable(link) {
    let callback = function(data) {
        if (data != "1") {
            console.log("UPDATE PRESENT TABLE");
            alert(data);
        } else {
            window.location = link;
        }
    }
    ajax_json("PUT", "../php/present_manipulation.php", { success: callback });
}

function goToCalendar() {
    let redirect = "../php/calendar.php";
    updatePresentTable(redirect);
}

function goToLogIn() {
    let redirect = "../index.php";
    updatePresentTable(redirect);
}

// let waitForEl = function(selector, callback) {
//     if (selector.innerHTML) {
//         callback();
//     } else {
//         waitForEl(selector, callback);
//     }
// };
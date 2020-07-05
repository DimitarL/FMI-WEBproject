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
        addUsernameToPresentTable();
    }, 1000);

    // waitForEl(document.getElementById("topicId"), function() {
    //     addUsernameToPresentTable();
    // });
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
            // topicId = data['topic'];
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
    let topicId = document.getElementById("topicId").innerText;
    console.log("TOPIC ID: " + topicId);
    ajax_json("POST", "../php/present_manipulation.php", { success: callback }, JSON.stringify(topicId));
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

let waitForEl = function(selector, callback) {
    if (selector.innerHTML) {
        callback();
    } else {
        waitForEl(selector, callback);
    }
};
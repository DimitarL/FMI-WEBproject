import { ajax, ajax_json } from './ajax.js';

const POST_METHOD = 'POST';
const GET_METHOD = 'GET';
const errorId = 'error';
const urlSessions = '../php/get_sessions.php';
const dateSectionId = 'date';
const sessionSectionId = 'session';

let callback = function(sessions) {
    for (let session of JSON.parse(sessions)) {
        addToSectionByElementId(session['day'], sessionSectionId);
    }
}

ajax_json(GET_METHOD, urlSessions, { success: callback });

document.getElementById('session').addEventListener('click', () => {
    const sessionDates = document.getElementById("date");
    while (sessionDates.firstChild) {
        sessionDates.removeChild(sessionDates.lastChild);
    };
    let session = document.getElementById('session').value;
    getAllDatesForSeesion(session);
})

document.getElementById('submitButton').addEventListener('click', () => {
    addPresentation();
})

function getAllDatesForSeesion(session) {
    let urlDates = '../php/get_dates.php';
    let callback = function(dates) {
        for (let date of JSON.parse(dates)) {
            addToSectionByElementId(date['timeDate'], dateSectionId);
        }
    };
    let input = parseInt(session);
    ajax_json(POST_METHOD, urlDates, { success: callback }, JSON.stringify(input));
}

function addToSectionByElementId(option, id) {

    let selectElement = document.getElementById(id);
    selectElement.add(new Option(option));
}

function addPresentation() {

    const sessionId = 'session';
    const dateId = 'date';
    const presentationLinkId = 'presentationLink';
    const linkRegex = /(https?:\/\/[^\s]+)/;

    if (!validateField(presentationLinkId) || !validateFieldToRegex(presentationLinkId, linkRegex) || !validateField(dateId) || !validateField(sessionId)) {
        document.getElementById(errorId).innerText = "Моля попълнете всички полета коректно.";
    } else {
        document.getElementById(errorId).innerText = "";
        let presentationLink = document.getElementById(presentationLinkId).value;
        let timeDate = document.getElementById(dateId).value;
        let data = { presentationLink, timeDate };
        insertPresentationData(data);
    }

    return false;
}

function validateField(fieldId) {
    let elementValue = document.getElementById(fieldId);
    return elementValue.value.trim() != "";
}


function validateFieldToRegex(fieldId, regex) {
    let elementValue = document.getElementById(fieldId);
    return elementValue.value.match(regex);
}

function insertPresentationData(data) {
    const urlScript = "../php/insert_presentation.php";
    let callback = function(msg) {
        if (msg == "1") {
            window.location = '../php/calendar.php';
        } else {
            document.getElementById(errorId).innerText = msg;
        }
    }
    ajax_json(POST_METHOD, urlScript, { success: callback }, JSON.stringify(data));
}
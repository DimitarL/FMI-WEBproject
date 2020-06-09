import { ajax, ajax_json } from './ajax.js';

let callback = function(dates) {
    for (let date of JSON.parse(dates)) {
        addDateToSection(date['timeDate']);
    }
};

const POST_METHOD = 'POST';
const GET_METHOD = 'GET';
const url = '../php/presentation_record.php';
const errorId = 'error';

let uploadFile;
ajax_json(GET_METHOD, url, { success: callback });

function addDateToSection(date) {
    let selectElement = document.getElementById('date');
    selectElement.add(new Option(date));
}

document.getElementById('submitButton').addEventListener('click', () => {
    addPresentation();
    // console.log("IN JS");
})

document.getElementById('cancelButton').addEventListener('click', () => {
    // window.location.href = '../calendar.html';
})

function addPresentation() {
    // let username = $_SESSION['user'];
    let username = 'asimeonov';

    const topicId = 'topic';
    const dateId = 'date';
    const presentationId = 'presentation';
    const invitationId = 'invitation';

    if (!validateField(topicId) || !validateField(presentationId) || !validateField(dateId)) {
        document.getElementById(errorId).innerText = "Моля попълнете всички полета.";
    } else {
        document.getElementById(errorId).innerText = "";

        let file = document.getElementById('invitation').files[0];
        if (file === undefined) {
            document.getElementById(errorId).innerText = "Моля прикачете покана.";
            return false;
        }

        let formData = new FormData();
        formData.append('username', username);
        formData.append('topic', document.getElementById(topicId).value);
        formData.append('file', file);

        downloadImage(formData);

        if (uploadFile) {
            let topic = document.getElementById(topicId).value;
            let presentation = document.getElementById(presentationId).value;
            let invitation = uploadFile;
            let timeDate = document.getElementById(dateId).value;

            let data = { topic, username, presentation, invitation, timeDate };
            // console.log("DATA: " + data);
            insertPresentationData(data);
        } else {
            console.log("UPLOAD FILE IN: " + uploadFile);
        }
    }

    // let topic = document.getElementById('topic');
    return false;
}

function downloadImage(data) {
    const urlScript = "../php/image_download.php";

    let callback = function(msg) {
        console.log(msg);
        let regex = /\/uploads\//;
        if (regex.test(msg)) {
            uploadFile = msg;
        } else {
            document.getElementById(errorId).innerText = msg;
        }
        console.log("UPLOAD FILE: " + uploadFile);
    }

    ajax(urlScript, { success: callback }, data);
}

function validateField(fieldId) {
    let elementValue = document.getElementById(fieldId);
    return elementValue.value.trim() != "";
}

function insertPresentationData(data) {
    const urlScript = "../php/insert_presentation.php";
    let callback = function(msg) {
        console.log("MSG: " + msg);
        if (msg.toString().localeCompare("1")) {
            console.log("The presentation data is saved.");
            // window.location.href = "";
        } else {
            document.getElementById(errorId).innerText = "Получи се грешка при обработката на заявката. Моля, опитайте пак по-късно.";
        }
    }
    ajax_json(POST_METHOD, urlScript, { success: callback }, JSON.stringify(data));
}
import { ajax_json } from './ajax.js';

var date = new Date();
var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();
var hour = date.getHours();
var minutes = date.getMinutes();

if (day < 10) {
    day = '0' + day;
}
if (month < 10) {
    month = '0' + month;
}
if (hour < 10) {
    hour = '0' + hour;
}
if (minutes < 10) {
    minutes = '0' + minutes;
}

var today = year + '-' + month + '-' + day;
document.getElementById("date").setAttribute("min", today);

var time = hour + ":" + minutes;
var dateTime = today + ' ' + time;
document.getElementById('generate').addEventListener('click', () => {
    validate();
    return false;
})

function compare(start, end) {

    var startTime = new Date().setHours(getHours(start), getMinutes(start), 0);
    var endTime = new Date(startTime);
    endTime = endTime.setHours(getHours(end), getMinutes(end), 0);
    if (startTime > endTime) {
        document.getElementById("start").style.backgroundColor = '#fba';
        document.getElementById("end").style.backgroundColor = '#fba';
        document.getElementById("error").innerText = "Началаният час е след крайният.";
        return false;
    }
    if (startTime == endTime) {
        document.getElementById("start").style.backgroundColor = '#fba';
        document.getElementById("end").style.backgroundColor = '#fba';
        document.getElementById("error").innerText = "Началаният час е равен крайният.";
        return false;
    }
    if (startTime < endTime) {
        return true;
    }
}

function compareCurrentDateTime(date, start) {
    if (date == today && start < time) {
        document.getElementById("start").style.backgroundColor = '#fba';
        document.getElementById("error").innerText = "Не може да избирате минал час за днес.";
        return false;
    }
    return true;
}

function getHours(d) {
    return parseInt(d.split(':')[0]);
}

function getMinutes(d) {
    return parseInt(d.split(':')[1].split(' ')[0]);
}

function validateDuration() {
    if (document.getElementById("duration").value < 3 || document.getElementById("duration").value > 10) {
        document.getElementById("duration").style.backgroundColor = '#fba';
        document.getElementById("error").innerText = "Продължителността е от 3 до 10 минути.";
        return false;
    }
    return true;
}

function validate() {
    var start = document.getElementById("start");
    var end = document.getElementById("end");

    var isValidStart = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(start.value);
    if (isValidStart) {
        start.style.backgroundColor = '#bfa';
    } else {
        start.style.backgroundColor = '#fba';
        document.getElementById("error").innerText = "Часът трябва да е във формат HH:MM.";
    }
    var isValidEnd = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(end.value);
    if (isValidEnd) {
        end.style.backgroundColor = '#bfa';
    } else {
        document.getElementById("error").innerText = "Часът трябва да е във формат HH:MM.";
        end.style.backgroundColor = '#fba';
    }

    if (isValidStart && isValidEnd && validateDuration() && compare(start.value, end.value) && compareCurrentDateTime(document.getElementById("date").value, start.value)) {
        let date = document.getElementById('date').value;
        let start = document.getElementById('start').value;
        let end = document.getElementById('end').value;
        let duration = document.getElementById('duration').value;
        let room = document.getElementById('room').value;


        let json = { date, start, end, duration, room };

        let callback = function(msg) {
            if (msg == "1") {
                window.location = '../php/calendar.php';
            } else {
                document.getElementById('error').innerText = msg;
            }
        };
        ajax_json('POST', '../php/generateDate.php', { success: callback }, JSON.stringify(json));
    }
}
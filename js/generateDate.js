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
console.log(dateTime);

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
}

function getHours(d) {
    return h = parseInt(d.split(':')[0]);
}

function getMinutes(d) {
    return parseInt(d.split(':')[1].split(' ')[0]);
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
    return (isValidStart && isValidEnd && compare(start.value, end.value) && compareCurrentDateTime(document.getElementById("date").value, start.value));
}
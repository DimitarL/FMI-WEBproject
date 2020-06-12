var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1;
var yyyy = today.getFullYear();
if (dd < 10) {
    dd = '0' + dd
}
if (mm < 10) {
    mm = '0' + mm
}

today = yyyy + '-' + mm + '-' + dd;
document.getElementById("date").setAttribute("min", today);

function compare(start, end) {

    var startTime = new Date().setHours(getHours(start), getMinutes(start), 0);
    var endTime = new Date(startTime);
    endTime = endTime.setHours(getHours(end), getMinutes(end), 0);
    if (startTime > endTime) {
        return false;
    }
    if (startTime == endTime) {
        document.getElementById("start").style.backgroundColor = '#fba';
        document.getElementById("end").style.backgroundColor = '#fba';

        return false;
    }
    if (startTime < endTime) {
        return true;
    }
}

function getHours(d) {
    return h = parseInt(d.split(':')[0]);
}

function getMinutes(d) {
    return parseInt(d.split(':')[1].split(' ')[0]);
}

function validate() {
    let start = document.getElementById("start");
    let end = document.getElementById("end");

    var isValidStart = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(document.getElementById("start").value);
    if (isValidStart) {
        document.getElementById("start").style.backgroundColor = '#bfa';
    } else {
        document.getElementById("start").style.backgroundColor = '#fba';

    }
    var isValidEnd = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(document.getElementById("end").value);
    if (isValidEnd) {
        document.getElementById("end").style.backgroundColor = '#bfa';
    } else {
        document.getElementById("end").style.backgroundColor = '#fba';
    }
    return (isValidStart && isValidEnd && compare(document.getElementById("start").value, document.getElementById("end").value));
}
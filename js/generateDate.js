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

function validateStart(inputField) {
    var isValid = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(inputField.value);

    if (isValid) {
        inputField.style.backgroundColor = '#bfa';
    } else {
        inputField.style.backgroundColor = '#fba';
    }

    return isValid;
}

function validateEnd(inputField) {
    var isValid = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(inputField.value);
    if (isValid && compare(document.getElementById("start").value, inputField.value)) {
        inputField.style.backgroundColor = '#bfa';
    } else {
        inputField.style.backgroundColor = '#fba';
    }
    return isValid;
}

function compare(start, end) {

    var startTime = new Date().setHours(getHours(start), getMinutes(start), 0);
    var endTime = new Date(startTime);
    endTime = endTime.setHours(getHours(end), getMinutes(end), 0);
    if (startTime > endTime) {
        return false;
    }
    if (startTime == endTime) {
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
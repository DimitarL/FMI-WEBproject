document.getElementById('saveNotes').addEventListener("click", submitFunction);
document.getElementById('saveNotes').addEventListener("click", downloadFunction);

export function printContent() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("sharedNotes").innerHTML = this.responseText;
        }
    };

    xhttp.open("GET", "../php/printContent.php", true);
    xhttp.send();
}

function submitFunction() {
    var x = document.getElementById("inputNotes").value;
    var xhttp = new XMLHttpRequest();

    xhttp.open("GET", "../php/addContent.php?inputNotes=" + x, true);
    xhttp.send();
    document.getElementById("inputNotes").value = "";
}

function downloadFunction() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("sharedNotes").innerHTML = this.responseText;
        }
    };

    xhttp.open("GET", "../php/getNotes.php", true);
    xhttp.send();
}
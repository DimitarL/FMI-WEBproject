import { ajax_json } from './ajax.js';

let hasLectorRole;

isLector();

if (hasLectorRole) {
    let btn = document.createElement("BUTTON");
    btn.innerHTML = "Списък с присъствали";
    btn.id = "getFile";
    document.getElementById("presentButton").appendChild(btn);

    document.getElementById("presentButton").style.visibility = "visible";

    document.getElementById('getFile').addEventListener('click', function() {
        let callback = function(data) {
            let a = document.createElement('a');
            let url = window.URL.createObjectURL(new Blob([data]));
            a.href = url;
            a.download = 'presentAll.txt';
            document.body.append(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);
        }
        ajax_json("GET", "../php/download_all_present.php", { success: callback });
    })

    let btnPresent = document.createElement("BUTTON");
    btnPresent.innerHTML = "Текущ списък с присъстващи";
    btnPresent.id = "getFilePresent";
    document.getElementById("presentButton").appendChild(btnPresent);

    document.getElementById('getFilePresent').addEventListener('click', function() {
        let callback = function(data) {
            let a = document.createElement('a');
            let url = window.URL.createObjectURL(new Blob([data]));
            a.href = url;
            a.download = 'present.txt';
            document.body.append(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);
        }
        ajax_json("GET", "../php/download_present.php", { success: callback });
    })
}

function isLector() {
    let callback = function(msg) {
        if (msg == "1") {
            hasLectorRole = true;
        } else {
            hasLectorRole = false;
        }
    }
    ajax_json("GET", "../php/is_lector.php", { success: callback });
}

export function printStudents() {
    let callback = function(data) {
        data = data.split("\n")
            .sort()
            .splice(1);

        for (let i in data) {
            data[i] = "<div class='studentPresent' >" + data[i] + "</div><hr>";
        }
        document.getElementById('students').innerHTML = data.join("\n");
    }
    ajax_json("GET", "../php/present_manipulation.php", { success: callback });
}
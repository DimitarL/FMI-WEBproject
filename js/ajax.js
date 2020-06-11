export function ajax(url, settings, json) {
    let xhr = new XMLHttpRequest();

    xhr.onload = function() {
        if (xhr.status == 200) {
            settings.success(xhr.responseText);
        } else {
            console.error(xhr.responseText);
        }
    };

    xhr.open("POST", url, false);
    xhr.send(json);
}

export function ajax_json(method, url, settings, json) {
    let xhr = new XMLHttpRequest();

    xhr.onload = function() {
        if (xhr.status == 200) {
            settings.success(xhr.responseText);
        } else {
            console.error(xhr.responseText);
        }
    };

    xhr.open(method, url, false);
    xhr.setRequestHeader("Content-type", "application/json")
    xhr.send(json);
}
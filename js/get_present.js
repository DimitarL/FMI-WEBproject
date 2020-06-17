import { ajax_json } from './ajax.js';

document.getElementById('getFile').addEventListener('click', function() {
    let callback = function(data) {
        // console.log(data);

        let a = document.createElement('a');
        let url = window.URL.createObjectURL(new Blob([data]));
        a.href = url;
        a.download = 'present.txt';
        document.body.append(a);
        a.click();
        a.remove();
        window.URL.revokeObjectURL(url);
        // console.log("END");
    }
    ajax_json("GET", "../php/get_present.php", { success: callback });

})
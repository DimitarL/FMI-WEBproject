const year = new Date().getFullYear();
const timeInFuture = new Date().getTime() + 7 * 60000;
// console.log(timeInFuture);

let timer = setInterval(function() {
    const today = new Date().getTime();
    const diff = timeInFuture - today;

    let edition = new Date(year).getTime() - 2006;
    minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    seconds = Math.floor((diff % (1000 * 60)) / 1000);

    document.getElementById("timer").innerHTML =
        "<div class=\"edition\"> \
      <div class=\"numbers\">" + edition + "</div>Издание \
    </div> \
    <div class=\"minutes\"> \
      <div class=\"numbers\">" + minutes + "</div>Минути \
    </div> \
    <div class=\"seconds\"> \
      <div class=\"numbers\">" + seconds + "</div>Секунди \
    </div> \
    <div class=\"againButton\"> \
    <button type=\"button\" onclick=\"refresh()\" class=\"buttonStyle\">Пусни отново</button></div>";
}, 1000);

let clearTimer = setTimeout(
    function() {
        clearInterval(timer);
        alert("Времето за презентиране изтече!");
    }, 419999); /*5000 or 5 seconds if you want to test it*/

function refresh() {
    clearTimeout(timer);

    var killId = setTimeout(function() {
        for (var i = killId; i > 0; i--) clearInterval(i)
    }, 3000);

    startNewTimer();
    clearTimerr();
}

function startNewTimer() {
    const year = new Date().getFullYear();
    const timeInFuture = new Date().getTime() + 7 * 60000;
    // console.log(timeInFuture);

    timer = setInterval(function() {
        const today = new Date().getTime();
        const diff = timeInFuture - today;

        let edition = new Date(year).getTime() - 2006;
        let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((diff % (1000 * 60)) / 1000);

        document.getElementById("timer").innerHTML =
            "<div class=\"edition\"> \
        <div class=\"numbers\">" + edition + "</div>Издание \
      </div> \
      <div class=\"minutes\"> \
        <div class=\"numbers\">" + minutes + "</div>Минути \
      </div> \
      <div class=\"seconds\"> \
        <div class=\"numbers\">" + seconds + "</div>Секунди \
      </div> \
      <div class=\"againButton\"> \
      <button type=\"button\" onclick=\"refresh()\" class=\"buttonStyle\">Пусни отново</button></div>";
    }, 1000);
}

function clearTimerr() {
    clearTimer = setTimeout(
        function() {
            clearInterval(timer);
            alert("Времето за презентиране изтече!");
        }, 419999); /*5000 or 5 seconds if you want to test it*/
}
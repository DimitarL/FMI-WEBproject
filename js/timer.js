const year = new Date().getFullYear();
const timeInFuture = new Date().getTime() + 7 * 60000;
var flag = true;
var flag2 = true;
var counter = 0;
var totalTimeAdded = 0;
var timeGoneInFunction = 419999;
var timeGoneTotal = 0;

let timer = setInterval(function () {
  if (flag) {
    const today = new Date().getTime();
    const diff = timeInFuture - today;

    let edition = new Date(year).getTime() - 2006;

    minutes = Math.floor(((diff + 1000 * counter) % (1000 * 60 * 60)) / (1000 * 60));
    seconds = Math.floor(((diff + 1000 * counter) % (1000 * 60)) / 1000);

    flag2 = false;

    timeGoneInFunction = timeGoneInFunction - 1000;

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
    <button type=\"button\" onclick=\"refresh()\" class=\"buttonStyle\">Пусни отново</button> \
    </div> \
    <div class=\"stopButton\"> \
    <button type=\"button\" onclick=\"stop()\" class=\"buttonPauseStyle\">Спри</button> \
    </div> \
    <div class=\"continueButton\"> \
    <button type=\"button\" onclick=\"continueWithIt()\" class=\"buttonPauseStyle\">Продължи</button> \
    </div>";
  }
  else {
    if (flag2 = false) {
      counter = 0;
    }
    counter++;
    totalTimeAdded++;
  }
  timeGoneTotal++;
}, 1000 + totalTimeAdded);

function stop() {
  flag = false;
}
function continueWithIt() {
  flag = true;
  renew();
}

let clearTimer = setTimeout(
  function () {
    clearInterval(timer);
    alert("Времето за презентиране изтече!");
  }, 419999 + totalTimeAdded);

function renew() {
  clearTimeout(timer);

  var killId = setTimeout(function () {
    for (var i = killId; i > 0; i--) clearInterval(i)
  }, 3000);

  startRenewTimer();
  clearRenewTimer();
}

function startRenewTimer() {
  const year = new Date().getFullYear();
  const timeInFuture = new Date().getTime() + 7 * 60000;

  timer = setInterval(function () {
    if (flag) {
      const today = new Date().getTime();
      const diff = timeInFuture - today;

      let edition = new Date(year).getTime() - 2006;
      minutes = Math.floor(((diff - (419999 - timeGoneInFunction)) % (1000 * 60 * 60)) / (1000 * 60));
      seconds = Math.floor(((diff - (419999 - timeGoneInFunction)) % (1000 * 60)) / 1000);

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
    }
    else {
      if (flag2 = false) {
        counter = 0;
      }
      counter++;
      totalTimeAdded++;
    }
    timeGoneTotal++;
  }, 1000);
}

function clearRenewTimer() {
  clearTimer = setTimeout(
    function () {
      clearInterval(timer);
      alert("Времето за презентиране изтече!");
    }, (timeGoneInFunction));
}

function refresh() {
  clearTimeout(timer);

  var killId = setTimeout(function () {
    for (var i = killId; i > 0; i--) clearInterval(i)
  }, 3000);

  counter = 0;
  totalTimeAdded = 0;
  timeGoneInFunction = 419999;
  timeGoneTotal = 0;
  startNewTimer();
  clearTimerr();
}

function startNewTimer() {
  const year = new Date().getFullYear();
  const timeInFuture = new Date().getTime() + 7 * 60000;

  timer = setInterval(function () {
    if (flag) {
      const today = new Date().getTime();
      const diff = timeInFuture - today;

      let edition = new Date(year).getTime() - 2006;
      let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
      let seconds = Math.floor((diff % (1000 * 60)) / 1000);

      flag2 = false;

      timeGoneInFunction = timeGoneInFunction - 1000;

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
  <button type=\"button\" onclick=\"refresh()\" class=\"buttonStyle\">Пусни отново</button> \
  </div> \
  <div class=\"stopButton\"> \
  <button type=\"button\" onclick=\"stop()\" class=\"buttonPauseStyle\">Спри</button> \
  </div> \
  <div class=\"continueButton\"> \
  <button type=\"button\" onclick=\"continueWithIt()\" class=\"buttonPauseStyle\">Продължи</button> \
  </div>";
    }
    else {
      if (flag2 = false) {
        counter = 0;
      }
      counter++;
      totalTimeAdded++;
    }
    timeGoneTotal++;
  }, 1000);
}

function clearTimerr() {
  clearTimer = setTimeout(
    function () {
      clearInterval(timer);
      alert("Времето за презентиране изтече!");
    }, 419999);
}
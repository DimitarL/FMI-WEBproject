const year = new Date().getFullYear();
const timeInFuture = new Date().getTime() + 7 * 60000;
console.log(timeInFuture);

let timer = setInterval(function() {
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
    </div>";
  }, 1000);

let clearTimer = setTimeout(
    function() {
      clearInterval(timer);
      alert("Времето за презентиране изтече!");
    }, 420000);/*5000 or 5 seconds if you want to test it*/

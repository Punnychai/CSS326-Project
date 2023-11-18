function PopUp() {
  document.getElementById("popup").style.display = "flex";
  document.getElementById("overlay").style.display= "block";
  document.getElementById("logo").style.opacity=0.4;
}

function PopUp2() {
  document.getElementById("popup2").style.display = "flex";
  document.getElementById("overlay2").style.display= "block";
  document.getElementById("logo").style.opacity=0.4;
}
  
function PopDown() {
  document.getElementById("popup").style.display = "none";
  document.getElementById("overlay").style.display= "none";
  document.getElementById("popup2").style.display = "none";
  document.getElementById("overlay2").style.display= "none";
  document.getElementById("logo").style.opacity=1;
}

function gotoPage(url) {
  window.location.href = url;
}

// Get the current time in the format "HH:mm"
function getCurrentTime() {
  const now = new Date();
  const hours = String(now.getHours()).padStart(2, '0');
  const minutes = String(now.getMinutes()).padStart(2, '0');
  return `${hours}:${minutes}`;
}

function getLimitTime() {
  const startTimeString = document.getElementById("startTime").value;
  const startTime = new Date(`2000-01-01T${startTimeString}`);
  
  const hours = String(startTime.getHours() + 4).padStart(2, '0');
  const minutes = String(startTime.getMinutes()).padStart(2, '0');
  return `${hours}:${minutes}`;
}

document.getElementById("startTime").value = getCurrentTime();
// The maximum reservation is 4 hours
document.getElementById("endTime").max = getLimitTime();

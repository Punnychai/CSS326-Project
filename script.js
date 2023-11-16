function PopUp() {
  document.getElementById("popup").style.display = "flex";
  document.getElementById("overlay").style.display= "block";
  document.getElementById("logo").style.opacity=0.4;
}
  
function PopDown() {
  document.getElementById("popup").style.display = "none";
  document.getElementById("overlay").style.display= "none";
  document.getElementById("logo").style.opacity=1;
}
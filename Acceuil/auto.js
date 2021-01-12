$(document).ready(function () {
    $('.cars').bxSlider();
});

var modal = document.getElementById('popup-modal');
window.onclick = function(event){
    if(event.target == modal) {
        modal.style.display = none;
    }
}
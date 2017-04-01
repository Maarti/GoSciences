var motif = document.getElementById('motif');
var fileInput = document.getElementById('cv');

motif.addEventListener("change", init_postuler);
fileInput.addEventListener("change",function(){
    $("#filename").html(fileInput.files[0].name);
});
$(document).ready(init_postuler());

$( "#contact-form" ).submit(function() {
    $("#loading").show();
});


function init_postuler() {
    var msg = document.getElementById('recrutement-msg');
    var cv = document.getElementById('cv-container');
    //$("#loading").hide();
    if(motif.value==='postuler'){
        cv.style.display = 'block';
        msg.style.display = 'block';
    }else{
        cv.style.display = 'none';
        msg.style.display = 'none';
    }
}
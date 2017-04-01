var motif = document.getElementById('motif');
motif.addEventListener("change", init_postuler);
$(document).ready(init_postuler());

function init_postuler() {    
    var cv = document.getElementById('cv-container');
    var msg = document.getElementById('recrutement-msg');
    if(motif.value==='postuler'){
        cv.style.display = 'block';
        msg.style.display = 'block';
    }else{
        cv.style.display = 'none';
        msg.style.display = 'none';
    }
}
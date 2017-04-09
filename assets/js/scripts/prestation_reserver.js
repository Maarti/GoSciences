var eleve = document.getElementById('eleve');
eleve.addEventListener("change", init_classe);
$(document).ready(init_classe());

function init_classe() {
    classeEleve = $('#eleve').find(":selected").data('eleve-classe');
    $('#classe_prestation').val(classeEleve);
}
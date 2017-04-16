/* Au clic sur "ajouter un creneau", on clone le dernier creneau saisi
 * et on l'insert  la fin du container. Puis on relance l'initatialisation
 * de datepicker pour prendre en compte les nouveaux champs
 */
var btn = document.getElementById("new-creneau");
btn.addEventListener("click",newDispo);

function newDispo(){
    console.log("newDispo");
    var container = document.getElementById("dispo-container");
    console.log("cont",container);
    var lastRow = container.lastElementChild;
    console.log("row",lastRow);
    var clone = lastRow.cloneNode(true);
    console.log("clone",clone);
    container.appendChild(clone);
    init_timepicker();
}
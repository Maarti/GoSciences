
// A la validation du formulaire, on stock les data du calendrier dans un champ caché
var submitBtn = document.getElementById("valid-dispo");
submitBtn.addEventListener("click",function(){
    document.getElementById("disponibilite").value = JSON.stringify(eventData);
});

// Retourne et formatte l'heure d'une date
function formatHour(d) {
    var h = addZero(d.getHours());
    var m = addZero(d.getMinutes());
    return h + ":" + m;
}
function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

var year = new Date().getFullYear();
var month = new Date().getMonth();
var day = new Date().getDate();

// Initialisation du calendrier
$(document).ready(function() {
  $('#calendar').weekCalendar({
    use24Hour:true,
    minDate: new Date(year, month, day - 7),
    dateFormat:'d M Y',
    useShortDayNames:true,
    timeslotsPerHour: 4,
    buttonText: {today : 'Aujourd\'hui', lastWeek : '<', nextWeek : '>'},
    shortMonths: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jui', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Déc'],
    longMonths: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    shortDays: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
    longDays: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
    eventHeader: function(calEvent){return formatHour(calEvent.start)+' à '+formatHour(calEvent.end);},
    hourLine: true,
    data: eventData,
    firstDayOfWeek:1,
    businessHours:{start: 8, end: 22, limitDisplay: true},
    title:'',
    height: function() {
      //return $(window).height() - $('h1').outerHeight(true);
      return 600;
    },
    eventRender : function(calEvent, $event) {
      if (calEvent.end.getTime() < new Date().getTime()) {
        $event.css('backgroundColor', '#aaa');
        $event.find('.time').css({'backgroundColor': '#999', 'border':'1px solid #888'});
      }
    },
    eventNew: function(calEvent, $event) {
        eventData.events.push(calEvent);
        this.data = eventData;
    },
    eventDrop: function(calEvent, $event) {
    },
    eventResize: function(calEvent, $event) {
    },
    eventClick: function(calEvent, $event) {
    },
    eventMouseover: function(calEvent, $event) {
    },
    eventMouseout: function(calEvent, $event) {
    },
    noEvents: function() {
    }
  });

});
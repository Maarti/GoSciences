var year = new Date().getFullYear();
var month = new Date().getMonth();
var day = new Date().getDate();

var eventData = {
  events : [
    {'id':1, 'start': new Date(year, month, day, 12), 'end': new Date(year, month, day, 13, 35),'title':'Lunch with Mike'},
    {'id':2, 'start': new Date(year, month, day, 14), 'end': new Date(year, month, day, 14, 45),'title':'Dev Meeting'},
    {'id':3, 'start': new Date(year, month, day + 1, 18), 'end': new Date(year, month, day + 1, 18, 45),'title':'Hair cut'},
    {'id':4, 'start': new Date(year, month, day - 1, 8), 'end': new Date(year, month, day - 1, 9, 30),'title':'Team breakfast'},
    {'id':5, 'start': new Date(year, month, day + 1, 14), 'end': new Date(year, month, day + 1, 15),'title':'Product showcase'}
  ]
};

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
    height: function($calendar) {
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
      displayMessage('<strong>Added event</strong><br/>Start: ' + calEvent.start + '<br/>End: ' + calEvent.end);
              console.log("event",calEvent);
              eventData.events.push(calEvent);
              this.data=eventData;

    },
    eventDrop: function(calEvent, $event) {
      displayMessage('<strong>Moved Event</strong><br/>Start: ' + calEvent.start + '<br/>End: ' + calEvent.end);
    },
    eventResize: function(calEvent, $event) {
      displayMessage('<strong>Resized Event</strong><br/>Start: ' + calEvent.start + '<br/>End: ' + calEvent.end);
    },
    eventClick: function(calEvent, $event) {
      displayMessage('<strong>Clicked Event</strong><br/>Start: ' + calEvent.start + '<br/>End: ' + calEvent.end);
    },
    eventMouseover: function(calEvent, $event) {
      displayMessage('<strong>Mouseover Event</strong><br/>Start: ' + calEvent.start + '<br/>End: ' + calEvent.end);
    },
    eventMouseout: function(calEvent, $event) {
      displayMessage('<strong>Mouseout Event</strong><br/>Start: ' + calEvent.start + '<br/>End: ' + calEvent.end);
    },
    noEvents: function() {
      displayMessage('There are no events for this week');
    }
  });

  function displayMessage(message) {
    $('#message').html(message).fadeIn();
  }

  $('<div id="message" class="ui-corner-all"></div>').prependTo($('body'));
});
$(document).ready(function() {
// dom chargé

var server = 'http://localhost:8000';

// ciblage et mise en cache
var app                   = $('div#app');
var btnTestAjax           = app.find('button#btnTestAjax');
var btnListFruits         = app.find('button#btnListFruits');
var fruitDisplay          = app.find('div#fruitDisplay');
var selectFormat          = app.find('select#selectFormat');

// fonctions
var ajaxFn = function() {
  $.get(server + '/fruits/api/json', function(res) {
    console.log(res);
    console.log(typeof res);
    // la réponse du server (res) est une chaîne de caractères
    // au format JSON
    var fruit = JSON.parse(res);
    console.log(fruit);
    console.log(typeof fruit);
    console.log('Nom du fruit: ' + fruit.name);

    var fruitData = 'Nom: ' + fruit.name;
    fruitData += '<br />' + 'Origin: ' + fruit.origin;
    fruitDisplay.html(fruitData);

  });
}

var ajaxListFruits = function() {
  $.get(server + '/fruits/api/list', function(res) {
    var fruits = JSON.parse(res);
    var format = selectFormat.val(); // format d'affichage sélectionné
    fruitDisplay.html(transformToHtml(fruits, format));
  });
}

var transformToHtml = function(fruits, type) {
  var output = '';

  // liste
  if (type == 'list') {
    output += '<ul>';
    // itération sur fruits
    fruits.forEach(function(fruit) {
      output += '<li>' + fruit.name + '</li>';
    });
    output += '</ul>';
  }

  // tableau
  if (type == 'table') {
    output += '<table class="table table-striped">';
    var header =
      '<tr><th>Nom</th><th>Origine</th><th>Comestible</th><th>Producteur</th></tr>';

    output += header;

    fruits.forEach(function(fruit) {
      // vérification des données
      var comestible = (fruit.comestible) ? 'Oui' : 'Non';
      if (fruit.producer == undefined) {
        var producer = 'Aucun producteur';
      } else {
        var producer = fruit.producer;
      }

      output += '<tr>';
      output += '<td>'+fruit.name+'</td>'
      output += '<td>'+fruit.origin+'</td>'
      output += '<td>'+comestible+'</td>'
      output += '<td>'+producer+'</td>'
      output += '</tr>';
    });

    output += '</table>'
  }


  return output;
}

// événements
btnTestAjax.click(ajaxFn);
btnListFruits.click(ajaxListFruits);




}); //fin ready()

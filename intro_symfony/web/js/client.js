$(document).ready(function() {
// dom chargé

var server = 'http://localhost:8000';

// ciblage et mise en cache
var btnTestAjax           = $('button#btnTestAjax');
var btnListFruits         = $('button#btnListFruits');
var fruitDisplay          = $('div#fruitDisplay');

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
    fruitDisplay.html(transformToHtml(fruits, 'list'));
  });
}

var transformToHtml = function(fruits, type) {
  var output = '';
  if (type == 'list') {
    output += '<ul>';
    // itération sur fruits
    fruits.forEach(function(fruit) {
      output += '<li>' + fruit.name + '</li>';
    });
    output += '</ul>';
  }
  return output;
}

// événements
btnTestAjax.click(ajaxFn);
btnListFruits.click(ajaxListFruits);




}); //fin ready()

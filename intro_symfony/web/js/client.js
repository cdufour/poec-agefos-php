$(document).ready(function() {
// dom chargé

var app = {
  server: 'http://localhost:8000',
  data: {
    fruits: null
  }
};

// ciblage et mise en cache
var appHtml               = $('div#app');
var btnTestAjax           = appHtml.find('button#btnTestAjax');
var btnListFruits         = appHtml.find('button#btnListFruits');
var fruitDisplay          = appHtml.find('div#fruitDisplay');
var selectFormat          = appHtml.find('select#selectFormat');

// fonctions
function init() {
  ajaxListFruits(); // appelle la function de récupération de fruits
}

var ajaxFn = function() {
  $.get(app.server + '/fruits/api/json', function(res) {
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
  var format = selectFormat.val(); // format d'affichage sélectionné
  if (app.data.fruits == null) {
    // si les données n'ont pas déjà été stockées on les demande au serveur
    $.get(app.server + '/fruits/api/list', function(res) {
      // les requêtes ajax sont asynchrones
      // il faut s'assurer que la réponse de serveur est reçue
      // avant d'effectuer des opération basées sur la réponse du serveur
      var fruits = JSON.parse(res);
      app.data.fruits = fruits; // stockage de la réponse du serveur
      fruitDisplay.html(transformToHtml(app.data.fruits, format));
    });
  } else {
    // les données ont déjà été reçues
    fruitDisplay.html(transformToHtml(app.data.fruits, format));
  }

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
selectFormat.change(ajaxListFruits);


init();

}); //fin ready()

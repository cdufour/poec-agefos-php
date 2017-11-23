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
var fruitDetail           = appHtml.find('div#fruitDetail');

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
  fruitDetail.html(''); // "remise à 0" du div fruitDetail
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

    // écouteur d'événement bien placé: on cible td.fruitName
    // avec la certitude que cet élément est dans le DOM
    // $('td.fruitName').click(function() {
    //   console.log('click');
    // });
  }

}

var transformToHtml = function(fruits, type) {
  var output = '';

  // liste
  if (type == 'list') {
    output += '<ul>';
    // itération sur fruits
    fruits.forEach(function(fruit) {
      output += '<li class="fruitName" id="'+fruit.id+'">' + fruit.name + '</li>';
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
      output += '<td class="fruitName" id="'+fruit.id+'">'+fruit.name+'</td>'
      output += '<td>'+fruit.origin+'</td>'
      output += '<td>'+comestible+'</td>'
      output += '<td>'+producer+'</td>'
      output += '</tr>';
    });

    output += '</table>'
  }


  return output;
}

var detailFruit = function() {
  var id = $(this).attr('id'); // récupération de la valeur associée
  // à l'attribut html (ici : id) ciblé
  var url = app.server + '/fruits/api/detail/' + id;

  // requête ajax
  $.get(url, function(res) {
    var fruit = JSON.parse(res);
    displayDetailFruit(fruit);
  });
}

var displayDetailFruit = function(fruit) {
  var output = '';
  output += '<h4>'+fruit.name+' ('+fruit.origin+')</h4>';

  if (fruit.producer) {
    output += '<p>Produit par '+fruit.producer.name+'</p>';
    if (fruit.producer.logo) {
      var url = app.server + '/img/logo/' + fruit.producer.logo;
      output += '<img class="logo" alt="" src="'+url+'">';
    }
  }

  fruitDetail.html(output);
}

// événements
btnTestAjax.click(ajaxFn);
btnListFruits.click(ajaxListFruits);
selectFormat.change(ajaxListFruits);

// problème de chronologie, ce code sera valable dans le futur,
// cad lorsque la balise td.fruiName existera dans le DOM
// $('td.fruitName').click(function() {
//   console.log('click');
// });

// la function .on permet d'attacher un écouteur d'événement à l'élément ciblé
// ou à l'un de ses descendants (présent ou à venir)
// ici: lorsque td.fruitName apparaîtra dans le DOM en tant que descendant
// de fruitDisplay, un écouteur d'événement click lui sera attaché

// fruitDisplay
//   .on('click', 'td.fruitName', detailFruit)
//   .on('click', 'li.fruitName', detailFruit);

// équivalent en utilisant uniquement le nom de la classe .fruitName
fruitDisplay.on('click', '.fruitName', detailFruit)

init();

}); //fin ready()

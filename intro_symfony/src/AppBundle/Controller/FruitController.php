<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Fruit;
use AppBundle\Entity\Producer;
use AppBundle\Entity\Category;

/**
 * @Route("/fruits")
*/
class FruitController extends Controller {

  /**
   * @Route("/", name="fruit_admin_page")
  */
  public function indexAction(Request $request) {
    //var_dump($request);
    $post = $request->request;
    //echo $post->get('name'); // echo $_POST['name']
    //echo $request->request->get('origin');

    if ($request->getMethod() == 'POST') {
      $name = $post->get('name');
      $origin = $post->get('origin');
      $comestible = $post->get('comestible');
      $producer_id = $post->get('producer_id');

      // on récupère un tableau d'identifiants de catégorie
      // exemple: ["1", "4"] correspondants aux cases cochées
      $categories_posted = $post->get('categories');

      // récupérer l'objet producer complet à partir d'un id
      $producer = $this->getDoctrine()
        ->getRepository(Producer::class)->find($producer_id);

      // vérification du contenu de la variable $comestible
      $comestible = ($comestible) ? 1 : 0; // use AppBundle\Entity\Fruit;ternaire
      $fruit = new Fruit();

      if ($categories_posted !== NULL) {
        // l'utilisateur a coché au moins une case de catégorie

        // boucle sur le tableau des identifiants des catégories cochées
        foreach($categories_posted as $c) {
          // A chaque passage création d'un objet de type Category
          $category = $this->getDoctrine()
            ->getRepository(Category::class)->find($c);

          // Alimentation de la propriété category de l'objet $fruit
          $fruit->addCategory($category);
        }

      }

      // hydratation
      $fruit->setName($name);
      $fruit->setOrigin($origin);
      $fruit->setComestible($comestible);
      $fruit->setProducer($producer);

      // utilisaton du EntityManager
      $em = $this->getDoctrine()->getManager();

      $em->persist($fruit); // prépare la réquête d'insertion
      // mais n'execute aucune requête sql

      $em->flush(); // execute toutes les reqûetes SQL en attente

    }

    // récupération des fruits
    // Fruit::class retourne chemin + nom de la classe
    // .getRepository pour les opération de lecture
    $fruits = $this
      ->getDoctrine()
      ->getRepository(Fruit::class)
      ->findAll();

    // Récupération des producteurs
    $producers = $this
      ->getDoctrine()
      ->getRepository(Producer::class)
      ->findAll();

    // Récupération des catégories
    $categories = $this
      ->getDoctrine()
      ->getRepository(Category::class)
      ->findAll();

    return $this->render('fruit/index.html.twig', array(
      'fruits' => $fruits,
      'producers' => $producers,
      'categories' => $categories
    ));
  }

  /**
   * @Route("/delete/{id}", name="fruit_delete")
  */
  public function deleteAction($id) {
    // l'argument $id correpond au paramètre {id}
    // défini au niveau de l'annotation @Route

    $fruit = $this->getDoctrine()->getRepository(Fruit::class)->find($id);
    $em = $this->getDoctrine()->getManager();
    $em->remove($fruit); // requête de suppression en attente;
    $em->flush(); // execute les requêtes SQL en attente

    return $this->redirectToRoute('fruit_admin_page');
  }

  /**
   * @Route("/update/{id}", name="fruit_update")
  */
  public function updateAction($id, Request $request) {
    // dans cette variante, l'objet fruit est crée sans le notifier
    // au manager
    //$fruit = $this->getDoctrine()->getRepository(Fruit::class)->find($id);

    // Appeler getRepository depuis getManager établit une connexion,
    // une "visibilité" entre le repo et le manager
    // ici, le manager "est au courant", est notifié de l'existence de l'objet
    // fruit, si cet objet change (reçoit de nouvelles valeurs)
    // le manager le sait. Le manager "surveille" cet objet.
    $em = $this->getDoctrine()->getManager();
    $fruit = $em->getRepository(Fruit::class)->find($id);

    if ($request->getMethod() == 'POST') {
      $fruit->setName($request->request->get('name'));
      $fruit->setOrigin($request->request->get('origin'));

      $comestible = ($request->request->get('comestible')) ? 1 : 0;
      $fruit->setComestible($comestible);

      // Variante syntaxique pour le ternaire
      // ($request->request->get('comestible'))
      //   ? $fruit->setComestible(1)
      //   : $fruit->setComestible(0);

      $em->flush(); // si l'objet $fruit a été modifié (a reçu de nouvelles
      // valeurs), le manager exécutera la requête SQL appropriée
      return $this->redirectToRoute('fruit_admin_page');
    }

    return $this->render('fruit/update.html.twig', array(
      'fruit' => $fruit
    ));

  }

  /**
   * @Route("/{id}", name="fruit_details")
  */
  public function detailsAction($id) {
    // récupérer un objet fruit à partir de l'identifiant $id
    $fruit = $this->getDoctrine()
      ->getRepository(Fruit::class)
      ->find($id);


    return $this->render('fruit/details.html.twig', array(
      'fruit' => $fruit
    ));

  }
}

<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Fruit;

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

      // vérification du contenu de la variable $comestible
      $comestible = ($comestible) ? 1 : 0; // use AppBundle\Entity\Fruit;ternaire

      $fruit = new Fruit();
      // hydratation
      $fruit->setName($name);
      $fruit->setOrigin($origin);
      $fruit->setComestible($comestible);

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

    return $this->render('fruit/index.html.twig', array(
      'fruits' => $fruits
    ));
  }

  /**
   * @Route("/delete/{id}", name="fruit_delete")
  */
  public function deleteAction($id) {
    // l'argument $id correpond au paramètre {id}
    // défini au niveau de l'annotation @Route
    return new Response("Id du fruit à supprimer: " . $id);
  }
}

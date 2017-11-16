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

}

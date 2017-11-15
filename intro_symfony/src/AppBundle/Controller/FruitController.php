<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
    }

    // suite des opérations: créer un objet fruit, le transmettre à un
    // manager pour l'enregistrement en db

    return $this->render('fruit/index.html.twig', array(

    ));
  }

}

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
  public function indexAction() {
    return $this->render('fruit/index.html.twig', array(

    ));
  }

}

<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homeAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/test", name="testpage")
     */
    public function testAction(Request $request)
    {
      return $this->render('default/test.html.twig');
    }



}

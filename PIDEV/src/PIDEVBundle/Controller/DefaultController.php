<?php

namespace PIDEVBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@PIDEV/Default/index.html.twig');
    }
}

<?php

namespace PIDEVBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('base.html.twig');
    }
    public function adminAction()
    {
        return $this->render('admin.html.twig');
    }
}

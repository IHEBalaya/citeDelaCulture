<?php

namespace PIDEVBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AfterLoginController extends Controller
{
    public function AfterLoginAction()
    {

        $authChecker = $this->container->get('security.authorization_checker');
        $router = $this->container->get('router');

        if ($authChecker->isGranted('ROLE_ADMIN')) {
            return $this->render("admin.html.twig") ;
        }

        if ($authChecker->isGranted('ROLE_CLIENT')) {
            return $this->render("Client.html.twig") ;
        }

        if ($authChecker->isGranted('ROLE_FORMATEUR')) {
            return $this->render("base.html.twig") ;
        }

    }

}

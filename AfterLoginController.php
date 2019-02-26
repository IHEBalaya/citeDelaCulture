<?php

namespace PIDEVBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AfterLoginController extends Controller
{
    public function AfterLoginAction()
    {
        $authChecker = $this->container->get('security.authorization_checker');
        $router = $this->container->get('router');

        if ($authChecker->isGranted('ROLE_ADMIN')) {
            return $this->render("admin_login.html.twig") ;
        }

        if ($authChecker->isGranted('ROLE_CLIENT')) {
            return $this->render("client_login.html.twig") ;
        }
        if ($authChecker->isGranted('ROLE_ORG')) {
            return $this->render("org_login.html.twig") ;
        }
        if ($authChecker->isGranted('ROLE_FORMATEUR')) {
            return $this->render("formateur_login.html.twig") ;
        }
        if ($authChecker->isGranted('ROLE_JOURNALISTE')) {
            return $this->render("journaliste_login.html.twig") ;
        }
    }

}

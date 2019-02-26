<?php

namespace PIDEVBundle\Controller;

use PIDEVBundle\Entity\Evenement;
use PIDEVBundle\Entity\Interesse;
use PIDEVBundle\Entity\Utilisateur;
use PIDEVBundle\Form\InteresseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PIDEVBundle\Repository\InteresseRepository;

class InteresseController extends Controller
{
    public function ajoutAction($ide)

    {
        $interesse = new Interesse() ; // objet vide

        $id=$this->container->get('security.token_storage')->getToken()->getUser()->getId();
        $interesse->setIdUser($this->getDoctrine()->getRepository(Utilisateur::class )->find($id));

        $interesse->setEvenement($this->getDoctrine()->getRepository(Evenement::class )->find($ide));

        $em=$this->getDoctrine()->getManager(); // Déclaration Entity Manager
        $em->persist($interesse); // Persister l'obje dans l'ORM
        $em->flush(); // Sauvegarde des données dans la BD
        // ...

        return $this->redirectToRoute('lister_evenement', array(
            'm'=>$interesse,

        ));

    }
    public function ListerIAction(Request $request)
    {


        $em=$this->getDoctrine()->getManager() ;
        $user = $this->getUser();
        $interesse=$em->getRepository("PIDEVBundle:Interesse")->SelectUserByidEvenement();


        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator= $this->get('knp_paginator') ;
        $result=$paginator->paginate(
            $interesse,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',4)
        );

        return $this->render('PIDEVBundle:Interesse:ajout.html.twig', array(
            'm'=>$result,
            'user'=> $user
        ));
    }
    public function MesfavorisAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager() ;
        $user = $this->getUser();
        $interesse=$em->getRepository("PIDEVBundle:Interesse")->Selectmesfavoris($user);


        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator= $this->get('knp_paginator') ;
        $result=$paginator->paginate(
            $interesse,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',4)
        );

        return $this->render('PIDEVBundle:Interesse:mes_favoris.html.twig', array(
            'm'=>$result,
            'user'=> $user
        ));

    }
    public function TopEventAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager() ;
        $user = $this->getUser();
        $interesse=new Interesse();

        $idev=$interesse->getEvenement();
        $interesse=$em->getRepository("PIDEVBundle:Interesse")->TopEvenet($idev);


        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator= $this->get('knp_paginator') ;
        $result=$paginator->paginate(
            $interesse,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',4)
        );

        return $this->render('PIDEVBundle:Interesse:mes_favoris.html.twig', array(
            'm'=>$result,
            'user'=> $user
        ));

    }

}


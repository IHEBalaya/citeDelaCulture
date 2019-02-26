<?php

namespace PIDEVBundle\Controller;

use PIDEVBundle\Entity\Favoris;
use PIDEVBundle\Entity\Utilisateur;
use PIDEVBundle\Entity\Workshop;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class FavorisController extends Controller
{
    public function ajoutAction($ide)

    {
        $favoris = new Favoris() ; // objet vide

        $id=$this->container->get('security.token_storage')->getToken()->getUser()->getId();
        $favoris->setIdUser($this->getDoctrine()->getRepository(Utilisateur::class )->find($id));

        $favoris->setWorkshop($this->getDoctrine()->getRepository(Workshop::class )->find($ide));

        $em=$this->getDoctrine()->getManager(); // Déclaration Entity Manager
        $em->persist($favoris); // Persister l'obje dans l'ORM
        $em->flush(); // Sauvegarde des données dans la BD
        // ...

        return $this->redirectToRoute('affiche', array(
            'm'=>$favoris,

        ));

    }
    public function MesfavorisAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager() ;
        $user = $this->getUser();
        $favoris=$em->getRepository("PIDEVBundle:Favoris")->Selectmesfavoris($user);


        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator= $this->get('knp_paginator') ;
        $result=$paginator->paginate(
            $favoris,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',4)
        );

        return $this->render('PIDEVBundle:Favoris:mes_favoris.html.twig', array(
            'm'=>$result,
            'user'=> $user
        ));

    }
    public function TopWorkshopAction(Request $request )
    {

        $em=$this->getDoctrine()->getManager() ;
        $user = $this->getUser();
        $fv=new Favoris();
        $fv->$this->getWorkshop();
        $favoris=$em->getRepository("PIDEVBundle:Favoris")->TopWorkshop($fv);


        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator= $this->get('knp_paginator') ;
        $result=$paginator->paginate(
            $favoris,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',4)
        );

        return $this->render('PIDEVBundle:Favoris:TopWorkshop.html.twig', array(
            'm'=>$result,
            'user'=> $user,
            'fav'=>$favoris
        ));

    }
}

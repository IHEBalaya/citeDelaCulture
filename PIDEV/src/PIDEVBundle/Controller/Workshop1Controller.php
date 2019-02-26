<?php

namespace PIDEVBundle\Controller;

use PIDEVBundle\Entity\Favoris;
use PIDEVBundle\Entity\Workshop;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class Workshop1Controller extends Controller
{
    public function SupprimerAction($id)
    {

            $em=$this->getDoctrine()->getManager();
            $worshop=$em->getRepository(Workshop::class)->find($id);
            $em->remove($worshop);
            $em->flush();
            return $this->redirectToRoute("read");


    }
    public function SelectWorkshopByidSessionAction(Request $request,$idSession)
    {

        $em= $this->getDoctrine()->getManager();
        $Workshop=$em->getRepository(Workshop::class)->SelectWorkshopByidSession(($idSession));

        $paginator  = $this->get('knp_paginator');
        $pagination=$paginator->paginate(
            $Workshop, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );

        return $this->render('PIDEVBundle:Workshop:readWorkshopSession.html.twig', array(
            //"formations"=>$formations
            'pagination' => $pagination
        ));

    }
    public function SelectWorkshopAction(Request $request,$idSession)
    {

        $em= $this->getDoctrine()->getManager();
        $Workshop=$em->getRepository(Workshop::class)->SelectWorkshopByidSession(($idSession));

        $paginator  = $this->get('knp_paginator');
        $pagination=$paginator->paginate(
            $Workshop, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );

        return $this->render('@PIDEV/Admin/readWorkshopSession.html.twig', array(
            //"formations"=>$formations
            'pagination' => $pagination
        ));

    }
    public function recherche2Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->isXmlHttpRequest()) {
            $search = $request->get('search2');
            dump($search);
            $workshop = new Workshop();
            $repo= $em->getRepository(Workshop::class);
            $workshop = $repo->findAnnonce2($search);
            return $this->render('PIDEVBundle:Workshop:search2.html.twig'
                , array('m' => $workshop));
        }

    }
    public function voirWorkshopAction($id)
    {


        $em=$this->getDoctrine()->getManager();
        $user = $this->getUser();
        $workshop=$em->getRepository("PIDEVBundle:Workshop")->find($id);
        $results=$em->getRepository(Favoris::class)->findAll();

        return $this->render('PIDEVBundle:Workshop:voirworkshop.html.twig',array(
            'inter'=>$results,
            'workshop'=>$workshop,
            'user'=>$user
        ));

    }
}

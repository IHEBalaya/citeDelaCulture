<?php

namespace PIDEVBundle\Controller;

use PIDEVBundle\Entity\Session;
use PIDEVBundle\Entity\Workshop;
use PIDEVBundle\Form\SessionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SessionController extends Controller
{
    public function ajouterSessionAction(Request $request)
    {
        $session = new Session();

        $session-> setDateDeSes(new \DateTime());
        var_dump($session->getDateDeSes() > new \DateTime());
        $session-> setDateFinSes(new \DateTime());
        var_dump($session->getDateFinSes() > new \DateTime());
        var_dump($session->getDateFinSes() > $session->getDateDeSes());
        //preparation form
        $form = $this->createForm(SessionType::class, $session);
        //2eme etape:recuperation des donnees
        $form = $form->handleRequest($request);
        //test if our form is valid
        if ($request->isMethod('post')) {
            //3eme etape :enregistrement dans la DB
            //declaration entity manager
            $em = $this->getDoctrine()->getManager();
            if( $session->getDateFinSes()>$session->getDateDeSes())
            {
            //persister l objet modele dans l'ORM
            $em->persist($session);
            //save in the DB
            $em->flush();
            //redirection vers read
            return $this->redirectToRoute('affichersession');

            }
            else{
                $this->addFlash("error", "baddel date s7i7a!!");
            }
            //redirection vers read

        }

        return $this->render('@PIDEV/Session/ajouter_session.html.twig', array(
            'form' => $form->createView()
        ));
    }
    public function afficherSessionAction(Request $request)
    {


        $em=$this->getDoctrine()->getManager() ;
        $user = $this->getUser();
        $session=$em->getRepository("PIDEVBundle:Session")->findAll();


        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator= $this->get('knp_paginator') ;
        $result=$paginator->paginate(
            $session,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );

        return $this->render('@PIDEV/Session/afficherSession.html.twig', array(
            'm'=>$result,
            'user'=> $user
        ));

    }
    public function afficherAdminSessionAction(Request $request)
    {


        $em=$this->getDoctrine()->getManager() ;
        $user = $this->getUser();
        $session=$em->getRepository("PIDEVBundle:Session")->findAll();


        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator= $this->get('knp_paginator') ;
        $result=$paginator->paginate(
            $session,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );

        return $this->render('@PIDEV/Admin/afficherAdminSession.html.twig', array(
            'm'=>$result,
            'user'=> $user
        ));

    }
    public function SupprimerSessionAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $worshop=$em->getRepository(Session::class)->find($id);
        $em->remove($worshop);
        $em->flush();
        return $this->redirectToRoute("afficheradminsession");


    }
    public function updateSessionAction ($ide,Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $session=$em->getRepository(Session::class)->find($ide);
        $form=$this->createForm(SessionType::class,$session);
        $form->handleRequest($request);
        if($request->isMethod('post'))
        {
            $em=$this->getDoctrine()->getManager();
            $session->setIdUser($this->get('security.token_storage')->getToken()->getUser());

            $em->flush();
            return $this->redirectToRoute("afficheradminsession");
        }
        return $this->render('@PIDEV/Session/update_session.html.twig', array(
            'form'=>$form->createView()
        ));

    }


}

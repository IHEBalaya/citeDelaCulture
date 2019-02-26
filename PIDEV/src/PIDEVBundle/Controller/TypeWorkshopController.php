<?php

namespace PIDEVBundle\Controller;

use PIDEVBundle\Entity\TypeWorkshop;
use PIDEVBundle\Form\TypeWorkshopType;
use PIDEVBundle\Form\WorkshopType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TypeWorkshopController extends Controller
{
    public function ajoutTypeWorkAction(Request $request)
    {

        $typework = new TypeWorkshop();
        //preparation form
        $form = $this->createForm(TypeWorkshopType::class, $typework);
        //2eme etape:recuperation des donnees
        $form = $form->handleRequest($request);
        //test if our form is valid
        if ($request->isMethod('post')) {
            //3eme etape :enregistrement dans la DB
            //declaration entity manager
            $em = $this->getDoctrine()->getManager();
            $typework->setIdUser($this->get('security.token_storage')->getToken()->getUser());
            //persister l objet modele dans l'ORM

                $em->persist($typework);
                //save in the DB
                $em->flush();
                return $this->redirectToRoute('affichet');

            //redirection vers read
        }
        return $this->render('PIDEVBundle:TypeWorkshop:ajout_type_work.html.twig', array(
            'form'=>$form->createView(),
        ));
    }

    public function supprimerTypeWorkAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $typework=$em->getRepository(TypeWorkshop::class)->find($id);
        $em->remove($typework);
        $em->flush();
        return $this->redirectToRoute("affichet");
    }

    public function afficheTypeWorkAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager() ;
        $user = $this->getUser();
        $typework=$em->getRepository("PIDEVBundle:TypeWorkshop")->findAll();


        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator= $this->get('knp_paginator') ;
        $result=$paginator->paginate(
            $typework,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );

        return $this->render('PIDEVBundle:TypeWorkshop:affiche_type_work.html.twig', array(
            'm'=>$result,
            'user'=> $user
        ));
    }
    public function updateTypeWorkshopAction ($id,Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $typeworkshop=$em->getRepository(TypeWorkshop::class)->find($id);
        $form=$this->createForm(TypeWorkshopType::class,$typeworkshop);
        $form->handleRequest($request);
        if($request->isMethod('post'))
        {
            $em=$this->getDoctrine()->getManager();
            $typeworkshop->setIdUser($this->get('security.token_storage')->getToken()->getUser());

            $em->flush();
            return $this->redirectToRoute("");
        }
        return $this->render('@PIDEV/TypeWorkshop/update_tworkshop.html.twig', array(
            'form'=>$form->createView()
        ));

    }
}


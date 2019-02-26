<?php

namespace PIDEVBundle\Controller;

use PIDEVBundle\Entity\Categorie;
use PIDEVBundle\Entity\Evenement;
use PIDEVBundle\Form\CategorieType;
use PIDEVBundle\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class adminEController extends Controller
{
    public function listerAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager() ;

        $evenement=$em->getRepository("PIDEVBundle:Evenement")->findAll();


        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator= $this->get('knp_paginator') ;
        $result=$paginator->paginate(
            $evenement,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',5)
        );
        return $this->render('PIDEVBundle:adminE:lister.html.twig', array(
            'm'=>$result,
        ));
    }
    public function ajoutCategorieAction(Request $request)
    {

        $categorie = new Categorie();

        $form=$this->createForm(CategorieType::class,$categorie);
        //2eme etape:recuperation des donnees
        $form=$form->handleRequest($request);
        //test if our form is valid
        if($request->isMethod('post'))
        {

            $file = $request->files->get('image');
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $this->getParameter('evenement_directory'),
                $fileName
            );

            $categorie->setImages($fileName);


            $em=$this->getDoctrine()->getManager();



            //persister l objet modele dans l'ORM
            $em->persist($categorie);
            //save in the DB
            $em->flush();
            //redirection vers read
            return $this->redirectToRoute('listerc');
        }
        return $this->render('PIDEVBundle:adminE:ajoutC.html.twig', array(
            'form'=>$form->createView(),
        ));
    }
    public function ModifEvenementAction(Request $request,$id)
    {
        $evenement=new Evenement();
        $em=$this->getDoctrine()->getManager();
        $evenement->setDateFin(new \DateTime($request->get('date'))) ;

        $evenement=$em->getRepository(Evenement::class)->find($id);
        $form=$this->createForm(EvenementType::class,$evenement);
        $form=$form->handleRequest($request);

        if ($request->isMethod('post'))
        {
            $em=$this->getDoctrine()->getManager();

            $em->flush();
            return $this->redirectToRoute('lister');
        }
        return $this->render('PIDEVBundle:adminE:modif.html.twig', array(
            'form'=>$form->createView(),
        ));

    }
 public function listeCAction(Request $request)
 {
     $em=$this->getDoctrine()->getManager() ;
     $user = $this->getUser();
     $categorie=$em->getRepository("PIDEVBundle:Categorie")->findAll();


     /**
      * @var $paginator \Knp\Component\Pager\Paginator
      */

     $paginator= $this->get('knp_paginator') ;
     $result=$paginator->paginate(
         $categorie,
         $request->query->getInt('page',1),
         $request->query->getInt('limit',3)
     );

     return $this->render('PIDEVBundle:adminE:lister_categorie.html.twig', array(
         'm'=>$result,
         'user'=> $user
     ));
 }
    public function SupprimerCAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $categorie=$em->getRepository(Categorie::class)->find($id);
        $em->remove($categorie);
        $em->flush();
        return $this->redirectToRoute("listerc");

    }
}

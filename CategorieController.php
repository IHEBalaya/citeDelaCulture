<?php

namespace PIDEVBundle\Controller;

use PIDEVBundle\Entity\Categorie;
use PIDEVBundle\Entity\Evenement;
use PIDEVBundle\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategorieController extends Controller
{
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
        return $this->render('PIDEVBundle:Categorie:ajoutC.html.twig', array(
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

        return $this->render('PIDEVBundle:Categorie:voir_categorie.html.twig', array(
            'm'=>$result,
            'user'=> $user
        ));
    }
    public function SelectEvenementAction(Request $request,$idcategorie)
    {

        $em= $this->getDoctrine()->getManager();
        $evenement=$em->getRepository(Evenement::class)->SelectEvenementByidcategirie(($idcategorie));

        $paginator  = $this->get('knp_paginator');
        $pagination=$paginator->paginate(
            $evenement, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );

        return $this->render('@PIDEV/Categorie/listerEvenementCategorie.html.twig', array(
            //"formations"=>$formations
            'pagination' => $pagination
        ));

    }
}

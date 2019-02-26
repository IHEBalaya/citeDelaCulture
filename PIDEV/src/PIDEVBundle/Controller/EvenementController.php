<?php

namespace PIDEVBundle\Controller;


use PIDEVBundle\Entity\Evenement;
use PIDEVBundle\Form\EvenementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EvenementController extends Controller
{
    public function AjoutEvenementAction(Request $request)
    {
        $evenement = new Evenement();
        $form=$this->createForm(EvenementType::class,$evenement);
        //2eme etape:recuperation des donnees
        $form=$form->handleRequest($request);
        //test if our form is valid
        if($request->isMethod('post'))
        {
            $em=$this->getDoctrine()->getManager();

        //persister l objet modele dans l'ORM
        $em->persist($evenement);
        //save in the DB
        $em->flush();
        //redirection vers read
        return $this->redirectToRoute('index');
    }
        return $this->render('PIDEVBundle:Evenement:ajout_evenement.html.twig', array(
         'form'=>$form->createView()

          ));


    }
    public function ModifierEvenementAction()
    {
        return $this->render('PIDEVBundle:Evenement:modifier_evenement.html.twig', array(
            // ...
        ));
    }


    public function SupprimerEvenementAction()
    {
        return $this->render('PIDEVBundle:Evenement:supprimer_evenement.html.twig', array(
            // ...
        ));
    }


    /*
    AJOUT
    */

    public function AjouterEvenement1Action(Request $request)
    {
        $user = $this->getUser();
        if ($request->isMethod('post')) {
            $em = $this->getDoctrine()->getManager();
            $Evenement = new Evenement();

            $Evenement->setNom($request->get('nom'));
            $Evenement->setDateebut(new \DateTime($request->get('dateebut'))) ;
            $Evenement->setDateFin(new \DateTime($request->get('dateFin'))) ;
            $Evenement->setDescription($request->get('description'));
            $Evenement->setPrix($request->get('prix'));
            $Evenement->setIdUser($this->get('security.token_storage')->getToken()->getUser());
            $Evenement->getSalle();
            //exit(VarDumper::dump($Evenement));
            $em->persist($Evenement);
            $em->flush();
         //   return $this->redirectToRoute('lister_annonce_trouver');
        }
        return $this->render('PIDEVBundle:Evenement:ajout_evenement1.html.twig', array(
            'user' => $user
        ));
    }

    /*
AFfichage tous les evenements
     */


    public function listerEvenementAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager() ;
        $evenement=$em->getRepository("PIDEVBundle:Evenement");
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */


        return $this->render('PIDEVBundle:Evenement:lister_evenement.html.twig', array(
            'evenement'=>$evenement
          ));
    }






}

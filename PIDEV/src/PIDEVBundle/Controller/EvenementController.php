<?php

namespace PIDEVBundle\Controller;


use PIDEVBundle\Entity\Evenement;
use PIDEVBundle\Entity\Interesse;
use PIDEVBundle\Form\EvenementType;
use PIDEVBundle\Repository\InteresseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class EvenementController extends Controller
{
    public function AjoutEvenementAction(Request $request)
    {
        $user = $this->getUser();
        $evenement = new Evenement();
        $evenement->setDateFin(new \DateTime());
        var_dump($evenement->getDateFin()> new \DateTime());

        $form=$this->createForm(EvenementType::class,$evenement);
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

            $evenement->setImages($fileName);


            $em=$this->getDoctrine()->getManager();


            $evenement->setIdUser($this->get('security.token_storage')->getToken()->getUser());
            if ($evenement->getDateFin() >= new \DateTime() )
            {
        //persister l objet modele dans l'ORM
        $em->persist($evenement);
        //save in the DB
        $em->flush();
        //redirection vers read
        return $this->redirectToRoute('mesevenements');
    }
        return $this->render('PIDEVBundle:Evenement:ajout_evenement.html.twig', array(
         'form'=>$form->createView()

          ));
        }

    }
    public function ModifierEvenementAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $evenement=$em->getRepository(Evenement::class)->find($id);
        $form=$this->createForm(EvenementType::class,$evenement);
        $form=$form->handleRequest($request);
        if ($request->isMethod('post'))
        {
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('mesevenements');
        }
        return $this->render('PIDEVBundle:Evenement:modifier_evenement.html.twig', array(
            'form'=>$form->createView(),
        ));

    }


    public function SupprimerEvenementAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $evenement=$em->getRepository(Evenement::class)->find($id);
        $em->remove($evenement);
        $em->flush();
        return $this->redirectToRoute("mesevenements");

     }


    /*
    AJOUT
    */


    /*
AFfichage tous les evenements
     */

    public function ListerAction(Request $request)
    {


        $em=$this->getDoctrine()->getManager() ;
        $user = $this->getUser();
        $evenement=$em->getRepository("PIDEVBundle:Evenement")->findByDateDql(new \DateTime());


        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator= $this->get('knp_paginator') ;
        $result=$paginator->paginate(
            $evenement,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',4)
        );

        return $this->render('PIDEVBundle:Evenement:lister_evenement.html.twig', array(
            'm'=>$result,
            'user'=> $user
        ));
    }
    public function ListerHistoriqueAction(Request $request)
    {


        $em=$this->getDoctrine()->getManager() ;
        $user = $this->getUser();
        $evenement=$em->getRepository("PIDEVBundle:Evenement")->findByDateHDql(new \DateTime());


        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator= $this->get('knp_paginator') ;
        $result=$paginator->paginate(
            $evenement,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',4)
        );

        return $this->render('PIDEVBundle:Evenement:listerH_evenement.html.twig', array(
            'm'=>$result,
            'user'=> $user
        ));
    }


    public function recherche2Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->isXmlHttpRequest()) {
            $search = $request->get('search2');
            dump($search);
            $evenement = new Evenement();
            $repo= $em->getRepository('PIDEVBundle:Evenement');
            $evenement = $repo->findAnnonce2($search);
            return $this->render('PIDEVBundle:Evenement:search2.html.twig'
                , array('m' => $evenement));
        }

    }
    public function AfficherEvenementAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $user = $this->getUser();
        $evenement=$em->getRepository("PIDEVBundle:Evenement")->find($id);
        $results=$em->getRepository("PIDEVBundle:Interesse")->findAll();


        return $this->render('PIDEVBundle:Evenement:afficher_evenement.html.twig',array(
            'inter'=>$results,
            'evenement'=>$evenement,
            'user'=>$user
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

        return $this->render('@PIDEV/adminE/listerEvenementCategorie.html.twig', array(
            //"formations"=>$formations
            'pagination' => $pagination
        ));

    }
    public function afficherMesevenementAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager() ;
        $user = $this->getUser();
        $evenement=$em->getRepository("PIDEVBundle:Evenement")->SelectEvenementByidformateur($user);


        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator= $this->get('knp_paginator') ;
        $result=$paginator->paginate(
            $evenement,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',4)
        );

        return $this->render('PIDEVBundle:Evenement:mes_evenement.html.twig', array(
            'm'=>$result,
            'user'=> $user
        ));

    }


}

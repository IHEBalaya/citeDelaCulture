<?php

namespace PIDEVBundle\Controller;

use PIDEVBundle\Entity\Session;
use PIDEVBundle\Entity\Workshop;
use PIDEVBundle\Form\updateWorshopType;
use PIDEVBundle\Form\WorkshopType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class WorshopController extends Controller
{
    public function AjouterWorkshopAction(Request $request)
    {

        $workshop = new Workshop();
        $workshop-> setDate(new \DateTime());



        var_dump($workshop->getDate() > new \DateTime());
        //preparation form
        $form = $this->createForm(WorkshopType::class, $workshop);
        //2eme etape:recuperation des donnees
        $form = $form->handleRequest($request);
        //test if our form is valid
        if ($request->isMethod('post')) {
            $file = $request->files->get('image');
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $this->getParameter('workshop_directory'),
                $fileName
            );

            $workshop->setImages($fileName);//3eme etape :enregistrement dans la DB
            //declaration entity manager
            $em = $this->getDoctrine()->getManager();
            $workshop->setIdUser($this->get('security.token_storage')->getToken()->getUser());
            //persister l objet modele dans l'ORM
            if( $workshop->getDate() > new \DateTime()&& $workshop->getSalle()->getCapacite()> $workshop->getCapacite()) {
                $em->persist($workshop);
                //save in the DB
                $em->flush();
                return $this->redirectToRoute('affiche');

            }
            else{
                $this->addFlash("error", "baddel date s7i7a!!");
            }
            //redirection vers read
        }

        return $this->render('@PIDEV/Workshop/ajout_workshop.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function ListWorkshopBackAction(Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        //$dql   = "SELECT f FROM CupCakesBundle:Formation f WHERE idUser=".$this->getUser();
        $select=$em->getRepository(Workshop::class)->SelectWorkshopByidUSer($this->getUser());
        //$this->getUser();
        //$query = $em->createQuery($dql);
        $paginator  = $this->get('knp_paginator');
        $pagination=$paginator->paginate(
            $select, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );
        //$formations=$em->getRepository(Formation::class)->findAll();
        return $this->render('@PIDEV/Workshop/readworkshop.html.twig', array(
            //"formations"=>$formations
            'pagination' => $pagination

        ));
    }
    public function updateWorkshopAction ($id,Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $workshop=$em->getRepository(Workshop::class)->find($id);
        $form=$this->createForm(WorkshopType::class,$workshop);
        $form->handleRequest($request);
        if($request->isMethod('post'))
        {
            $em=$this->getDoctrine()->getManager();
            $workshop->setIdUser($this->get('security.token_storage')->getToken()->getUser());

            $em->flush();
            return $this->redirectToRoute("read");
        }
        return $this->render('@PIDEV/Workshop/update_workshop.html.twig', array(
            'form'=>$form->createView()
        ));

    }

    public function afficherWorkshopAction(Request $request)
    {


        $em=$this->getDoctrine()->getManager() ;
        $user = $this->getUser();


        $select=$em->getRepository(Workshop::class)->findByDateDql(new \DateTime() );



        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator= $this->get('knp_paginator') ;
        $result=$paginator->paginate(
            $select,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );

        return $this->render('@PIDEV/Workshop/afficher_workshop.html.twig', array(
            'm'=>$result,
            'user'=> $user));



    }
    public function ArchiveWorkshopAction(Request $request)
    {


        $em=$this->getDoctrine()->getManager() ;
        $user = $this->getUser();


        $select=$em->getRepository(Workshop::class)->findByDatearchive(new \DateTime() );



        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator= $this->get('knp_paginator') ;
        $result=$paginator->paginate(
            $select,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );

        return $this->render('@PIDEV/Workshop/ArchiveWorkshop.html.twig', array(
            'm'=>$result,
            'user'=> $user));



    }
    public function WorkshopAdminAction(Request $request)
    {


        $em=$this->getDoctrine()->getManager() ;
        $user = $this->getUser();


        $select=$em->getRepository(Workshop::class)->findByDateDql(new \DateTime() );



        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator= $this->get('knp_paginator') ;
        $result=$paginator->paginate(
            $select,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );

        return $this->render('@PIDEV/Admin/afficherAdmin.html.twig', array(
            'm'=>$result,
            'user'=> $user));



    }
    public function ArchiveAdminAction(Request $request)
    {


        $em=$this->getDoctrine()->getManager() ;
        $user = $this->getUser();


        $select=$em->getRepository(Workshop::class)->findByDatearchive(new \DateTime() );



        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */

        $paginator= $this->get('knp_paginator') ;
        $result=$paginator->paginate(
            $select,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );

        return $this->render('@PIDEV/Admin/ArchiveAdmin.html.twig', array(
            'm'=>$result,
            'user'=> $user));



    }


}
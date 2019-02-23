<?php

namespace PIDEVBundle\Controller;

use PIDEVBundle\Entity\Salle;
use PIDEVBundle\Form\SalleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SalleController extends Controller
{
    public function affichageSalleAction()
    {

        $salle=$this->getDoctrine()
            ->getRepository(Salle::class)
            ->findAll();
        return $this->render('@PIDEV\Salle\affichageSalle.html.twig', array(

            'salles'=>$salle
        ));
    }

    public function affichageSallesDisponiblesParDateAction()
    {

        $salle=$this->getDoctrine()
            ->getRepository(Salle::class)
            ->findAll();
        return $this->render('@PIDEV\Salle\affichageSalle.html.twig', array(

            'salles'=>$salle
        ));
    }

    public function ajoutSalleAction(Request $request)
    {$salle=new Salle();

        $form=$this->createForm(SalleType::class,$salle);

        $form=$form->handleRequest($request);

        if ($form->isValid()) {
            $salle->setEtat(0);
            $em=$this->getDoctrine()->getManager();
            $em->persist($salle);

            $em->flush();

            return $this->redirectToRoute('affichageSalle');
        }
        return $this->render('@PIDEV\Salle\ajoutSalle.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function modificationSalleAction(Request $request,$id)
    {

        $em=$this->getDoctrine()->getManager();

        $salle=$em->getRepository(Salle::class)->find($id);

        $form=$this->createForm(SalleType::class,$salle);

        $form=$form->handleRequest($request);
        if ($form->isValid())
        {$em->flush();
            return $this->redirectToRoute('affichageSalle');}
        return $this->render('@PIDEV\Salle\modificationSalle.html.twig', array(
            'form'=>$form->createView()
        ));

    }

    public function suppressionSalleAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $salle=$em->getRepository(Salle::class)->find($id);
        $em->remove($salle);
        $em->flush();
        return $this->redirectToRoute('affichageSalle');
    }

}

<?php

namespace PIDEVBundle\Controller;

use PIDEVBundle\Entity\Evenement;
use PIDEVBundle\Entity\Reservation;

use PIDEVBundle\Entity\Workshop;
use PIDEVBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReservationControllerController extends Controller
{
    public function affichageReservationAction()
    {

        $reservation=$this->getDoctrine()
            ->getRepository(Reservation::class)
            ->findAll();
        return $this->render('@PIDEV\Reservation\affichageReservation.html.twig', array(

            'reservations'=>$reservation
        ));
    }


    public function ajoutReservationAction(Request $request,$idE,$idW)
    {$reservation=new Reservation();

        $form=$this->createForm(ReservationType::class,$reservation);

        $form=$form->handleRequest($request);
        $e=0;
        if ($form->isValid()) {

            if (isset($idE)) {
            $reservation->setWorkshop(null);
                $evenement=$this->getDoctrine()
                    ->getRepository(Evenement::class)
                    ->find($idE);
                $reservation->setEvenement($evenement);
                $prix=$evenement->getPrix();
                if ($reservation->getDate() < $evenement->getDateebut() || $reservation->getDate() > $evenement->getDateFin())
                $e=1;

            }
            else if (isset($idW)) {
            $reservation->setEvenement(null);
                $workshop=$this->getDoctrine()
                    ->getRepository(Workshop::class)
                    ->find($idW);
                $reservation->setWorkshop($workshop);
                $prix=$workshop->getPrix();}
            else $prix=0;

            $reservation->setEtat(0);
           // $idEvenement=$reservation->getEvenement();
            $nbPersonne=$reservation->getNbrPersonne();

            $s=$prix*$nbPersonne;
            $reservation->setPrixTot($s);

            $em=$this->getDoctrine()->getManager();

            $em->persist($reservation);
            /* $modele2=new Modele();
             $modele2->setLib('Test3');
             $modele2->setPays('Libanon');
             $em->persist($modele2);*/
            $em->flush();
             if ($e==1) {
             return $this->render('@PIDEV\Reservation\erreurReservation.html.twig', array(
                 'form'=>$form->createView()));}
             return $this->redirectToRoute('affichageReservation');
        }
        return $this->render('@PIDEV\Reservation\ajoutReservation.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function modificationReservationAction(Request $request,$id)
    {

              $em=$this->getDoctrine()->getManager();

        $reservation=$em->getRepository(Reservation::class)->find($id);

        $form=$this->createForm(ReservationType::class,$reservation);

        $form=$form->handleRequest($request);
        if ($form->isValid())
        {$em->flush();
            return $this->redirectToRoute('affichageReservation');}
        return $this->render('@PIDEV\Reservation\modificationReservation.html.twig', array(
            'form'=>$form->createView()
        ));

    }

    public function suppressionReservationAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $reservation=$em->getRepository(Reservation::class)->find($id);
        $em->remove($reservation);
        $em->flush();
        return $this->redirectToRoute('affichageReservation');
    }




}


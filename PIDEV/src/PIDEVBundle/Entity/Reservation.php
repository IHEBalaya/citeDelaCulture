<?php

namespace PIDEVBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="PIDEVBundle\Repository\ReservationRepository")
 */

class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrPersonne", type="integer")
     */
    private $nbrPersonne;

    /**
     * @var float
     *
     * @ORM\Column(name="prixTot", type="float")
     */
    private $prixTot;

    /**
     * @ORM\ManyToOne(targetEntity="PIDEVBundle\Entity\Utilisateur")
     * @ORM\JoinColumn(name="IdUtilisateur",referencedColumnName="id")
     */

    private $user;


    /**
     * @ORM\ManyToOne(targetEntity="PIDEVBundle\Entity\Evenement")
     * @ORM\JoinColumn(name="IdEvenement",referencedColumnName="id")
     */

    private $evenement;

    /**
     * @ORM\ManyToOne(targetEntity="PIDEVBundle\Entity\Workshop")
     * @ORM\JoinColumn(name="IdW",referencedColumnName="id")
     */

    private $workshop;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Reservation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return Reservation
     */

    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return int
     */

    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set nbrPersonne
     *
     * @param integer $nbrPersonne
     *
     * @return Reservation
     */
    public function setNbrPersonne($nbrPersonne)
    {
        $this->nbrPersonne = $nbrPersonne;

        return $this;
    }

    /**
     * Get nbrPersonne
     *
     * @return int
     */
    public function getNbrPersonne()
    {
        return $this->nbrPersonne;
    }

    /**
     * Set prixTot
     *
     * @param float $prixTot
     *
     * @return Reservation
     */
    public function setPrixTot($prixTot)
    {
        $this->prixTot = $prixTot;

        return $this;
    }

    /**
     * Get prixTot
     *
     * @return float
     */
    public function getPrixTot()
    {
        return $this->prixTot;
    }


      public function getUser()
    {
        return $this->user;

    }

    public function setUser($u)
    {$this->user=$u;
        return $this;}

    public function getEvenement()
    {
        return $this->evenement;
    }
    public function setEvenement($u)
    {
         $this->evenement=$u;
        return $this;
    }



    public function setWorkshop($w)
    {$this->workshop=$w;
        return $this;}

    public function getWorkshop()
    {
        return $this->workshop;
    }



}

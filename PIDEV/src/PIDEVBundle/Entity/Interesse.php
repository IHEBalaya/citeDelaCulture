<?php

namespace PIDEVBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Interesse
 *
 * @ORM\Table(name="interesse")
 * @ORM\Entity(repositoryClass="PIDEVBundle\Repository\InteresseRepository")
 */
class Interesse
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
     * @ORM\ManyToOne(targetEntity="PIDEVBundle\Entity\Evenement")
     *
     * @ORM\JoinColumn(name="evenement",referencedColumnName="id")
     */
    private $evenement;
    /**
     * @ORM\ManyToOne(targetEntity="PIDEVBundle\Entity\Utilisateur")
     *
     * @ORM\JoinColumn(name="idUser",referencedColumnName="id")
     */
    private $idUser;

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
     * Set evenement
     *
     * @param \PIDEVBundle\Entity\Evenement $evenement
     *
     * @return Interesse
     */
    public function setEvenement(\PIDEVBundle\Entity\Evenement $evenement = null)
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * Get evenement
     *
     * @return \PIDEVBundle\Entity\Evenement
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * Set idUser
     *
     * @param \PIDEVBundle\Entity\Utilisateur $idUser
     *
     * @return Interesse
     */
    public function setIdUser(\PIDEVBundle\Entity\Utilisateur $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \PIDEVBundle\Entity\Utilisateur
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}

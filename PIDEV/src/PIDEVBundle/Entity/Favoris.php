<?php

namespace PIDEVBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favoris
 *
 * @ORM\Table(name="favoris")
 * @ORM\Entity(repositoryClass="PIDEVBundle\Repository\FavorisRepository")
 */
class Favoris
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
     * @ORM\ManyToOne(targetEntity="PIDEVBundle\Entity\Utilisateur")
     *
     * @ORM\JoinColumn(name="idUser",referencedColumnName="id")
     */
    private $idUser;
    /**
     * @ORM\ManyToOne(targetEntity="PIDEVBundle\Entity\Workshop")
     *
     * @ORM\JoinColumn(name="workshop",referencedColumnName="id")
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
     * Set idUser
     *
     * @param \PIDEVBundle\Entity\Utilisateur $idUser
     *
     * @return Favoris
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

    /**
     * Set workshop
     *
     * @param \PIDEVBundle\Entity\Workshop $workshop
     *
     * @return Favoris
     */
    public function setWorkshop(\PIDEVBundle\Entity\Workshop $workshop = null)
    {
        $this->workshop = $workshop;

        return $this;
    }

    /**
     * Get workshop
     *
     * @return \PIDEVBundle\Entity\Workshop
     */
    public function getWorkshop()
    {
        return $this->workshop;
    }
}

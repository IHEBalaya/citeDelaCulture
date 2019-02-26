<?php

namespace PIDEVBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneAchat
 *
 * @ORM\Table(name="ligne_achat")
 * @ORM\Entity(repositoryClass="PIDEVBundle\Repository\LigneAchatRepository")
 */
class LigneAchat
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
     * @var int
     *
     * @ORM\Column(name="nbProduit", type="integer")
     */
    private $nbProduit;


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
     * Set nbProduit
     *
     * @param integer $nbProduit
     *
     * @return LigneAchat
     */
    public function setNbProduit($nbProduit)
    {
        $this->nbProduit = $nbProduit;

        return $this;
    }

    /**
     * Get nbProduit
     *
     * @return int
     */
    public function getNbProduit()
    {
        return $this->nbProduit;
    }
}


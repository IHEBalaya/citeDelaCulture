<?php

namespace PIDEVBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="panier")
 * @ORM\Entity(repositoryClass="PIDEVBundle\Repository\PanierRepository")
 */
class Panier
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
     * @ORM\Column(name="nbArticle", type="integer")
     */
    private $nbArticle;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;


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
     * Set nbArticle
     *
     * @param integer $nbArticle
     *
     * @return Panier
     */
    public function setNbArticle($nbArticle)
    {
        $this->nbArticle = $nbArticle;

        return $this;
    }

    /**
     * Get nbArticle
     *
     * @return int
     */
    public function getNbArticle()
    {
        return $this->nbArticle;
    }

    /**
     * Set total
     *
     * @param float $total
     *
     * @return Panier
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }
}


<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reaction
 *
 * @ORM\Table(name="reaction", indexes={@ORM\Index(name="FK_A4D707F7DCA7A716", columns={"id_article"}), @ORM\Index(name="FK_A4D707F79E15807", columns={"reacteur"})})
 * @ORM\Entity
 */
class Reaction
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_reaction", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReaction;

    /**
     * @var float
     *
     * @ORM\Column(name="reaction", type="float")
     */
    private $reaction;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reacteur", referencedColumnName="id")
     * })
     */
    private $reacteur;

    /**
     * @var Article
     *
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_article", referencedColumnName="id_article")
     * })
     */
    private $idArticle;



    /**
     * Get idReaction
     *
     * @return integer
     */
    public function getIdReaction()
    {
        return $this->idReaction;
    }

    /**
     * Set reaction
     *
     * @param float $reaction
     *
     * @return Reaction
     */
    public function setReaction($reaction)
    {
        $this->reaction = $reaction;

        return $this;
    }

    /**
     * Get reaction
     *
     * @return float
     */
    public function getReaction()
    {
        return $this->reaction;
    }

    /**
     * Set reacteur
     *
     * @param \AppBundle\Entity\User $reacteur
     *
     * @return Reaction
     */
    public function setReacteur(\AppBundle\Entity\User $reacteur = null)
    {
        $this->reacteur = $reacteur;

        return $this;
    }

    /**
     * Get reacteur
     *
     * @return \AppBundle\Entity\User
     */
    public function getReacteur()
    {
        return $this->reacteur;
    }

    /**
     * Set idArticle
     *
     * @param \AppBundle\Entity\Article $idArticle
     *
     * @return Reaction
     */
    public function setIdArticle(\AppBundle\Entity\Article $idArticle = null)
    {
        $this->idArticle = $idArticle;

        return $this;
    }

    /**
     * Get idArticle
     *
     * @return \AppBundle\Entity\Article
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }
}

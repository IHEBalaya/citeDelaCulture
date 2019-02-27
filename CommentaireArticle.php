<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * CommentaireArticle
 *
 * @ORM\Table(name="commentaire_article", indexes={@ORM\Index(name="FK_71F29C35DCA7A716", columns={"id_article"}), @ORM\Index(name="FK_71F29C355F61D8B4", columns={"commentateur"})})
 * @ORM\Entity
 */
class CommentaireArticle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_commentaire", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCommentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu_commentaire", type="string", length=255, nullable=true)
     */
    private $contenuCommentaire;

    /**
     * @var Date
     *
     * @ORM\Column(name="date_commentaire", type="date")
     */
    private $dateCommentaire;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="commentateur", referencedColumnName="id")
     * })
     */
    private $commentateur;

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
     * Get idCommentaire
     *
     * @return integer
     */
    public function getIdCommentaire()
    {
        return $this->idCommentaire;
    }

    /**
     * Set contenuCommentaire
     *
     * @param string $contenuCommentaire
     *
     * @return CommentaireArticle
     */
    public function setContenuCommentaire($contenuCommentaire)
    {
        $this->contenuCommentaire = $contenuCommentaire;

        return $this;
    }

    /**
     * Get contenuCommentaire
     *
     * @return string
     */
    public function getContenuCommentaire()
    {
        return $this->contenuCommentaire;
    }

    /**
     * Set dateCommentaire
     *
     * @param Date $dateCommentaire
     *
     * @return CommentaireArticle
     */
    public function setDateCommentaire($dateCommentaire)
    {
        $this->dateCommentaire = $dateCommentaire;

        return $this;
    }

    /**
     * Get dateCommentaire
     *
     * @return Date
     */
    public function getDateCommentaire()
    {
        return $this->dateCommentaire;
    }

    /**
     * Set commentateur
     *
     * @param \AppBundle\Entity\User $commentateur
     *
     * @return CommentaireArticle
     */
    public function setCommentateur(\AppBundle\Entity\User $commentateur = null)
    {
        $this->commentateur = $commentateur;

        return $this;
    }

    /**
     * Get commentateur
     *
     * @return \AppBundle\Entity\User
     */
    public function getCommentateur()
    {
        return $this->commentateur;
    }

    /**
     * Set idArticle
     *
     * @param \AppBundle\Entity\Article $idArticle
     *
     * @return CommentaireArticle
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

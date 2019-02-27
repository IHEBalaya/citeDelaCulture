<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Article
 *
 * @ORM\Table(name="article", indexes={@ORM\Index(name="article_ibfk_1", columns={"journaliste"})})
 * @ORM\Entity
 */
class Article
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_article", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_article", type="string", length=255, nullable=true)
     */
    private $titreArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="type_article", type="string", length=255, nullable=true)
     */
    private $typeArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="description_article", type="text", length=65535, nullable=true)
     */
    private $descriptionArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu_article", type="text", length=65535, nullable=true)
     */
    private $contenuArticle;

    /**
     * @var Date
     *
     * @ORM\Column(name="date_publication", type="date")
     */
    private $datePublication;

    /**
     * @var string
     *
     * @ORM\Column(name="image_article", type="string", length=255, nullable=true)
     */
    private $imageArticle;

    /**
     * @var string
     *
     * @ORM\Column(name="statut_article", type="string", length=20, nullable=true)
     */
    private $statutArticle;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="journaliste", referencedColumnName="id")
     * })
     */
    private $journaliste;



    /**
     * Get idArticle
     *
     * @return integer
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * Set titreArticle
     *
     * @param string $titreArticle
     *
     * @return Article
     */
    public function setTitreArticle($titreArticle)
    {
        $this->titreArticle = $titreArticle;

        return $this;
    }

    /**
     * Get titreArticle
     *
     * @return string
     */
    public function getTitreArticle()
    {
        return $this->titreArticle;
    }

    /**
     * Set typeArticle
     *
     * @param string $typeArticle
     *
     * @return Article
     */
    public function setTypeArticle($typeArticle)
    {
        $this->typeArticle = $typeArticle;

        return $this;
    }

    /**
     * Get typeArticle
     *
     * @return string
     */
    public function getTypeArticle()
    {
        return $this->typeArticle;
    }

    /**
     * Set descriptionArticle
     *
     * @param string $descriptionArticle
     *
     * @return Article
     */
    public function setDescriptionArticle($descriptionArticle)
    {
        $this->descriptionArticle = $descriptionArticle;

        return $this;
    }

    /**
     * Get descriptionArticle
     *
     * @return string
     */
    public function getDescriptionArticle()
    {
        return $this->descriptionArticle;
    }

    /**
     * Set contenuArticle
     *
     * @param string $contenuArticle
     *
     * @return Article
     */
    public function setContenuArticle($contenuArticle)
    {
        $this->contenuArticle = $contenuArticle;

        return $this;
    }

    /**
     * Get contenuArticle
     *
     * @return string
     */
    public function getContenuArticle()
    {
        return $this->contenuArticle;
    }

    /**
     * Set datePublication
     *
     * @param Date $datePublication
     *
     * @return Article
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return string
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set imageArticle
     *
     * @param string $imageArticle
     *
     * @return Article
     */
    public function setImageArticle($imageArticle)
    {
        $this->imageArticle = $imageArticle;

        return $this;
    }

    /**
     * Get imageArticle
     *
     * @return string
     */
    public function getImageArticle()
    {
        return $this->imageArticle;
    }

    /**
     * Set statutArticle
     *
     * @param string $statutArticle
     *
     * @return Article
     */
    public function setStatutArticle($statutArticle)
    {
        $this->statutArticle = $statutArticle;

        return $this;
    }

    /**
     * Get statutArticle
     *
     * @return string
     */
    public function getStatutArticle()
    {
        return $this->statutArticle;
    }

    /**
     * Set journaliste
     *
     * @param \AppBundle\Entity\User $journaliste
     *
     * @return Article
     */
    public function setJournaliste(\AppBundle\Entity\User $journaliste = null)
    {
        $this->journaliste = $journaliste;

        return $this;
    }

    /**
     * Get journaliste
     *
     * @return \AppBundle\Entity\User
     */
    public function getJournaliste()
    {
        return $this->journaliste;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Personne
 *
 * @ORM\Table(name="personne")
 * @ORM\Entity
 */
class Personne
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_personne", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPersonne;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_personne", type="string", length=255, nullable=true)
     */
    private $nomPersonne;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_personne", type="string", length=255, nullable=true)
     */
    private $prenomPersonne;



    /**
     * Get idPersonne
     *
     * @return integer
     */
    public function getIdPersonne()
    {
        return $this->idPersonne;
    }

    /**
     * Set nomPersonne
     *
     * @param string $nomPersonne
     *
     * @return Personne
     */
    public function setNomPersonne($nomPersonne)
    {
        $this->nomPersonne = $nomPersonne;

        return $this;
    }

    /**
     * Get nomPersonne
     *
     * @return string
     */
    public function getNomPersonne()
    {
        return $this->nomPersonne;
    }

    /**
     * Set prenomPersonne
     *
     * @param string $prenomPersonne
     *
     * @return Personne
     */
    public function setPrenomPersonne($prenomPersonne)
    {
        $this->prenomPersonne = $prenomPersonne;

        return $this;
    }

    /**
     * Get prenomPersonne
     *
     * @return string
     */
    public function getPrenomPersonne()
    {
        return $this->prenomPersonne;
    }
}

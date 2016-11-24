<?php

namespace AppBundle\Entity;

/**
 * Eventoypeliculas
 */
class Eventoypeliculas
{
    /**
     * @var string
     */
    private $nombreevento;

    /**
     * @var \DateTime
     */
    private $fechainicio;

    /**
     * @var float
     */
    private $costoevento;

    /**
     * @var integer
     */
    private $idevento;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $idabonado;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idabonado = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nombreevento
     *
     * @param string $nombreevento
     *
     * @return Eventoypeliculas
     */
    public function setNombreevento($nombreevento)
    {
        $this->nombreevento = $nombreevento;

        return $this;
    }

    /**
     * Get nombreevento
     *
     * @return string
     */
    public function getNombreevento()
    {
        return $this->nombreevento;
    }

    /**
     * Set fechainicio
     *
     * @param \DateTime $fechainicio
     *
     * @return Eventoypeliculas
     */
    public function setFechainicio($fechainicio)
    {
        $this->fechainicio = $fechainicio;

        return $this;
    }

    /**
     * Get fechainicio
     *
     * @return \DateTime
     */
    public function getFechainicio()
    {
        return $this->fechainicio;
    }

    /**
     * Set costoevento
     *
     * @param float $costoevento
     *
     * @return Eventoypeliculas
     */
    public function setCostoevento($costoevento)
    {
        $this->costoevento = $costoevento;

        return $this;
    }

    /**
     * Get costoevento
     *
     * @return float
     */
    public function getCostoevento()
    {
        return $this->costoevento;
    }

    /**
     * Get idevento
     *
     * @return integer
     */
    public function getIdevento()
    {
        return $this->idevento;
    }

    /**
     * Add idabonado
     *
     * @param \AppBundle\Entity\Abonado $idabonado
     *
     * @return Eventoypeliculas
     */
    public function addIdabonado(\AppBundle\Entity\Abonado $idabonado)
    {
        $this->idabonado[] = $idabonado;

        return $this;
    }

    /**
     * Remove idabonado
     *
     * @param \AppBundle\Entity\Abonado $idabonado
     */
    public function removeIdabonado(\AppBundle\Entity\Abonado $idabonado)
    {
        $this->idabonado->removeElement($idabonado);
    }

    /**
     * Get idabonado
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdabonado()
    {
        return $this->idabonado;
    }
}


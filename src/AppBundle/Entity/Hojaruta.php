<?php

namespace AppBundle\Entity;

/**
 * Hojaruta
 */
class Hojaruta
{
    /**
     * @var \DateTime
     */
    private $fechaemision;

    /**
     * @var integer
     */
    private $idhojaruta;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $idconexion;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idconexion = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set fechaemision
     *
     * @param \DateTime $fechaemision
     *
     * @return Hojaruta
     */
    public function setFechaemision($fechaemision)
    {
        $this->fechaemision = $fechaemision;

        return $this;
    }

    /**
     * Get fechaemision
     *
     * @return \DateTime
     */
    public function getFechaemision()
    {
        return $this->fechaemision;
    }

    /**
     * Get idhojaruta
     *
     * @return integer
     */
    public function getIdhojaruta()
    {
        return $this->idhojaruta;
    }

    /**
     * Add idconexion
     *
     * @param \AppBundle\Entity\Conexion $idconexion
     *
     * @return Hojaruta
     */
    public function addIdconexion(\AppBundle\Entity\Conexion $idconexion)
    {
        $this->idconexion[] = $idconexion;

        return $this;
    }

    /**
     * Remove idconexion
     *
     * @param \AppBundle\Entity\Conexion $idconexion
     */
    public function removeIdconexion(\AppBundle\Entity\Conexion $idconexion)
    {
        $this->idconexion->removeElement($idconexion);
    }

    /**
     * Get idconexion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdconexion()
    {
        return $this->idconexion;
    }
}


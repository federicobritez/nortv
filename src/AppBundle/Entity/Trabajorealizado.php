<?php

namespace AppBundle\Entity;

/**
 * Trabajorealizado
 */
class Trabajorealizado
{
    /**
     * @var integer
     */
    private $cantinsumos;

    /**
     * @var \DateTime
     */
    private $fechatrabajo;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var \AppBundle\Entity\Trabajo
     */
    private $idtrabajo;

    /**
     * @var \AppBundle\Entity\Insumo
     */
    private $idinsumo;

    /**
     * @var \AppBundle\Entity\Equipotecnico
     */
    private $idequipotecnico;


    /**
     * Set cantinsumos
     *
     * @param integer $cantinsumos
     *
     * @return Trabajorealizado
     */
    public function setCantinsumos($cantinsumos)
    {
        $this->cantinsumos = $cantinsumos;

        return $this;
    }

    /**
     * Get cantinsumos
     *
     * @return integer
     */
    public function getCantinsumos()
    {
        return $this->cantinsumos;
    }

    /**
     * Set fechatrabajo
     *
     * @param \DateTime $fechatrabajo
     *
     * @return Trabajorealizado
     */
    public function setFechatrabajo($fechatrabajo)
    {
        $this->fechatrabajo = $fechatrabajo;

        return $this;
    }

    /**
     * Get fechatrabajo
     *
     * @return \DateTime
     */
    public function getFechatrabajo()
    {
        return $this->fechatrabajo;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return Trabajorealizado
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set idtrabajo
     *
     * @param \AppBundle\Entity\Trabajo $idtrabajo
     *
     * @return Trabajorealizado
     */
    public function setIdtrabajo(\AppBundle\Entity\Trabajo $idtrabajo)
    {
        $this->idtrabajo = $idtrabajo;

        return $this;
    }

    /**
     * Get idtrabajo
     *
     * @return \AppBundle\Entity\Trabajo
     */
    public function getIdtrabajo()
    {
        return $this->idtrabajo;
    }

    /**
     * Set idinsumo
     *
     * @param \AppBundle\Entity\Insumo $idinsumo
     *
     * @return Trabajorealizado
     */
    public function setIdinsumo(\AppBundle\Entity\Insumo $idinsumo)
    {
        $this->idinsumo = $idinsumo;

        return $this;
    }

    /**
     * Get idinsumo
     *
     * @return \AppBundle\Entity\Insumo
     */
    public function getIdinsumo()
    {
        return $this->idinsumo;
    }

    /**
     * Set idequipotecnico
     *
     * @param \AppBundle\Entity\Equipotecnico $idequipotecnico
     *
     * @return Trabajorealizado
     */
    public function setIdequipotecnico(\AppBundle\Entity\Equipotecnico $idequipotecnico)
    {
        $this->idequipotecnico = $idequipotecnico;

        return $this;
    }

    /**
     * Get idequipotecnico
     *
     * @return \AppBundle\Entity\Equipotecnico
     */
    public function getIdequipotecnico()
    {
        return $this->idequipotecnico;
    }
}


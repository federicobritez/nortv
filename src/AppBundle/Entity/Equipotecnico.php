<?php

namespace AppBundle\Entity;

/**
 * Equipotecnico
 */
class Equipotecnico
{
    /**
     * @var string
     */
    private $vehiculoasignado;

    /**
     * @var integer
     */
    private $idequipotecnico;

    /**
     * @var \AppBundle\Entity\Zona
     */
    private $idzona;


    /**
     * Set vehiculoasignado
     *
     * @param string $vehiculoasignado
     *
     * @return Equipotecnico
     */
    public function setVehiculoasignado($vehiculoasignado)
    {
        $this->vehiculoasignado = $vehiculoasignado;

        return $this;
    }

    /**
     * Get vehiculoasignado
     *
     * @return string
     */
    public function getVehiculoasignado()
    {
        return $this->vehiculoasignado;
    }

    /**
     * Get idequipotecnico
     *
     * @return integer
     */
    public function getIdequipotecnico()
    {
        return $this->idequipotecnico;
    }

    /**
     * Set idzona
     *
     * @param \AppBundle\Entity\Zona $idzona
     *
     * @return Equipotecnico
     */
    public function setIdzona(\AppBundle\Entity\Zona $idzona = null)
    {
        $this->idzona = $idzona;

        return $this;
    }

    /**
     * Get idzona
     *
     * @return \AppBundle\Entity\Zona
     */
    public function getIdzona()
    {
        return $this->idzona;
    }
}


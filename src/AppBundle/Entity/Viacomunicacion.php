<?php

namespace AppBundle\Entity;

/**
 * Viacomunicacion
 */
class Viacomunicacion
{
    /**
     * @var string
     */
    private $nombreviacomunicacion;

    /**
     * @var integer
     */
    private $idviacomunicacion;


    /**
     * Set nombreviacomunicacion
     *
     * @param string $nombreviacomunicacion
     *
     * @return Viacomunicacion
     */
    public function setNombreviacomunicacion($nombreviacomunicacion)
    {
        $this->nombreviacomunicacion = $nombreviacomunicacion;

        return $this;
    }

    /**
     * Get nombreviacomunicacion
     *
     * @return string
     */
    public function getNombreviacomunicacion()
    {
        return $this->nombreviacomunicacion;
    }

    /**
     * Get idviacomunicacion
     *
     * @return integer
     */
    public function getIdviacomunicacion()
    {
        return $this->idviacomunicacion;
    }
}


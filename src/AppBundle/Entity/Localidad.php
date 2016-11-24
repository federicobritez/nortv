<?php

namespace AppBundle\Entity;

/**
 * Localidad
 */
class Localidad
{
    /**
     * @var string
     */
    private $nombrelocalidad;

    /**
     * @var string
     */
    private $codigopostal;

    /**
     * @var integer
     */
    private $idlocalidad;

    /**
     * @var \AppBundle\Entity\Zona
     */
    private $idzona;


    /**
     * Set nombrelocalidad
     *
     * @param string $nombrelocalidad
     *
     * @return Localidad
     */
    public function setNombrelocalidad($nombrelocalidad)
    {
        $this->nombrelocalidad = $nombrelocalidad;

        return $this;
    }

    /**
     * Get nombrelocalidad
     *
     * @return string
     */
    public function getNombrelocalidad()
    {
        return $this->nombrelocalidad;
    }

    /**
     * Set codigopostal
     *
     * @param string $codigopostal
     *
     * @return Localidad
     */
    public function setCodigopostal($codigopostal)
    {
        $this->codigopostal = $codigopostal;

        return $this;
    }

    /**
     * Get codigopostal
     *
     * @return string
     */
    public function getCodigopostal()
    {
        return $this->codigopostal;
    }

    /**
     * Get idlocalidad
     *
     * @return integer
     */
    public function getIdlocalidad()
    {
        return $this->idlocalidad;
    }

    /**
     * Set idzona
     *
     * @param \AppBundle\Entity\Zona $idzona
     *
     * @return Localidad
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


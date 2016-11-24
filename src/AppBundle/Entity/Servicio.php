<?php

namespace AppBundle\Entity;

/**
 * Servicio
 */
class Servicio
{
    /**
     * @var float
     */
    private $costo;

    /**
     * @var integer
     */
    private $cantcanales;

    /**
     * @var integer
     */
    private $cantcanaleshd;

    /**
     * @var integer
     */
    private $cantcanalespelicula;

    /**
     * @var integer
     */
    private $espremium;

    /**
     * @var integer
     */
    private $esplus;

    /**
     * @var integer
     */
    private $esestandar;

    /**
     * @var string
     */
    private $nombreservicio;

    /**
     * @var integer
     */
    private $idservicio;


    /**
     * Set costo
     *
     * @param float $costo
     *
     * @return Servicio
     */
    public function setCosto($costo)
    {
        $this->costo = $costo;

        return $this;
    }

    /**
     * Get costo
     *
     * @return float
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * Set cantcanales
     *
     * @param integer $cantcanales
     *
     * @return Servicio
     */
    public function setCantcanales($cantcanales)
    {
        $this->cantcanales = $cantcanales;

        return $this;
    }

    /**
     * Get cantcanales
     *
     * @return integer
     */
    public function getCantcanales()
    {
        return $this->cantcanales;
    }

    /**
     * Set cantcanaleshd
     *
     * @param integer $cantcanaleshd
     *
     * @return Servicio
     */
    public function setCantcanaleshd($cantcanaleshd)
    {
        $this->cantcanaleshd = $cantcanaleshd;

        return $this;
    }

    /**
     * Get cantcanaleshd
     *
     * @return integer
     */
    public function getCantcanaleshd()
    {
        return $this->cantcanaleshd;
    }

    /**
     * Set cantcanalespelicula
     *
     * @param integer $cantcanalespelicula
     *
     * @return Servicio
     */
    public function setCantcanalespelicula($cantcanalespelicula)
    {
        $this->cantcanalespelicula = $cantcanalespelicula;

        return $this;
    }

    /**
     * Get cantcanalespelicula
     *
     * @return integer
     */
    public function getCantcanalespelicula()
    {
        return $this->cantcanalespelicula;
    }

    /**
     * Set espremium
     *
     * @param integer $espremium
     *
     * @return Servicio
     */
    public function setEspremium($espremium)
    {
        $this->espremium = $espremium;

        return $this;
    }

    /**
     * Get espremium
     *
     * @return integer
     */
    public function getEspremium()
    {
        return $this->espremium;
    }

    /**
     * Set esplus
     *
     * @param integer $esplus
     *
     * @return Servicio
     */
    public function setEsplus($esplus)
    {
        $this->esplus = $esplus;

        return $this;
    }

    /**
     * Get esplus
     *
     * @return integer
     */
    public function getEsplus()
    {
        return $this->esplus;
    }

    /**
     * Set esestandar
     *
     * @param integer $esestandar
     *
     * @return Servicio
     */
    public function setEsestandar($esestandar)
    {
        $this->esestandar = $esestandar;

        return $this;
    }

    /**
     * Get esestandar
     *
     * @return integer
     */
    public function getEsestandar()
    {
        return $this->esestandar;
    }

    /**
     * Set nombreservicio
     *
     * @param string $nombreservicio
     *
     * @return Servicio
     */
    public function setNombreservicio($nombreservicio)
    {
        $this->nombreservicio = $nombreservicio;

        return $this;
    }

    /**
     * Get nombreservicio
     *
     * @return string
     */
    public function getNombreservicio()
    {
        return $this->nombreservicio;
    }

    /**
     * Get idservicio
     *
     * @return integer
     */
    public function getIdservicio()
    {
        return $this->idservicio;
    }
}


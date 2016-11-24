<?php

namespace AppBundle\Entity;

/**
 * Reclamo
 */
class Reclamo
{
    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $estadoreclamo;

    /**
     * @var integer
     */
    private $idreclamo;


    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Reclamo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set estadoreclamo
     *
     * @param string $estadoreclamo
     *
     * @return Reclamo
     */
    public function setEstadoreclamo($estadoreclamo)
    {
        $this->estadoreclamo = $estadoreclamo;

        return $this;
    }

    /**
     * Get estadoreclamo
     *
     * @return string
     */
    public function getEstadoreclamo()
    {
        return $this->estadoreclamo;
    }

    /**
     * Get idreclamo
     *
     * @return integer
     */
    public function getIdreclamo()
    {
        return $this->idreclamo;
    }
}


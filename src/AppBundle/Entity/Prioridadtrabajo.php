<?php

namespace AppBundle\Entity;

/**
 * Prioridadtrabajo
 */
class Prioridadtrabajo
{
    /**
     * @var string
     */
    private $nombreprioridad;

    /**
     * @var integer
     */
    private $idprioridadtrabajo;


    /**
     * Set nombreprioridad
     *
     * @param string $nombreprioridad
     *
     * @return Prioridadtrabajo
     */
    public function setNombreprioridad($nombreprioridad)
    {
        $this->nombreprioridad = $nombreprioridad;

        return $this;
    }

    /**
     * Get nombreprioridad
     *
     * @return string
     */
    public function getNombreprioridad()
    {
        return $this->nombreprioridad;
    }

    /**
     * Get idprioridadtrabajo
     *
     * @return integer
     */
    public function getIdprioridadtrabajo()
    {
        return $this->idprioridadtrabajo;
    }
}


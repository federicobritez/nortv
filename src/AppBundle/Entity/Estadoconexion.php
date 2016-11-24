<?php

namespace AppBundle\Entity;

/**
 * Estadoconexion
 */
class Estadoconexion
{
    /**
     * @var string
     */
    private $nombreestadoconexion;

    /**
     * @var string
     */
    private $color;

    /**
     * @var integer
     */
    private $idestadoconexion;


    /**
     * Set nombreestadoconexion
     *
     * @param string $nombreestadoconexion
     *
     * @return Estadoconexion
     */
    public function setNombreestadoconexion($nombreestadoconexion)
    {
        $this->nombreestadoconexion = $nombreestadoconexion;

        return $this;
    }

    /**
     * Get nombreestadoconexion
     *
     * @return string
     */
    public function getNombreestadoconexion()
    {
        return $this->nombreestadoconexion;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Estadoconexion
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Get idestadoconexion
     *
     * @return integer
     */
    public function getIdestadoconexion()
    {
        return $this->idestadoconexion;
    }
}


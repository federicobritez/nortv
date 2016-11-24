<?php

namespace AppBundle\Entity;

/**
 * Zona
 */
class Zona
{
    /**
     * @var string
     */
    private $nombre;

    /**
     * @var integer
     */
    private $idzona;


    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Zona
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get idzona
     *
     * @return integer
     */
    public function getIdzona()
    {
        return $this->idzona;
    }
}


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
    private $nombrezona;

    /**
     * @var integer
     */
    private $idzona;


    /**
     * Set nombrezona
     *
     * @param string $nombrezona
     *
     * @return Zona
     */
    public function setNombrezona($nombrezona)
    {
        $this->nombrezona = $nombrezona;

        return $this;
    }

    /**
     * Get nombrezona
     *
     * @return string
     */
    public function getNombrezona()
    {
        return $this->nombrezona;
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


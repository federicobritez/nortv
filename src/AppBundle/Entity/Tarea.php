<?php

namespace AppBundle\Entity;

/**
 * Tarea
 */
class Tarea
{
    /**
     * @var string
     */
    private $nombretarea;

    /**
     * @var integer
     */
    private $idtarea;


    /**
     * Set nombretarea
     *
     * @param string $nombretarea
     *
     * @return Tarea
     */
    public function setNombretarea($nombretarea)
    {
        $this->nombretarea = $nombretarea;

        return $this;
    }

    /**
     * Get nombretarea
     *
     * @return string
     */
    public function getNombretarea()
    {
        return $this->nombretarea;
    }

    /**
     * Get idtarea
     *
     * @return integer
     */
    public function getIdtarea()
    {
        return $this->idtarea;
    }
}


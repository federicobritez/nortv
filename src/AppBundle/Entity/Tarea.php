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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $idtrabajo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idtrabajo = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    /**
     * Add idtrabajo
     *
     * @param \AppBundle\Entity\Trabajo $idtrabajo
     *
     * @return Tarea
     */
    public function addIdtrabajo(\AppBundle\Entity\Trabajo $idtrabajo)
    {
        $this->idtrabajo[] = $idtrabajo;

        return $this;
    }

    /**
     * Remove idtrabajo
     *
     * @param \AppBundle\Entity\Trabajo $idtrabajo
     */
    public function removeIdtrabajo(\AppBundle\Entity\Trabajo $idtrabajo)
    {
        $this->idtrabajo->removeElement($idtrabajo);
    }

    /**
     * Get idtrabajo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdtrabajo()
    {
        return $this->idtrabajo;
    }
}


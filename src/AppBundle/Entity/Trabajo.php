<?php

namespace AppBundle\Entity;

/**
 * Trabajo
 */
class Trabajo
{
    /**
     * @var string
     */
    private $estadotrabajo;

    /**
     * @var integer
     */
    private $idtrabajo;

    /**
     * @var \AppBundle\Entity\Hojaruta
     */
    private $idhojaruta;

    /**
     * @var \AppBundle\Entity\Prioridadtrabajo
     */
    private $idprioridadtrabajo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $idtarea;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idtarea = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set estadotrabajo
     *
     * @param string $estadotrabajo
     *
     * @return Trabajo
     */
    public function setEstadotrabajo($estadotrabajo)
    {
        $this->estadotrabajo = $estadotrabajo;

        return $this;
    }

    /**
     * Get estadotrabajo
     *
     * @return string
     */
    public function getEstadotrabajo()
    {
        return $this->estadotrabajo;
    }

    /**
     * Get idtrabajo
     *
     * @return integer
     */
    public function getIdtrabajo()
    {
        return $this->idtrabajo;
    }

    /**
     * Set idhojaruta
     *
     * @param \AppBundle\Entity\Hojaruta $idhojaruta
     *
     * @return Trabajo
     */
    public function setIdhojaruta(\AppBundle\Entity\Hojaruta $idhojaruta = null)
    {
        $this->idhojaruta = $idhojaruta;

        return $this;
    }

    /**
     * Get idhojaruta
     *
     * @return \AppBundle\Entity\Hojaruta
     */
    public function getIdhojaruta()
    {
        return $this->idhojaruta;
    }

    /**
     * Set idprioridadtrabajo
     *
     * @param \AppBundle\Entity\Prioridadtrabajo $idprioridadtrabajo
     *
     * @return Trabajo
     */
    public function setIdprioridadtrabajo(\AppBundle\Entity\Prioridadtrabajo $idprioridadtrabajo = null)
    {
        $this->idprioridadtrabajo = $idprioridadtrabajo;

        return $this;
    }

    /**
     * Get idprioridadtrabajo
     *
     * @return \AppBundle\Entity\Prioridadtrabajo
     */
    public function getIdprioridadtrabajo()
    {
        return $this->idprioridadtrabajo;
    }

    /**
     * Add idtarea
     *
     * @param \AppBundle\Entity\Tarea $idtarea
     *
     * @return Trabajo
     */
    public function addIdtarea(\AppBundle\Entity\Tarea $idtarea)
    {
        $this->idtarea[] = $idtarea;

        return $this;
    }

    /**
     * Remove idtarea
     *
     * @param \AppBundle\Entity\Tarea $idtarea
     */
    public function removeIdtarea(\AppBundle\Entity\Tarea $idtarea)
    {
        $this->idtarea->removeElement($idtarea);
    }

    /**
     * Get idtarea
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdtarea()
    {
        return $this->idtarea;
    }
}


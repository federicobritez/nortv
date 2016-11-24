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
    private $estado;

    /**
     * @var integer
     */
    private $idtrabajo;

    /**
     * @var \AppBundle\Entity\Tarea
     */
    private $idtarea;

    /**
     * @var \AppBundle\Entity\Hojaruta
     */
    private $idhojaruta;

    /**
     * @var \AppBundle\Entity\Prioridadtrabajo
     */
    private $idprioridadtrabajo;


    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Trabajo
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
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
     * Set idtarea
     *
     * @param \AppBundle\Entity\Tarea $idtarea
     *
     * @return Trabajo
     */
    public function setIdtarea(\AppBundle\Entity\Tarea $idtarea = null)
    {
        $this->idtarea = $idtarea;

        return $this;
    }

    /**
     * Get idtarea
     *
     * @return \AppBundle\Entity\Tarea
     */
    public function getIdtarea()
    {
        return $this->idtarea;
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
}


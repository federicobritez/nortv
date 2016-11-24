<?php

namespace AppBundle\Entity;

/**
 * Conexion
 */
class Conexion
{
    /**
     * @var string
     */
    private $direccion;

    /**
     * @var \DateTime
     */
    private $fechainstalacionreal;

    /**
     * @var string
     */
    private $coordenadas;

    /**
     * @var integer
     */
    private $esmoroso;

    /**
     * @var integer
     */
    private $idconexion;

    /**
     * @var \AppBundle\Entity\Servicio
     */
    private $idservicio;

    /**
     * @var \AppBundle\Entity\Abonado
     */
    private $idabonado;

    /**
     * @var \AppBundle\Entity\Localidad
     */
    private $idlocalidad;

    /**
     * @var \AppBundle\Entity\Estadoconexion
     */
    private $idestadoconexion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $idhojaruta;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idhojaruta = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Conexion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set fechainstalacionreal
     *
     * @param \DateTime $fechainstalacionreal
     *
     * @return Conexion
     */
    public function setFechainstalacionreal($fechainstalacionreal)
    {
        $this->fechainstalacionreal = $fechainstalacionreal;

        return $this;
    }

    /**
     * Get fechainstalacionreal
     *
     * @return \DateTime
     */
    public function getFechainstalacionreal()
    {
        return $this->fechainstalacionreal;
    }

    /**
     * Set coordenadas
     *
     * @param string $coordenadas
     *
     * @return Conexion
     */
    public function setCoordenadas($coordenadas)
    {
        $this->coordenadas = $coordenadas;

        return $this;
    }

    /**
     * Get coordenadas
     *
     * @return string
     */
    public function getCoordenadas()
    {
        return $this->coordenadas;
    }

    /**
     * Set esmoroso
     *
     * @param integer $esmoroso
     *
     * @return Conexion
     */
    public function setEsmoroso($esmoroso)
    {
        $this->esmoroso = $esmoroso;

        return $this;
    }

    /**
     * Get esmoroso
     *
     * @return integer
     */
    public function getEsmoroso()
    {
        return $this->esmoroso;
    }

    /**
     * Get idconexion
     *
     * @return integer
     */
    public function getIdconexion()
    {
        return $this->idconexion;
    }

    /**
     * Set idservicio
     *
     * @param \AppBundle\Entity\Servicio $idservicio
     *
     * @return Conexion
     */
    public function setIdservicio(\AppBundle\Entity\Servicio $idservicio = null)
    {
        $this->idservicio = $idservicio;

        return $this;
    }

    /**
     * Get idservicio
     *
     * @return \AppBundle\Entity\Servicio
     */
    public function getIdservicio()
    {
        return $this->idservicio;
    }

    /**
     * Set idabonado
     *
     * @param \AppBundle\Entity\Abonado $idabonado
     *
     * @return Conexion
     */
    public function setIdabonado(\AppBundle\Entity\Abonado $idabonado = null)
    {
        $this->idabonado = $idabonado;

        return $this;
    }

    /**
     * Get idabonado
     *
     * @return \AppBundle\Entity\Abonado
     */
    public function getIdabonado()
    {
        return $this->idabonado;
    }

    /**
     * Set idlocalidad
     *
     * @param \AppBundle\Entity\Localidad $idlocalidad
     *
     * @return Conexion
     */
    public function setIdlocalidad(\AppBundle\Entity\Localidad $idlocalidad = null)
    {
        $this->idlocalidad = $idlocalidad;

        return $this;
    }

    /**
     * Get idlocalidad
     *
     * @return \AppBundle\Entity\Localidad
     */
    public function getIdlocalidad()
    {
        return $this->idlocalidad;
    }

    /**
     * Set idestadoconexion
     *
     * @param \AppBundle\Entity\Estadoconexion $idestadoconexion
     *
     * @return Conexion
     */
    public function setIdestadoconexion(\AppBundle\Entity\Estadoconexion $idestadoconexion = null)
    {
        $this->idestadoconexion = $idestadoconexion;

        return $this;
    }

    /**
     * Get idestadoconexion
     *
     * @return \AppBundle\Entity\Estadoconexion
     */
    public function getIdestadoconexion()
    {
        return $this->idestadoconexion;
    }

    /**
     * Add idhojarutum
     *
     * @param \AppBundle\Entity\Hojaruta $idhojarutum
     *
     * @return Conexion
     */
    public function addIdhojarutum(\AppBundle\Entity\Hojaruta $idhojarutum)
    {
        $this->idhojaruta[] = $idhojarutum;

        return $this;
    }

    /**
     * Remove idhojarutum
     *
     * @param \AppBundle\Entity\Hojaruta $idhojarutum
     */
    public function removeIdhojarutum(\AppBundle\Entity\Hojaruta $idhojarutum)
    {
        $this->idhojaruta->removeElement($idhojarutum);
    }

    /**
     * Get idhojaruta
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdhojaruta()
    {
        return $this->idhojaruta;
    }
}


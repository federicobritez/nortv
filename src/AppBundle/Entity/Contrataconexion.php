<?php

namespace AppBundle\Entity;

/**
 * Contrataconexion
 */
class Contrataconexion
{
    /**
     * @var \DateTime
     */
    private $fechainstalacion1;

    /**
     * @var \DateTime
     */
    private $fechainstalacion2;

    /**
     * @var \AppBundle\Entity\Viacomunicacion
     */
    private $idviacomunicacion;

    /**
     * @var \AppBundle\Entity\Conexion
     */
    private $idconexion;

    /**
     * @var \AppBundle\Entity\Abonado
     */
    private $idabonado;


    /**
     * Set fechainstalacion1
     *
     * @param \DateTime $fechainstalacion1
     *
     * @return Contrataconexion
     */
    public function setFechainstalacion1($fechainstalacion1)
    {
        $this->fechainstalacion1 = $fechainstalacion1;

        return $this;
    }

    /**
     * Get fechainstalacion1
     *
     * @return \DateTime
     */
    public function getFechainstalacion1()
    {
        return $this->fechainstalacion1;
    }

    /**
     * Set fechainstalacion2
     *
     * @param \DateTime $fechainstalacion2
     *
     * @return Contrataconexion
     */
    public function setFechainstalacion2($fechainstalacion2)
    {
        $this->fechainstalacion2 = $fechainstalacion2;

        return $this;
    }

    /**
     * Get fechainstalacion2
     *
     * @return \DateTime
     */
    public function getFechainstalacion2()
    {
        return $this->fechainstalacion2;
    }

    /**
     * Set idviacomunicacion
     *
     * @param \AppBundle\Entity\Viacomunicacion $idviacomunicacion
     *
     * @return Contrataconexion
     */
    public function setIdviacomunicacion(\AppBundle\Entity\Viacomunicacion $idviacomunicacion)
    {
        $this->idviacomunicacion = $idviacomunicacion;

        return $this;
    }

    /**
     * Get idviacomunicacion
     *
     * @return \AppBundle\Entity\Viacomunicacion
     */
    public function getIdviacomunicacion()
    {
        return $this->idviacomunicacion;
    }

    /**
     * Set idconexion
     *
     * @param \AppBundle\Entity\Conexion $idconexion
     *
     * @return Contrataconexion
     */
    public function setIdconexion(\AppBundle\Entity\Conexion $idconexion)
    {
        $this->idconexion = $idconexion;

        return $this;
    }

    /**
     * Get idconexion
     *
     * @return \AppBundle\Entity\Conexion
     */
    public function getIdconexion()
    {
        return $this->idconexion;
    }

    /**
     * Set idabonado
     *
     * @param \AppBundle\Entity\Abonado $idabonado
     *
     * @return Contrataconexion
     */
    public function setIdabonado(\AppBundle\Entity\Abonado $idabonado)
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
}


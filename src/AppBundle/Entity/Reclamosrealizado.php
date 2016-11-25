<?php

namespace AppBundle\Entity;

/**
 * Reclamosrealizado
 */
class Reclamosrealizado
{
    /**
     * @var \DateTime
     */
    private $fechareclamo;

    /**
     * @var \AppBundle\Entity\Reclamo
     */
    private $idreclamo;

    /**
     * @var \AppBundle\Entity\Conexion
     */
    private $idconexion;

    /**
     * @var \AppBundle\Entity\Abonado
     */
    private $idabonado;

    /**
     * @var \AppBundle\Entity\Viacomunicacion
     */
    private $idviacomunicacion;


    /**
     * Set fechareclamo
     *
     * @param \DateTime $fechareclamo
     *
     * @return Reclamosrealizado
     */
    public function setFechareclamo($fechareclamo)
    {
        $this->fechareclamo = $fechareclamo;

        return $this;
    }

    /**
     * Get fechareclamo
     *
     * @return \DateTime
     */
    public function getFechareclamo()
    {
        return $this->fechareclamo;
    }

    /**
     * Set idreclamo
     *
     * @param \AppBundle\Entity\Reclamo $idreclamo
     *
     * @return Reclamosrealizado
     */
    public function setIdreclamo(\AppBundle\Entity\Reclamo $idreclamo)
    {
        $this->idreclamo = $idreclamo;

        return $this;
    }

    /**
     * Get idreclamo
     *
     * @return \AppBundle\Entity\Reclamo
     */
    public function getIdreclamo()
    {
        return $this->idreclamo;
    }

    /**
     * Set idconexion
     *
     * @param \AppBundle\Entity\Conexion $idconexion
     *
     * @return Reclamosrealizado
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
     * @return Reclamosrealizado
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

    /**
     * Set idviacomunicacion
     *
     * @param \AppBundle\Entity\Viacomunicacion $idviacomunicacion
     *
     * @return Reclamosrealizado
     */
    public function setIdviacomunicacion(\AppBundle\Entity\Viacomunicacion $idviacomunicacion = null)
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
}


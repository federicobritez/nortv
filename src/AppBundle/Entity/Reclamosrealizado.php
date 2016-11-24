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
     * @var integer
     */
    private $idreclamosrealizado;

    /**
     * @var \AppBundle\Entity\Reclamo
     */
    private $idreclamo;

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
     * Get idreclamosrealizado
     *
     * @return integer
     */
    public function getIdreclamosrealizado()
    {
        return $this->idreclamosrealizado;
    }

    /**
     * Set idreclamo
     *
     * @param \AppBundle\Entity\Reclamo $idreclamo
     *
     * @return Reclamosrealizado
     */
    public function setIdreclamo(\AppBundle\Entity\Reclamo $idreclamo = null)
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

    /**
     * Set idconexion
     *
     * @param \AppBundle\Entity\Conexion $idconexion
     *
     * @return Reclamosrealizado
     */
    public function setIdconexion(\AppBundle\Entity\Conexion $idconexion = null)
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
}


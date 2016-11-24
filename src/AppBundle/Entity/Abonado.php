<?php

namespace AppBundle\Entity;

/**
 * Abonado
 */
class Abonado
{
    /**
     * @var integer
     */
    private $dni;

    /**
     * @var string
     */
    private $apellidonombre;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $telefono;

    /**
     * @var string
     */
    private $celular;

    /**
     * @var string
     */
    private $email;

    /**
     * @var integer
     */
    private $idabonado;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $idevento;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idevento = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set dni
     *
     * @param integer $dni
     *
     * @return Abonado
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return integer
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set apellidonombre
     *
     * @param string $apellidonombre
     *
     * @return Abonado
     */
    public function setApellidonombre($apellidonombre)
    {
        $this->apellidonombre = $apellidonombre;

        return $this;
    }

    /**
     * Get apellidonombre
     *
     * @return string
     */
    public function getApellidonombre()
    {
        return $this->apellidonombre;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Abonado
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
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Abonado
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set celular
     *
     * @param string $celular
     *
     * @return Abonado
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Abonado
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get idabonado
     *
     * @return integer
     */
    public function getIdabonado()
    {
        return $this->idabonado;
    }

    /**
     * Add idevento
     *
     * @param \AppBundle\Entity\Eventoypeliculas $idevento
     *
     * @return Abonado
     */
    public function addIdevento(\AppBundle\Entity\Eventoypeliculas $idevento)
    {
        $this->idevento[] = $idevento;

        return $this;
    }

    /**
     * Remove idevento
     *
     * @param \AppBundle\Entity\Eventoypeliculas $idevento
     */
    public function removeIdevento(\AppBundle\Entity\Eventoypeliculas $idevento)
    {
        $this->idevento->removeElement($idevento);
    }

    /**
     * Get idevento
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdevento()
    {
        return $this->idevento;
    }
}


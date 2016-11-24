<?php

namespace AppBundle\Entity;

/**
 * Insumo
 */
class Insumo
{
    /**
     * @var string
     */
    private $nombreinsumo;

    /**
     * @var string
     */
    private $unidadesmedida;

    /**
     * @var integer
     */
    private $idinsumo;


    /**
     * Set nombreinsumo
     *
     * @param string $nombreinsumo
     *
     * @return Insumo
     */
    public function setNombreinsumo($nombreinsumo)
    {
        $this->nombreinsumo = $nombreinsumo;

        return $this;
    }

    /**
     * Get nombreinsumo
     *
     * @return string
     */
    public function getNombreinsumo()
    {
        return $this->nombreinsumo;
    }

    /**
     * Set unidadesmedida
     *
     * @param string $unidadesmedida
     *
     * @return Insumo
     */
    public function setUnidadesmedida($unidadesmedida)
    {
        $this->unidadesmedida = $unidadesmedida;

        return $this;
    }

    /**
     * Get unidadesmedida
     *
     * @return string
     */
    public function getUnidadesmedida()
    {
        return $this->unidadesmedida;
    }

    /**
     * Get idinsumo
     *
     * @return integer
     */
    public function getIdinsumo()
    {
        return $this->idinsumo;
    }
}


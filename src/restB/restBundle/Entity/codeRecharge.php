<?php

namespace restB\restBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * codeRecharge
 *
 * @ORM\Table(name="code_recharge")
 * @ORM\Entity(repositoryClass="restB\restBundle\Repository\codeRechargeRepository")
 *
 */


class codeRecharge
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="appRouterToken", type="string")
     */
    private $appRoutertoken;

    /**
     * @var int
     *
     * @ORM\Column(name="montant", type="integer")
     */
    private $montant;
    /**
     * @var int
     *
     * @ORM\Column(name="code", type="string")
     */
    private $code;
    /**
     * @var string
     *
     * @ORM\Column(name="destinataire", type="string")
     */
    private $destinataire;

    /**
     * @var string
     *
     * @ORM\Column(name="isUsed", type="boolean")
     */
    private $isUsed;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set appRoutertoken
     *
     * @param string $appRoutertoken
     *
     * @return codeRecharge
     */
    public function setAppRoutertoken($appRoutertoken)
    {
        $this->appRoutertoken = $appRoutertoken;

        return $this;
    }

    /**
     * Get appRoutertoken
     *
     * @return string
     */
    public function getAppRoutertoken()
    {
        return $this->appRoutertoken;
    }

    /**
     * Set montant
     *
     * @param integer $montant
     *
     * @return codeRecharge
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return integer
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return codeRecharge
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set destinataire
     *
     * @param string $destinataire
     *
     * @return codeRecharge
     */
    public function setDestinataire($destinataire)
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    /**
     * Get destinataire
     *
     * @return string
     */
    public function getDestinataire()
    {
        return $this->destinataire;
    }

    /**
     * Set isUsed
     *
     * @param boolean $isUsed
     *
     * @return codeRecharge
     */
    public function setIsUsed($isUsed)
    {
        $this->isUsed = $isUsed;

        return $this;
    }

    /**
     * Get isUsed
     *
     * @return boolean
     */
    public function getIsUsed()
    {
        return $this->isUsed;
    }
}

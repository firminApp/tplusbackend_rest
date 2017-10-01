<?php

namespace restB\restBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * verifCode
 *
 * @ORM\Table(name="verif_code")
 * @ORM\Entity(repositoryClass="restB\restBundle\Repository\verifCodeRepository")
 *
 */


class verifCode
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
     * @ORM\Column(name="tel", type="string")
     */
    private $tel;

    /**
     * @var int
     *
     * @ORM\Column(name="code", type="integer")
     */
    private $code;

function  __construct()
{
    $this->code=$this->generateCode(6);
}

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
     * Set tel
     *
     * @param string $tel
     *
     * @return verifCode
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set code
     *
     * @param integer $code
     *
     * @return verifCode
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }
    function generateCode($length = 6) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

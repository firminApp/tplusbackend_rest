<?php

namespace restB\restBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * userPocket
 *
 * @ORM\Table(name="user_pocket")
 * @ORM\Entity(repositoryClass="restB\restBundle\Repository\userPocketRepository")
 */
class userPocket
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
     * @var int
     *
     * @ORM\Column(name="solde", type="integer")
     */
    private $solde;


    /**
     * @var string
     *
     * @ORM\Column(name="transactionPhone", type="string", length=255,unique=true)
     */
    private $transactionPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="accountNumber", type="string", length=255)
     */
    private $accountNumber;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isOneline", type="boolean")
     */
    private $isOneline;
    /**
     * @var string
     *
     * @ORM\Column(name="pass", type="string", length=255)
     */
    private $pass;
    /**
     * @var string
     *
     * @ORM\Column(name="fbtoken", type="string", length=255)
     */
    private $fbtoken;
      /**
     * @var string
     *
     *@ORM\ManyToOne(targetEntity="user",cascade={"all"}, fetch="EAGER")
     */
    private $user;
   




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
     * Set solde
     *
     * @param integer $solde
     *
     * @return userPocket
     */
    public function setSolde($solde)
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * Get solde
     *
     * @return integer
     */
    public function getSolde()
    {
        return $this->solde;
    }

    /**
     * Set transactionPhone
     *
     * @param string $transactionPhone
     *
     * @return userPocket
     */
    public function setTransactionPhone($transactionPhone)
    {
        $this->transactionPhone = $transactionPhone;

        return $this;
    }

    /**
     * Get transactionPhone
     *
     * @return string
     */
    public function getTransactionPhone()
    {
        return $this->transactionPhone;
    }

    /**
     * Set accountNumber
     *
     * @param string $accountNumber
     *
     * @return userPocket
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    /**
     * Get accountNumber
     *
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * Set isOneline
     *
     * @param boolean $isOneline
     *
     * @return userPocket
     */
    public function setIsOneline($isOneline)
    {
        $this->isOneline = $isOneline;

        return $this;
    }

    /**
     * Get isOneline
     *
     * @return boolean
     */
    public function getIsOneline()
    {
        return $this->isOneline;
    }

    /**
     * Set pass
     *
     * @param string $pass
     *
     * @return userPocket
     */
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get pass
     *
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set fbtoken
     *
     * @param string $fbtoken
     *
     * @return userPocket
     */
    public function setFbtoken($fbtoken)
    {
        $this->fbtoken = $fbtoken;

        return $this;
    }

    /**
     * Get fbtoken
     *
     * @return string
     */
    public function getFbtoken()
    {
        return $this->fbtoken;
    }

    /**
     * Set user
     *
     * @param \restB\restBundle\Entity\user $user
     *
     * @return userPocket
     */
    public function setUser(\restB\restBundle\Entity\user $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \restB\restBundle\Entity\user
     */
    public function getUser()
    {
        return $this->user;
    }
}

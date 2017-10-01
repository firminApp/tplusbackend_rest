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
     * @ORM\Column(name="transactionPhone", type="string", length=255)
     */
    private $transactionPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="accountNumber", type="string", length=255)
     */
    private $accountNumber;
      /**
     * @var string
     *
     *@ORM\ManyToOne(targetEntity="user")
     */
    private $user;
   

    /**
     * Get id
     *
     * @return int
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
     * @return int
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
    public   function  updateSolde($montant){
        $newSolde=$this->solde+$montant;
        $this->setSolde($newSolde);
        return $newSolde ;
    }
}

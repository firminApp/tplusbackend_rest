<?php

namespace restB\restBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * user
 *
 * @ORM\Table(name="smsFromMaxi")
 * @ORM\Entity(repositoryClass="restB\restBundle\Repository\userRepository")
 */
class smsFromMaxiSms
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
     * @ORM\Column(name="from", type="string", length=255, nullable=true)
     */
    private $from;

    /**
     * @var string
     *
     * @ORM\Column(name="to", type="string", length=255, nullable=true)
     */
    private $to;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="body", type="string", length=255, nullable=true)
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="userTel", type="string", length=255, nullable=true)
     */
    private $userTel;
    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255, nullable=true)
     */
    private $statut;
    /**
     * @var string
     *
     * @ORM\Column(name="datesend", type="string", length=255, nullable=true)
     */
    private $datesend;




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
     * Set from
     *
     * @param string $from
     *
     * @return smsFromMaxiSms
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set to
     *
     * @param string $to
     *
     * @return smsFromMaxiSms
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to
     *
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return smsFromMaxiSms
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
     * Set body
     *
     * @param string $body
     *
     * @return smsFromMaxiSms
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set userTel
     *
     * @param string $userTel
     *
     * @return smsFromMaxiSms
     */
    public function setUserTel($userTel)
    {
        $this->userTel = $userTel;

        return $this;
    }

    /**
     * Get userTel
     *
     * @return string
     */
    public function getUserTel()
    {
        return $this->userTel;
    }

    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return smsFromMaxiSms
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set datesend
     *
     * @param string $datesend
     *
     * @return smsFromMaxiSms
     */
    public function setDatesend($datesend)
    {
        $this->datesend = $datesend;

        return $this;
    }

    /**
     * Get datesend
     *
     * @return string
     */
    public function getDatesend()
    {
        return $this->datesend;
    }
}

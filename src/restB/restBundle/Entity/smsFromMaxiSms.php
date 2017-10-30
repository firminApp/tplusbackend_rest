<?php

namespace restB\restBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 *
 * @ORM\Table(name="smsFromMaxiSms")
 * @ORM\Entity(repositoryClass="restB\restBundle\Repository\smsFromMaxiSmsRepository")
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
     * @ORM\Column(name="msg_from", type="string", length=255, nullable=true)
     */
    private $from;

    /**
     * @var string
     *
     * @ORM\Column(name="msg_to", type="string", length=255, nullable=true)
     */
    private $to;


    /**
     * @var string
     *
     * @ORM\Column(name="msg_body", type="string", length=255, nullable=true)
     */
    private $body;



    /**
     * @var string
     *
     * @ORM\Column(name="sender", type="string", length=255, nullable=true)
     */
    private $pocketsender;
    /**
     * @var string
     *
     * @ORM\Column(name="couttotal", type="integer", length=255, nullable=true)
     */
    private $couttotal;
    /**
     * @var string
     *
     * @ORM\Column(name="datesend", type="string", length=255, nullable=true)
     */
    private $datesend;
    /**
     * @var string
     *
     * @ORM\Column(name="sendresponse", type="string", length=255, nullable=true)
     */
    private $sendresponse;



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
     * Set pocketsender
     *
     * @param string $pocketsender
     *
     * @return smsFromMaxiSms
     */
    public function setPocketsender($pocketsender)
    {
        $this->pocketsender = $pocketsender;

        return $this;
    }

    /**
     * Get pocketsender
     *
     * @return string
     */
    public function getPocketsender()
    {
        return $this->pocketsender;
    }

    /**
     * Set couttotal
     *
     * @param integer $couttotal
     *
     * @return smsFromMaxiSms
     */
    public function setCouttotal($couttotal)
    {
        $this->couttotal = $couttotal;

        return $this;
    }

    /**
     * Get couttotal
     *
     * @return integer
     */
    public function getCouttotal()
    {
        return $this->couttotal;
    }




    public function __toString()
    {
        return 'sms:{ body:'.$this->body.' sender:'.$this->pocketsender.'date: '.$this->datesend; // if you have a name property you can do $this->getName();
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

    /**
     * Set sendresponse
     *
     * @param string $sendresponse
     *
     * @return smsFromMaxiSms
     */
    public function setSendresponse($sendresponse)
    {
        $this->sendresponse = $sendresponse;

        return $this;
    }

    /**
     * Get sendresponse
     *
     * @return string
     */
    public function getSendresponse()
    {
        return $this->sendresponse;
    }
}

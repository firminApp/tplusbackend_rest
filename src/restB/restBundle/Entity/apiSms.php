<?php

namespace restB\restBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * user
 *
 * @ORM\Table(name="apiSms")
 * @ORM\Entity(repositoryClass="restB\restBundle\Repository\userRepository")
 */
class apiSms
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
     * @ORM\Column(name="mame", type="string", length=255, nullable=true)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;



    /**
     * @var string
     *
     * @ORM\Column(name="params", type="object",  nullable=true, unique=false)
     */

    private $params;
    /**
     * @var string
     *
     * @ORM\Column(name="config", type="object",  nullable=true, unique=false)
     */
//les configurations suivant les services fournie par l'api: exemple: envoi sms{paramettres necessaires}
    private $config;

    /**
     * @var string
     *
     * @ORM\Column(name="inUsing", type="boolean",  nullable=false, unique=false)
     */
//les configurations suivant les services fournie par l'api: exemple: envoi sms{paramettres necessaires}
    private $inUsing;



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
     * Set name
     *
     * @param string $name
     *
     * @return apiSms
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return apiSms
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set params
     *
     * @param \stdClass $params
     *
     * @return apiSms
     */
    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Get params
     *
     * @return \stdClass
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set config
     *
     * @param \stdClass $config
     *
     * @return apiSms
     */
    public function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Get config
     *
     * @return \stdClass
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set inUsing
     *
     * @param boolean $inUsing
     *
     * @return apiSms
     */
    public function setInUsing($inUsing)
    {
        $this->inUsing = $inUsing;

        return $this;
    }

    /**
     * Get inUsing
     *
     * @return boolean
     */
    public function getInUsing()
    {
        return $this->inUsing;
    }
}

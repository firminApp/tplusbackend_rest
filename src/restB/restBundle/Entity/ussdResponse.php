<?php

namespace restB\restBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ussdResponse
 *
 * @ORM\Table(name="ussd_response")
 * @ORM\Entity(repositoryClass="restB\restBundle\Repository\ussdResponseRepository")
 */
class ussdResponse
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
     * @ORM\Column(name="response", type="string", length=255)
     */
    private $response;

    /**
     * @ORM\OneToOne(targetEntity="restB\restBundle\Entity\appRouter", cascade={"persist"})
     */
    private $appRouter;


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
     * Set response
     *
     * @param string $response
     *
     * @return ussdResponse
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get response
     *
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set appRouter
     *
     * @param \restB\restBundle\Entity\appRouter $appRouter
     *
     * @return ussdResponse
     */
    public function setAppRouter(\restB\restBundle\Entity\appRouter $appRouter = null)
    {
        $this->appRouter = $appRouter;

        return $this;
    }

    /**
     * Get appRouter
     *
     * @return \restB\restBundle\Entity\appRouter
     */
    public function getAppRouter()
    {
        return $this->appRouter;
    }
}

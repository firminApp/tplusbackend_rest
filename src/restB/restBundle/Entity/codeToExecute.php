<?php

namespace restB\restBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * codeToExecute
 *
 * @ORM\Table(name="code_to_execute")
 * @ORM\Entity(repositoryClass="restB\restBundle\Repository\codeToExecuteRepository")
 */
class codeToExecute
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
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @ORM\OneToOne(targetEntity="restB\restBundle\Entity\gsmOperator", cascade={"persist"})
     */
    private $appRouter;

    /**
     * @ORM\OneToMany(targetEntity="restB\restBundle\Entity\ussdArg",mappedBy="ussdArg", cascade={"persist"})
     */
    private $ussdArg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="initDate", type="datetime")
     */
    private $initDate;


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
     * Set code
     *
     * @param string $code
     *
     * @return codeToExecute
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
     * Set initDate
     *
     * @param \DateTime $initDate
     *
     * @return codeToExecute
     */
    public function setInitDate($initDate)
    {
        $this->initDate = $initDate;

        return $this;
    }

    /**
     * Get initDate
     *
     * @return \DateTime
     */
    public function getInitDate()
    {
        return $this->initDate;
    }

    /**
     * Set appRouter
     *
     * @param \restB\restBundle\Entity\gsmOperator $appRouter
     *
     * @return codeToExecute
     */
    public function setAppRouter(\restB\restBundle\Entity\gsmOperator $appRouter = null)
    {
        $this->appRouter = $appRouter;

        return $this;
    }

    /**
     * Get appRouter
     *
     * @return \restB\restBundle\Entity\gsmOperator
     */
    public function getAppRouter()
    {
        return $this->appRouter;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ussdArg = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ussdArg
     *
     * @param \restB\restBundle\Entity\ussdArg $ussdArg
     *
     * @return codeToExecute
     */
    public function addUssdArg(\restB\restBundle\Entity\ussdArg $ussdArg)
    {
        $this->ussdArg[] = $ussdArg;

        return $this;
    }

    /**
     * Remove ussdArg
     *
     * @param \restB\restBundle\Entity\ussdArg $ussdArg
     */
    public function removeUssdArg(\restB\restBundle\Entity\ussdArg $ussdArg)
    {
        $this->ussdArg->removeElement($ussdArg);
    }

    /**
     * Get ussdArg
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUssdArg()
    {
        return $this->ussdArg;
    }
}

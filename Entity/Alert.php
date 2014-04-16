<?php

namespace FM\ConanAlertBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FM\ConanAlertBundle\Entity\Alert
 *
 * @ORM\Entity(repositoryClass="FM\ConanAlertBundle\Entity\AlertRepository")
 * @ORM\Table
 */
class Alert
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Short identifier for the type of alert
     *
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * Optional extra context for the alert
     *
     * @var array
     *
     * @ORM\Column(type="json_array", nullable=true)
     */
    protected $context;

    /**
     * Optional extra information about this alert
     *
     * @var array
     *
     * @ORM\Column(type="json_array", nullable=true)
     */
    protected $data;

    /**
     * The alert level
     *
     * @var string a value from Psr\Log\LogLevel
     *
     * @ORM\Column(type="string", length=16)
     */
    protected $level;

    /**
     * The alert message
     *
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $message;

    /**
     * Flag indicating whether this alert has been muted
     *
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $muted;

    /**
     * Checksum consisting of the name and context. Can be used to
     * see if two alerts are the same, without having to do complex matching.
     *
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     */
    protected $checksum;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $count;

    /**
     * The date on which this alert was first issued
     *
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $datetimeFirstIssued;

    /**
     * The date on which this alert was last issued
     *
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $datetimeLastIssued;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->muted = false;
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
     * Set name
     *
     * @param string $name
     *
     * @return Alert
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
     * Set context
     *
     * @param array $context
     *
     * @return Alert
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return array
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set data
     *
     * @param array $data
     *
     * @return Alert
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return Alert
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Alert
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set muted
     *
     * @param boolean $muted
     *
     * @return Alert
     */
    public function setMuted($muted)
    {
        $this->muted = $muted;

        return $this;
    }

    /**
     * Is muted
     *
     * @return boolean
     */
    public function isMuted()
    {
        return $this->muted;
    }

    /**
     * Set checksum
     *
     * @param string $checksum
     *
     * @return Alert
     */
    public function setChecksum($checksum)
    {
        $this->checksum = $checksum;

        return $this;
    }

    /**
     * Get checksum
     *
     * @return string
     */
    public function getChecksum()
    {
        return $this->checksum;
    }

    /**
     * Set datetimeFirstIssued
     *
     * @param \DateTime $datetimeFirstIssued
     *
     * @return Alert
     */
    public function setDatetimeFirstIssued($datetimeFirstIssued)
    {
        $this->datetimeFirstIssued = $datetimeFirstIssued;

        return $this;
    }

    /**
     * Get datetimeFirstIssued
     *
     * @return \DateTime
     */
    public function getDatetimeFirstIssued()
    {
        return $this->datetimeFirstIssued;
    }

    /**
     * Set datetimeLastIssued
     *
     * @param \DateTime $datetimeLastIssued
     *
     * @return Alert
     */
    public function setDatetimeLastIssued($datetimeLastIssued)
    {
        $this->datetimeLastIssued = $datetimeLastIssued;

        return $this;
    }

    /**
     * Get datetimeLastIssued
     *
     * @return \DateTime
     */
    public function getDatetimeLastIssued()
    {
        return $this->datetimeLastIssued;
    }

    /**
     * Set count
     *
     * @param  integer $count
     * @return Alert
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Increment count
     *
     * @param  integer $step
     * @return Alert
     */
    public function incrementCount($step = 1)
    {
        $this->count += $step;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }
}

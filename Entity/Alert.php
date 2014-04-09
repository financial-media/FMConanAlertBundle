<?php

namespace FM\ConanAlertBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="FM\ConanAlertBundle\Entity\AlertRepository")
 * @ORM\Table(indexes={
 *   @ORM\Index(columns={"checksum"})
 * })
 */
class Alert
{
    /**
     * Detailed debug information
     */
    const DEBUG = 100;

    /**
     * Interesting events
     *
     * Examples: User logs in, SQL logs.
     */
    const INFO = 200;

    /**
     * Uncommon events
     */
    const NOTICE = 250;

    /**
     * Exceptional occurrences that are not errors
     *
     * Examples: Use of deprecated APIs, poor use of an API,
     * undesirable things that are not necessarily wrong.
     */
    const WARNING = 300;

    /**
     * Runtime errors
     */
    const ERROR = 400;

    /**
     * Critical conditions
     *
     * Example: Application component unavailable, unexpected exception.
     */
    const CRITICAL = 500;

    /**
     * Action must be taken immediately
     *
     * Example: Entire website down, database unavailable, etc.
     * This should trigger the SMS alerts and wake you up.
     */
    const ALERT = 550;

    /**
     * Urgent alert.
     */
    const EMERGENCY = 600;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Checksum consisting of the level, message and context. Can be used to
     * see if two alerts are the same, without having to do complex matching.
     *
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     */
    protected $checksum;

    /**
     * The alert level
     *
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $level;

    /**
     * Flag indicating whether this alert has been muted (i.e. removed from listings)
     *
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $muted;

    /**
     * The name. This is a short string indicating the type of alert
     * (eg: "import fail", "cleanup halt"). We use this to calculate the
     * checksum rather than the message, since the latter can vary a bit between
     * two alerts.
     *
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * The alert message
     *
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $message;

    /**
     * Optional extra context for the alert
     *
     * @var array
     *
     * @ORM\Column(type="json_array", nullable=true)
     */
    protected $context;

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
     * Set checksum
     *
     * @param  string $checksum
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
     * Set level
     *
     * @param  integer $level
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
     * Set muted
     *
     * @param  bool  $muted
     * @return Alert
     */
    public function setMuted($muted)
    {
        $this->muted = $muted;

        return $this;
    }

    /**
     * Get muted
     *
     * @return bool
     */
    public function getMuted()
    {
        return $this->muted;
    }

    /**
     * Set name
     *
     * @param  string $name
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
     * Set message
     *
     * @param  string $message
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
     * Set context
     *
     * @param  array $context
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
     * Set datetimeFirstIssued
     *
     * @param  \DateTime $datetimeFirstIssued
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
     * @param  \DateTime $datetimeLastIssued
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
     * @param integer $count
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
     * @param integer $step
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

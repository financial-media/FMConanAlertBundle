<?php

namespace FM\ConanAlertBundle\Event;

class RaiseAlertEvent extends AlertEvent
{
    /**
     * @var integer
     */
    protected $level;

    /**
     * @var string
     */
    protected $message;

    /**
     * @param string  $name
     * @param integer $level
     * @param string  $message
     * @param array   $context
     */
    public function __construct($name, $level, $message, array $context = null)
    {
        parent::__construct($name, $context);

        $this->level   = $level;
        $this->message = $message;
    }

    /**
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return array
     */
    public function getMessage()
    {
        return $this->message;
    }
}

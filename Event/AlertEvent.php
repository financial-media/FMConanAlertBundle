<?php

namespace FM\ConanAlertBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class AlertEvent extends Event
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $context;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @param string $name
     * @param array  $context
     */
    public function __construct($name, array $context = null)
    {
        $this->name    = $name;
        $this->context = $context;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param array $params
     */
    public function setMessageParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * @return array
     */
    public function getMessageParams()
    {
        return $this->params;
    }
}

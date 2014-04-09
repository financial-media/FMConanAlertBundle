<?php

namespace FM\ConanAlertBundle\EventListener;

use FM\ConanAlertBundle\Alert\AlertService;
use FM\ConanAlertBundle\Event\LiftAlertEvent;
use FM\ConanAlertBundle\Event\RaiseAlertEvent;

class AlertListener
{
    /**
     * @var AlertService
     */
    protected $alertService;

    /**
     * @param AlertService $alertService
     */
    public function __construct(AlertService $alertService)
    {
        $this->alertService = $alertService;
    }

    public function onRaiseAlert(RaiseAlertEvent $event)
    {
        $this->alertService->raise(
            $event->getName(),
            $event->getLevel(),
            $event->getMessage(),
            $event->getMessageParams(),
            $event->getContext()
        );
    }

    public function onLiftAlert(LiftAlertEvent $event)
    {
        $this->alertService->lift(
            $event->getName(),
            $event->getContext()
        );
    }
}

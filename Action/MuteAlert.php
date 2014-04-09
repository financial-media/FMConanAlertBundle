<?php

namespace FM\ConanAlertBundle\Action;

use FM\ConanAlertBundle\Entity\Alert;
use FM\ConanBundle\Action\EntityAction;

class MuteAlert extends EntityAction
{
    protected function handleEntity($entity)
    {
        $this->mute($entity);
    }

    /**
     * @return string
     */
    protected function getFlashMessageId()
    {
        return 'flash.alert_muted';
    }

    protected function mute(Alert $alert)
    {
        $name = $alert->getName();
        $context = $alert->getContext();

        return $this->getConfig()->get('fm_conan_alert.alert_service')->mute($name, $context);
    }
}

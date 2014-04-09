<?php

namespace FM\ConanAlertBundle\Action;

use FM\ConanAlertBundle\Entity\Alert;
use FM\ConanBundle\Action\ViewAction;

class ViewAlert extends ViewAction
{
    public function getTitle()
    {
        /** @var Alert $alert */
        $alert = $this->getEntity();

        return $this->getText('alert.view.title', ['%alert%' => $alert->getName()]);
    }

    public function getViewData()
    {
        /** @var Alert $alert */
        $alert = $this->getEntity();

        $data = parent::getViewData();

        $actions = array();

        return array_merge($data, array(
            'alert' => $this->getEntity(),
        ));
    }
}

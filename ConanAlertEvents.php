<?php

namespace FM\ConanAlertBundle;

final class ConanAlertEvents
{
    /**
     * When an alert is raised, gives an AlertEvent
     */
    const RAISE_ALERT = 'fm_conan_alert.alert.raise';

    /**
     * When an alert is lifted, gives an AlertEvent
     */
    const LIFT_ALERT = 'fm_conan_alert.alert.lift';
}

<?php

namespace FM\ConanAlertBundle\Tests;

use FM\ConanAlertBundle\Alert\AlertService;

class AlertServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $doctrine = $this->getMockBuilder('Symfony\Bridge\Doctrine\RegistryInterface')
            ->getMockForAbstractClass();
        $translator = $this->getMockBuilder('Symfony\Component\Translation\TranslatorInterface')
            ->getMockForAbstractClass();

        $alertService = new AlertService($doctrine, $translator, 'cms', 'nl');

        $this->assertInstanceOf('FM\ConanAlertBundle\Alert\AlertService', $alertService);
    }
}

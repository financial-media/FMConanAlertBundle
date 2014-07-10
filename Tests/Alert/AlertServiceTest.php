<?php

namespace FM\ConanAlertBundle\Tests;

use FM\ConanAlertBundle\Alert\AlertService;

class AlertServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AlertService
     */
    protected $alertService;

    protected function setUp()
    {
        parent::setUp();

        $doctrine = $this->getMockBuilder('Symfony\Bridge\Doctrine\RegistryInterface')
            ->getMockForAbstractClass();
        $translator = $this->getMockBuilder('Symfony\Component\Translation\TranslatorInterface')
            ->getMockForAbstractClass();

        $this->alertService = new AlertService($doctrine, $translator, 'cms', 'nl');
    }

    protected function getMethod($name)
    {
        $class = new \ReflectionClass('FM\ConanAlertBundle\Alert\AlertService');
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }

    public function testConstructor()
    {
        $this->assertInstanceOf('FM\ConanAlertBundle\Alert\AlertService', $this->alertService);
    }

    public function testAlertCreate()
    {
        $create = $this->getMethod('create');

        $alert = $create->invokeArgs($this->alertService, array('name', 1, 'hello', array(1,2), array('hello','io'), new \DateTime('01-01-1900'), false));

        $this->assertEquals('name', $alert->getName());
        $this->assertEquals('hello', $alert->getMessage());
        $this->assertEquals(1, $alert->getLevel());
        $this->assertEquals(new \DateTime('01-01-1900'), $alert->getDatetimeFirstIssued());
        $this->assertEquals(false, $alert->isMuted());
    }
}

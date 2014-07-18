<?php

namespace FM\ConanAlertBundle\Tests;

use Doctrine\ORM\Tools\SchemaTool;
use FM\ConanAlertBundle\Alert\AlertService;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AlertServiceTest extends WebTestCase
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

    public function testCalculateChecksumShouldBeSimilarAfterPersist()
    {
        $this->createClient();
        $kernel = static::$kernel;

        /** @var ManagerRegistry $doctrine */
        $doctrine = $kernel->getContainer()->get('doctrine');

        $metadatas = $doctrine->getManager()->getMetadataFactory()->getAllMetadata();

        $schemaTool = new SchemaTool($doctrine->getManager());
        $schemaTool->dropDatabase();
        $schemaTool->createSchema($metadatas);

        $translator = $this->getMockBuilder('Symfony\Component\Translation\TranslatorInterface')->getMock();
        $translator->expects($this->any())
            ->method('trans')
            ->willReturnArgument(0);

        $alertService = new AlertService($doctrine, $translator);

        $name = 'an_alert';
        $context = [
            '%input%' => [
                'title' => 'Verpakkingsbedrijf voedingsmiddelen Wallonië',
                'city_id' => 962,
                'postal_code' => null,
                'hostname' => null,
            ],
            '%score' => 1/3,
        ];

        $checksum1 = $alertService->calculateChecksum($name, $context);

        $alertService->raise('an_alert', 200, 'Message', [], $context);

        $doctrine->getManager()->clear();

        $alert = $doctrine->getManager()->getRepository('FMConanAlertBundle:Alert')->find(1);

        $checksum2 = $alertService->calculateChecksum($alert->getName(), $alert->getContext());

        $this->assertEquals($checksum1, $checksum2);
    }
}

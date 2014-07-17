<?php

namespace FM\ConanAlertBundle\Alert;

use Doctrine\Common\Persistence\ObjectManager;
use FM\ConanAlertBundle\Entity\Alert;
use FM\ConanAlertBundle\Entity\AlertRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Translation\TranslatorInterface;

class AlertService
{
    /**
     * @var RegistryInterface
     */
    protected $doctrine;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var null|string
     */
    protected $translationDomain;

    /**
     * @var null|string
     */
    protected $translationLocale;

    /**
     * @param RegistryInterface   $doctrine
     * @param TranslatorInterface $translator
     * @param string              $translationDomain
     * @param string              $translationLocale
     */
    public function __construct(RegistryInterface $doctrine, TranslatorInterface $translator, $translationDomain = null, $translationLocale = null)
    {
        $this->doctrine = $doctrine;
        $this->translator = $translator;
        $this->translationDomain = $translationDomain;
        $this->translationLocale = $translationLocale;
    }

    /**
     * Raises an alert. If an existing alert was previously raised, the last-issued date
     * is updated instead of creating a new alert.
     *
     * @param string    $name
     * @param integer   $level
     * @param string    $message
     * @param array     $messageParams
     * @param array     $context
     * @param array     $data
     * @param \DateTime $dateIssued
     *
     * @return Alert
     */
    public function raise($name, $level, $message, array $messageParams = [], array $context = null, array $data = null, \DateTime $dateIssued = null)
    {
        $manager = $this->getManager();
        $checksum = $this->calculateChecksum($name, $context);
        if (null === $dateIssued) {
            $dateIssued = new \DateTime();
        }

        $message = $this->translator->trans($message, $messageParams, $this->translationDomain, $this->translationLocale);

        // see if an alert with this checksum exists
        if (null === $alert = $this->getRepository()->findOneLatestByChecksum($checksum)) {
            // no alert found, create a new one
            $alert = $this->create($name, $level, $message, $context, $data, $dateIssued);
            $manager->persist($alert);
        }

        $alert->setMessage($message);
        $alert->incrementCount();
        $alert->setDatetimeLastIssued($dateIssued);
        $manager->flush($alert);

        return $alert;
    }

    /**
     * Lifts an alert for a given name and context
     *
     * @param string $name
     * @param array  $context
     */
    public function lift($name, array $context = null)
    {
        $manager = $this->getManager();
        $checksum = $this->calculateChecksum($name, $context);
        $alerts = $this->getRepository()->findByChecksum($checksum);

        /** @var Alert[] $alerts */
        foreach ($alerts as $alert) {
            $manager->remove($alert);
        }

        $manager->flush($alerts);
    }

    /**
     * Mutes alerts with the given name and context
     *
     * @param string $name
     * @param array  $context
     */
    public function mute($name, array $context = null)
    {
        $manager = $this->getManager();
        $checksum = $this->calculateChecksum($name, $context);
        $alerts = $this->getRepository()->findByChecksum($checksum);

        /** @var Alert[] $alerts */
        foreach ($alerts as $alert) {
            $alert->setMuted(true);
        }

        $manager->flush($alerts);
    }

    /**
     * @return AlertRepository
     */
    public function getRepository()
    {
        return $this->getManager()->getRepository('FMConanAlertBundle:Alert');
    }

    /**
     * @param string $name
     * @param array  $context
     *
     * @return string
     */
    public function calculateChecksum($name, array $context = null)
    {
        return md5($name . json_encode($context));
    }

    /**
     * Creates a new alert
     *
     * @param string    $name
     * @param integer   $level
     * @param string    $message
     * @param array     $context
     * @param array     $data
     * @param \DateTime $dateIssued
     *
     * @return Alert
     */
    protected function create($name, $level, $message, array $context = null, array $data = null, \DateTime $dateIssued = null)
    {
        if (null === $dateIssued) {
            $dateIssued = new \DateTime();
        }

        $alert = new Alert();
        $alert->setName($name);
        $alert->setLevel($level);
        $alert->setContext($context);
        $alert->setData($data);
        $alert->setMessage($message);
        $alert->setDatetimeFirstIssued($dateIssued);

        $checksum = $this->calculateChecksum($name, $context);
        $alert->setChecksum($checksum);

        return $alert;
    }

    /**
     * @return ObjectManager
     */
    protected function getManager()
    {
        return $this->doctrine->getManager();
    }
}

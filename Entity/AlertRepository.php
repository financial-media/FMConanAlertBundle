<?php

namespace FM\ConanAlertBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AlertRepository extends EntityRepository
{
    /**
     * Finds unique alert based on checksum
     *
     * @param string $checksum
     *
     * @return Alert|null
     */
    public function findOneLatestByChecksum($checksum)
    {
        $builder = $this->createQueryBuilder('a')
            ->where('a.checksum = :checksum')
            ->orderBy('a.datetimeLastIssued', 'desc')
            ->setParameter('checksum', $checksum)
            ->setMaxResults(1)
        ;

        return $builder->getQuery()->getOneOrNullResult();
    }

    /**
     * Finds all alerts that have not been muted
     *
     * @return Alert[]
     */
    public function findNonMuted()
    {
        $builder = $this->createQueryBuilder('a')
            ->andWhere('a.muted = 0')
            ->orderBy('a.datetimeLastIssued', 'desc')
        ;

        return $builder->getQuery()->getResult();
    }
}

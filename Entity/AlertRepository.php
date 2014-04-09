<?php

namespace FM\ConanAlertBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AlertRepository extends EntityRepository
{
    public function findOneLastestByChecksum($checksum)
    {
        $qb = $this->createQueryBuilder('a')
            ->where('a.checksum = :checksum')
            ->andWhere('a.muted = 0')
            ->orderBy('a.datetimeLastIssued', 'desc')
            ->setParameter('checksum', $checksum)
            ->setMaxResults(1)
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}

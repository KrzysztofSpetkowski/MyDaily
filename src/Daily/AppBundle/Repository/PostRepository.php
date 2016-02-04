<?php

namespace Daily\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;

use AppBundle\Entity\User;

class PostRepository extends EntityRepository
{
    public function getPostQuery(User $user)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('p')
            ->from('AppBundle:Post', 'p')
            ->where('p.createdBy=:user')
            ->setParameter('user', $user)
            ->orderBy('p.createdAt', 'DESC');

        return $qb->getQuery();
    }
}
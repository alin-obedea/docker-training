<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BlogRepository extends EntityRepository
{
    public function findOneByIdQuery(int $id)
    {
        $query = $this->_em->createQuery(
              "SELECT post FROM AppBundle:Post post WHERE post.id = :id"
        );

        $query->setParameter('id', $id);

        return $query;
    }

//    public function findOneBySlugQuery()
//    {
//        $query = $this->_em->createQuery(
//            "SELECT comments FROM AppBundle:Comment "
//        );
//    }
}
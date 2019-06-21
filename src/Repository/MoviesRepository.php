<?php

namespace App\Repository;

use App\Entity\Movies;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Movies|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movies|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movies[]    findAll()
 * @method Movies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoviesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Movies::class);
    }

    // /**
    //  * @return Movies[] Returns an array of Movies objects
    //  */

    public function getMoviesByUser($user)
    {
        return $this->createQueryBuilder('m')
            ->addSelect('u')
            ->leftJoin('m.users', 'u')
            ->andWhere('u.id = :id')
            ->setParameter(':id', $user->getId())
            ->getQuery()
            ->getResult()
        ;
    }

}

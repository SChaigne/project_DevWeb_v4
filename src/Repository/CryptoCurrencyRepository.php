<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\CryptoCurrency;
use App\Service\CryptoCurrencyService;
use Doctrine\ORM\EntityManagerInterface;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CryptoCurrency|null find($id, $lockMode = null, $lockVersion = null)
 * @method CryptoCurrency|null findOneBy(array $criteria, array $orderBy = null)
 * @method CryptoCurrency[]    findAll()
 * @method CryptoCurrency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CryptoCurrencyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CryptoCurrency::class);
    }

    /**
     * Récupère les produits en lien avec une recherche
     * @return CryptoCurrency[]
     */
    public function findSearch(SearchData $search): array
    {
        $query = $this->createQueryBuilder('Crypto')->select('Crypto');

        if (!empty($search->inputSearch)) {
            $query = $query->andWhere('Crypto.name LIKE :inputSearch')->setParameter('inputSearch', "%{$search->inputSearch}%");
        }

        if (!empty($search->minPrice)) {
            $query = $query->andWhere('Crypto.price >= :minPrice')->setParameter('minPrice', $search->minPrice);
        }
        if (!empty($search->maxPrice)) {
            $query = $query->andWhere('Crypto.price <= :maxPrice')->setParameter('maxPrice', $search->maxPrice);
        }
        // return $this->findAll();
        return $query->getQuery()->getResult();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(CryptoCurrency $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(CryptoCurrency $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return CryptoCurrency[] Returns an array of CryptoCurrency objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CryptoCurrency
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function clearCryptoTable(EntityManagerInterface $em)
    {
        $em->createQuery('DELETE FROM App\Entity\CryptoCurrency')->execute();
    }
}

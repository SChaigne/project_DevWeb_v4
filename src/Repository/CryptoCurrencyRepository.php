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
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method CryptoCurrency|null find($id, $lockMode = null, $lockVersion = null)
 * @method CryptoCurrency|null findOneBy(array $criteria, array $orderBy = null)
 * @method CryptoCurrency[]    findAll()
 * @method CryptoCurrency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CryptoCurrencyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
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

        //TODO CATEGORIE

        //TODO FinCateg

        if (!empty($search->orderPrice)) {
            if ($search->orderPrice == "priceAsc") {
                $query = $query->orderBy('Crypto.price', 'ASC');
            } else {
                $query = $query->orderBy('Crypto.price', 'DESC');
            }
        }

        if (!empty($search->orderPriceMarketCap)) {
            if ($search->orderPrice == "priceMarketCapAsc") {
                $query = $query->orderBy('Crypto.marketcap', 'ASC');
            } else {
                $query = $query->orderBy('Crypto.marketcap', 'DESC');
            }
        }

        if (!empty($search->minPrice)) {
            $query = $query->andWhere('Crypto.price >= :minPrice')->setParameter('minPrice', $search->minPrice);
        }
        if (!empty($search->maxPrice)) {
            $query = $query->andWhere('Crypto.price <= :maxPrice')->setParameter('maxPrice', $search->maxPrice);
        }
        if (!empty($search->minMarketCap)) {
            $query = $query->andWhere('Crypto.marketcap >= :minMarketCap')->setParameter('minMarketCap', $search->minMarketCap);
        }
        if (!empty($search->maxMarketCap)) {
            $query = $query->andWhere('Crypto.marketcap <= :maxMarketCap')->setParameter('maxMarketCap', $search->maxMarketCap);
        }
        return $query->getQuery()->getResult();
    }

    /**
     * Récupère le prix minimum et maximum correspondant à une recherche
     * @return integer[]
     */
    public function findMinMax(SearchData $search): array
    {
        return [0, 1000];
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

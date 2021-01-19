<?php


namespace App\CustomerAciliaSoftware\Category\Infrastructure\Repositories;




use Doctrine\DBAL\Connection;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;

abstract class BaseRepository
{

    /**
     * @var ManagerRegistry
     */
    private ManagerRegistry $managerRegistry;
    /**
     * @var Connection
     */
    protected Connection $connection;

    protected ObjectRepository $objectRepository;

    public function __construct(ManagerRegistry $managerRegistry, Connection $connection) {
        $this->managerRegistry = $managerRegistry;
        $this->connection = $connection;
        $this->objectRepository = $this->getEntityManager()->getRepository($this->entityClass());
    }

    abstract protected static function entityClass(): string;


    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function saveEntity(object $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function deleteEntity(object $entity): void
    {
        $this->getEntityManager()->remove($entity);
    }

    public function getEntityManager()
    {
        $entityManager = $this->managerRegistry->getManager();

        if($entityManager->isOpen())
        {
            return $entityManager;
        }

        return $this->managerRegistry->resetManager();
    }
}

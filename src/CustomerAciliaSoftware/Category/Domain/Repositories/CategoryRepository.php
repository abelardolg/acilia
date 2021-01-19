<?php


namespace App\CustomerAciliaSoftware\Category\Infrastructure\Repositories;


use App\CustomerAciliaSoftware\Category\Domain\Category;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryRepository extends BaseRepository
{

    protected static function entityClass(): string
    {
        return Category::class;
    }

    public function findOnebyNameOrFail(string $name): Category
    {
        $category = $this->objectRepository->findOneBy(['name' => $name]);
        if (null === $category) {
            throw new NotFoundHttpException(sprintf('Category %s not found', $name));
        }

        return $category;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Category $category) {
        $this->saveEntity($category);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Category $category) {
        $this->deleteEntity($category);
    }
}

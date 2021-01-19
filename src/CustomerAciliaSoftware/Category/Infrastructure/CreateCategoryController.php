<?php


namespace App\CustomerAciliaSoftware\Category\Infrastructure;


use Symfony\Component\HttpFoundation\JsonResponse;

class CreateCategoryController
{

    public function __construct()
    {

    }

    public function __invoke(Category $category)
    {
        return new JsonResponse(['data' => 123]);
    }
}

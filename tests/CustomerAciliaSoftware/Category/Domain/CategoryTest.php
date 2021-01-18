<?php


namespace App\Tests\CustomerAciliaSoftware\Category\Domain;


use App\CustomerAciliaSoftware\Category\Domain\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{

    public function testSetInvalidName() {
        $category = new Category("A valid name","A valid description");

        $this->assertSame(true, strlen($category->getName())>0);
    }

    public function testSetInvalidDescription() {
        $category = new Category("A category with an invalid description","A valid description");

        $this->assertSame(true, strlen($category->getDescription())>0);
    }

}

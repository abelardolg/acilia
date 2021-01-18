<?php


namespace App\Tests\CustomerAciliaSoftware;


use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
//    public function testThatYourComputerWorks()
//    {
//        $this->assertTrue(false);
//    }

    public function testSetCategoryNameLength() {
        $category = new Category();

        $this->assertSame(0, strlen($category->getName()));
        $category->setName("CATEGORY_1");
        $this->assertSame(10, strlen($category->getName()));
    }

}

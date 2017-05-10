<?php

namespace Project\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Category;

class CategoryFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $category=new Category();
        $category->setCategory("r1");
        $manager->persist($category);

        $category1=new Category();
        $category1->setCategory("r2");
        $manager->persist($category1);

        $manager->flush();
    }
    public function getOrder()
    {
        return 1;
    }
}

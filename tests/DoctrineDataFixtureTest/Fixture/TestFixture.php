<?php

namespace DoctrineDataFixtureTest\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineDataFixtureTest\Entity\TestEntity;

/**
 * Class TestFixture
 * @package Blog\Fixture
 */
class TestFixture extends AbstractFixture
{
    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $testEntity = (new TestEntity())
            ->setName('Test 1')
            ->setCreatedAt(new \DateTime('now'));
        $manager->persist($testEntity);

        $testEntity = (new TestEntity())
            ->setName('Test 2')
            ->setCreatedAt(new \DateTime('now'));
        $manager->persist($testEntity);

        $testEntity = (new TestEntity())
            ->setName('Test 3')
            ->setCreatedAt(new \DateTime('now'));
        $manager->persist($testEntity);

        $testEntity = (new TestEntity())
            ->setName('Test 4')
            ->setCreatedAt(new \DateTime('now'));
        $manager->persist($testEntity);

        $testEntity = (new TestEntity())
            ->setName('Test 5')
            ->setCreatedAt(new \DateTime('now'));
        $manager->persist($testEntity);

        $manager->flush();
    }
}
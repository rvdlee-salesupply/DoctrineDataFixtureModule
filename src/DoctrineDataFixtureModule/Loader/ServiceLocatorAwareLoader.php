<?php

namespace DoctrineDataFixtureModule\Loader;

use Doctrine\Common\DataFixtures\Loader as BaseLoader;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;

/**
 * Doctrine fixture loader which is ZF2 Service Locator-aware
 * Will inject the service locator instance into all SL-aware fixtures on add
 *
 * @license http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link    www.doctrine-project.org
 * @author  Adam Lundrigan <adam@lundrigan.ca>
 */
class ServiceLocatorAwareLoader extends BaseLoader
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * ServiceLocatorAwareLoader constructor.
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function __construct(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Add a fixture object instance to the loader.
     *
     * @param FixtureInterface $fixture
     */
    public function addFixture(FixtureInterface $fixture)
    {
        if ($fixture instanceof ServiceLocatorAwareInterface) {
            $fixture->setServiceLocator($this->serviceLocator);
        }
        parent::addFixture($fixture);
    }
}

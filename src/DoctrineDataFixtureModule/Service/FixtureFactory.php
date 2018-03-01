<?php

namespace DoctrineDataFixtureModule\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Factory for Fixtures
 *
 * @license MIT
 * @link    www.doctrine-project.org
 * @author  Martin Shwalbe <martin.shwalbe@gmail.com>
 * @author  Rob van der Lee <r.vdlee@salesupply.com>
 */
class FixtureFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @return bool
     */
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        return class_exists($requestedName);
    }

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return array|object
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return $this->getOptions($container, 'fixtures');
    }

    /**
     * @param ContainerInterface $container
     * @param $key
     * @return array
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getOptions(ContainerInterface $container, $key)
    {
        $options = $container->get('config');
        if (!isset($options['doctrine']['fixture'])) {
            return array();
        }
        
        return $options['doctrine']['fixture'];
    }
}

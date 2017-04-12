<?php

namespace Xeonys\LoggerExtra\App\Bundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class XeonysLoggerExtraExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $container->setParameter('xeonys.logger_extra.app_name', $config['fields']['app_name']);
        $container->setParameter('xeonys.logger_extra.app_env', $config['fields']['app_env']);
        $container->setParameter('xeonys.logger_extra.server_stack', $config['fields']['server_stack']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/services'));
        $loader->load('processors.xml');
        $loader->load('service.xml');
    }
}

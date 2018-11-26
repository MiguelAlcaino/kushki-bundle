<?php

namespace MiguelAlcaino\KushkiBundle\DependencyInjection;

use MiguelAlcaino\PaymentGateway\Interfaces\Factory\TransactionRecordFactoryInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class MiguelAlcainoKushkiExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $container->setAlias(TransactionRecordFactoryInterface::class, $config['transaction_record']['transaction_record_factory']);
        $container->setAlias('kushki_transaction_record_factory', TransactionRecordFactoryInterface::class);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $loader->load('services.yaml');
    }

}
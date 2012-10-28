<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AlbumClient;

// use Zend
use Zend\Soap\Client;
/**
 * Description of Module
 *
 * @author David White [monkeyphp] <david@monkeyphp.com>
 */
class Module
{
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                // create an return our Soap Client instance
                'AlbumClientClient' => function ($serviceManager){
                    $client = new Client(
                        // this needs setting in application.config -
                        // but I dont know how to do that yet (sob!)
                        'http://learning-zf2/album-service/service?wsdl',
                        array(
                            'classmap' => array(
                                'Album' => 'AlbumClient\Model\Album'
                            )
                        )
                    );
                    return $client;
                },
            )
        );
    }

    /**
     * Return an array of config options for the class autoloader to that it
     * can find our classes
     *
     * @access public
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoLoader' => array(
                __DIR__ . '/autoload_classmap.php'
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__  . '/src/' . __NAMESPACE__,
                )
            )
        );
    }

    /**
     * Return module config options
     *
     * @access public
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
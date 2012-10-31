<?php
/**
 * Module.php
 *
 * LICENSE: Copyright David White [monkeyphp] <git@monkeyphp.com> http://www.monkeyphp.com/
 *
 * PHP Version 5.3.6
 *
 * @category  AlbumClient
 * @package   AlbumClient
 * @author    David White [monkeyphp] <git@monkeyphp.com>
 * @copyright 2011 David White (c) monkeyphp.com
 * @license   http://www.monkeyphp.com/ MonkeyPHP
 * @version   Revision: ##VERSION##
 * @link      http://www.monkeyphp.com/ MonkeyPHP
 * @created   28-Oct-2012 11:21:44
 */
namespace AlbumClient;
// use Zend
use Zend\Soap\Client;
/**
 * Module
 *
 * @category   AlbumClient
 * @package    AlbumClient
 * @author     David White [monkeyphp] <git@monkeyphp.com>
 * @copyright  2011 David White (c) monkeyphp.com
 * @license    http://www.monkeyphp.com/ MonkeyPHP
 * @version    Release: ##VERSION##
 * @link       http://www.monkeyphp.com/ MonkeyPHP
 */
class Module
{

    /**
     * Return an array of factories to pass to the ServiceManager
     *
     * Here we will create a closure to return an instance of
     * Zend\Soap\Client configured to communicate with the SOAP service whenever
     * an instance is requested.
     * The returned client will include the location of the SOAP service and
     * a classmap to map XSD types to PHP classes.
     *
     * @access public
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                // create an return our Soap Client instance
                'AlbumClientClient' => function ($serviceManager){
                    // retrieve config array from service manager
                    $config = $serviceManager->get('config');
                    // retrieve the wsdl from the config array
                    $wsdl = $config['wsdl'];
                    // create the Client instance
                    $client = new Client($wsdl, array(
                        'classmap' => array(
                            'Album' => 'AlbumClient\Model\Album'
                        )
                    ));
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
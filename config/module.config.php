<?php
/**
 * module.config.php
 *
 * Long description for file (if any)...
 *
 * LICENSE: Copyright David White [monkeyphp] <david@monkeyphp.com> http://www.monkeyphp.com/
 *
 * PHP Version 5.3.6
 *
 * @category
 * @package    Expression package is undefined on line 12, column 18 in Templates/Scripting/EmptyPHP.php.
 * @subpackage
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 * @copyright  2011 David White (c) monkeyphp.com
 * @license    http://www.monkeyphp.com/
 * @version    Revision: ##VERSION##
 * @link       http://www.monkeyphp.com/
 * @since
 * @created    28-Oct-2012 14:47:38
 */
return array(
    // controllers
    'controllers' => array(
        'invokables' => array(
            'AlbumClient\Controller\IndexController' => 'AlbumClient\Controller\IndexController'
        )
    ),
    
    // routes
    'router' => array(
        'routes' => array(
            'album-client' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/album-client[/:action][/:id]',
                    'contraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'AlbumClient\Controller\IndexController',
                        'action'     => 'index'
                    )
                )
            )
        )
    ),

    // view templates
    'view_manager' => array(
        'template_path_stack' => array(
            'album' => __DIR__ . '/../view'
        )
    )
);
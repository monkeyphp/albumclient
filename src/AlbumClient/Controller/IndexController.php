<?php
/**
 * IndexController.php
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
 * @created    28-Oct-2012 14:17:19
 */
namespace AlbumClient\Controller;
// use AlbumClient

// use Zend
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @category
 * @package
 * @subpackage
 * @author     David White [monkeyphp] <david@monkeyphp.com>
 * @copyright  2011 David White (c) monkeyphp.com
 * @license    http://www.monkeyphp.com/
 * @version    Release: ##VERSION##
 * @link       http://www.monkeyphp.com/
 * @since
 */
class IndexController extends AbstractActionController
{

    /**
     * Instance of Zend\Soap\Client configured to talk with the AlbumService
     *
     * @access protected
     * @var    Zend\Soap\Client
     */
    protected $client;

    /**
     * Retrieve an instance of Zend\Soap\Client from the ServiceLocator
     *
     * @access protected
     * @return Zend\Soap\Client
     */
    protected function getClient()
    {
        if (! isset($this->client)) {
            $serviceManager = $this->getServiceLocator();
            $this->client = $serviceManager->get('AlbumClientClient');
        }
        return $this->client;
    }

    /**
     * Retrieve an array of all instances of AlbumClient\Model\Album from
     * the web service
     *
     * @access public
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        return new ViewModel(array('albums' => $this->getClient()->fetchAlbums()));
    }

    /**
     * Purchase an album action
     *
     * @access public
     * @return \Zend\View\Model\ViewModel
     */
    public function purchaseAction()
    {
        $id = (int)$this->params('id');
        if (! $id) {
            return $this->redirect()->toRoute('album-client');
        }
        
        return new ViewModel(array('album' => $this->getClient()->findAlbum()));
    }

}
<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    protected $usuarioTable;
    
    
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function pruebaAction()
    {
        //return new ViewModel();
       //echo "hola";
       // print_r($this->getUsuarioTable()->fetchAll());exit;
        //var_dump(array(1));
        //exit;
        //return new ViewModel();
        return new ViewModel(array(
            'usuarios' => $this->getUsuarioTable()->fetchAll(),
        ));
    }
    
    public function getUsuarioTable()
    {
        if (!$this->usuarioTable) {
            $sm = $this->getServiceLocator();
            $this->usuarioTable = $sm->get('Application\Model\UsuarioTable');
        }
        return $this->usuarioTable;
    }
}

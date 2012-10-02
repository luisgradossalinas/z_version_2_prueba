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
use Application\Form\UsuarioForm;   


class CategoriaController extends AbstractActionController
{
    
    public function indexAction()
    {

    }
    
     public function onDispatch($e)

    {

        $matches    = $e->getRouteMatch();

        $controller = $matches->getParam('controller');

        if (strpos($controller, __NAMESPACE__) !== 0) {

            // not a controller from this module

            return;

        }



        // Do module specific bootstrapping here



        // Set the layout template for every action in this module

        $viewModel = $e->getViewModel();

        $viewModel->setTemplate('layout/simple');

    }
    
   
}

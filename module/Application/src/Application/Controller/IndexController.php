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
use Application\Model\Usuario;          
use Application\Form\UsuarioForm;   


class IndexController extends AbstractActionController
{
    protected $usuarioTable;
    
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function pruebaAction()
    {
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
    
    public function addAction()
    {
        $form = new UsuarioForm;
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $usuario = new Usuario();
            $form->setInputFilter($usuario->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $usuario->exchangeArray($form->getData());
                $this->getUsuarioTable()->save($usuario);

                // Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }
        
        return array('form' => $form);
        
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}

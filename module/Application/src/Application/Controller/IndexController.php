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


class IndexController extends AbstractActionController
{
    protected $usuarioTable;
    
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function listadoAction()
    {
        return new ViewModel(array(
            'usuarios' => $this->getUsuarioTable()->fetchAll(),
        ));
        
        //return array('usuarios' => $this->getUsuarioTable()->fetchAll());
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
        //Deshabilitar layout.phtml
        //viewModel = new ViewModel();
        //$viewModel->setTerminal(true);
        //return $viewModel;

        $form = new UsuarioForm;
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $usuario = new Usuario();
            print_r($request->getPost());exit;
            $form->setInputFilter($usuario->getInputFilter());
            $form->setData($request->getPost());
            

            if ($form->isValid()) {
                $usuario->exchangeArray($form->getData());
                $this->getUsuarioTable()->save($usuario);
                
                return $this->redirect()->toRoute('application');
            }
        }
        
        return array('form' => $form);
        
    }

    public function editAction()
    {
        $form  = new UsuarioForm();
        
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('index', array('action' => 'edit'));
        }
        $usuario = $this->getUsuarioTable()->getUser($id);
        
        $form->bind($usuario);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($usuario->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getUsuarioTable()->save($usuario);
                return $this->redirect()->toRoute('application');
                //return $this->redirect('application/index/listado');
                
            }
        }

        return array('form' => $form);
    }

    public function deleteAction()
    {
        
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('application');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getUsuarioTable()->delete($id);
            }
            return $this->redirect()->toRoute('application');
        }

        return array(
            'id'    => $id,
            'usuario' => $this->getUsuarioTable()->getUser($id)
        );
    }
}

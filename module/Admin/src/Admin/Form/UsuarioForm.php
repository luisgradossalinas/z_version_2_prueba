<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class UsuarioForm extends Form
{
    public function __construct()
    {
        // we want to ignore the name passed
        parent::__construct('usuario');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'rol',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Rol:',
            ),
        ));
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'E-mail',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
    
}

<?php

namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class UsuarioTable extends AbstractTableGateway
{
    protected $table ='usuario';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Usuario());
        $this->initialize();
    }

    public function fetchAll()
    {
        $resultSet = $this->select();
        return $resultSet;
    }
    
    public function inner()
    {
        
    }

    public function get($id)
    {
        $id  = (int) $id;
        $rowset = $this->select(array('id' => $id));$this->
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("No se pudo encontrar el registro $id");
        }
        return $row;
    }

    public function save(Album $album)
    {
        /*$data = array(
            'nombre' => $album->artist,
            'apellido'  => $album->title,
        );*/
        $id = (int)$album->id;
        if ($id == 0) {
            $this->insert($data);
        } else {
            if ($this->getAlbum($id)) {
                $this->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function delete($id)
    {
        $this->delete(array('id' => $id));
    }
    
}
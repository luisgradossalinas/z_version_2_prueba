<?php

namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class UsuarioTable extends TableGateway
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

    public function getUser($id)
    {
        $id  = (int) $id;
        $rowset = $this->select(array('id' => $id));
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
            $this->insert($album);
        } else {
            if ($this->getAlbum($id)) {
                $this->update($album, array('id' => $id));
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
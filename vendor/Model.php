<?php

namespace vendor;

use vendor\Db\AbstractDB;

class Model extends AbstractDB
{
    public function find($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = " . $id;
        $result = $this->_db->query($sql);
        $obj = (object)$result->fetch();
        
        return $obj;
    }
    
    public function findAll()
    {
        $collection = [];
        $sql = "SELECT * FROM " . $this->table;
        $result = $this->_db->query($sql);
        
        while($row = $result->fetch()){
            $collection[] = (object)$row;
        }
        
        return $collection;
    }
    
    public function insert($data)
    {
        $sql  = "INSERT INTO " . $this->table;

        $sql .= " (".implode(", ", array_keys($data)).")";

        $sql .= " VALUES ('".implode("', '", $data)."') ";
        
        $this->_db->query($sql);
        
        return $this;
    }
    
    public function update($id, $data)
    {
        $sql  = "UPDATE " . $this->table . " SET ";

        foreach($data as $k => $v){
            $sql .= $k . " = '" . $v. "', ";
        }
        
        $sql = substr($sql, 0, -2);
        
        $sql .= " WHERE id = " . $id;
        
        $this->_db->query($sql);
        
        return $this;
    }
    
    public function delete($id)
    {
        if(!empty($id)){
            
            $sql = "DELETE FROM " . $this->table . " WHERE id = " . $id;
            $this->_db->query($sql);
            
        }else{
            throw new Exception("ID can't found");
        }
    }
    
}
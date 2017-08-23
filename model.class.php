<?php

include './config.php';
class Model extends PDO
{
    protected $tabName;
    protected $sql = '';

    public function __construct($tabName)
    {
        parent::__construct('mysql:host='.HOST.';dbname='.DB.';charset=utf8',USER,PWD);
        $this->tabName = FIX.$tabName;
    }

    public function select()
    {
        $sql = "select * from {$this->tabName}";
        $this->sql=$sql;
        $stmt = $this->query($sql);
        if($stmt) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }
        return [];
    }
    public function find($id)
    {
        $sql = "select * from{$this->tabName} where id={$id}";
        $this->sql = $sql;
        $stmt = $this->query($sql);
        if ($stmt) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return [];
    }

    public function add($data)
    {
        $keys=join(array_keys($data),',');
        $vals = join($data,"','");
    
        $sql = "insert into {$this->tabName}({$keys}) values('{$vals}')";
        $this->sql =$sql;
        return $this->exec($sql);
    
        // echo $sql;
    }
    public function delete($id)
    {
        $sql = "delete from {'$this->tabName'} where id={$id}";
        $this->sql=$sql;
        return $this->exec($sql);
    }

    public function save(){}
    public function _sql()
    {
        return $this->sql;
    }
}

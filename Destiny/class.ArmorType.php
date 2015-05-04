<?php
class ArmorType
{
    
    private $conn;
    private $table_name = 'ds_armor_type';
    
    public $id;
    public $name;
    public $cid;
    
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    
    function read()
    {
        
        $query = "SELECT aid, name FROM " . $this->table_name . " ORDER BY name";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    }
    
    function readName()
    {
        $query = "SELECT name from " . $this->table_name . " WHERE aid = ? limit 0,1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->name = $row['name'];
        
        
        
    }
    
    
    
    
    
    
}

?>
<?php

//Creates Destiny Armor Class
class Armor
{
    
    private $conn;
    private $table_name = "destiny_armor";
    
    public $name;
    public $type;
    public $aclass;
    public $def;
    public $light;
    public $strength;
    public $disc;
    public $intel;
    public $id;
    
    
    
    
    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    public function create()
    {
        
        $query = "INSERT INTO " . $this->table_name . " 
	    SET aname = ?, atype = ?, aclass = ?, def = ?, light = ?, intel = ?, disc = ?, str = ?";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->type);
        $stmt->bindParam(3, $this->aclass);
        $stmt->bindParam(4, $this->def);
        $stmt->bindParam(5, $this->light);
        $stmt->bindParam(6, $this->intel);
        $stmt->bindParam(7, $this->disc);
        $stmt->bindParam(8, $this->strength);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        
        
    }
    
    
    function update()
    {
        
        $query = "UPDATE " . $this->table_name . " 
	    SET aname = :name,
		atype = :type,
		aclass = :aclass,
		def = :def,
		light = :light,
		intel = :intel,
		disc = :disc,
		str = :strength
	    WHERE vid = :id";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':aclass', $this->aclass);
        $stmt->bindParam(':def', $this->def);
        $stmt->bindParam(':light', $this->light);
        $stmt->bindParam(':intel', $this->intel);
        $stmt->bindParam(':disc', $this->disc);
        $stmt->bindParam(':str', $this->strength);
        $stmt->bindParam(':id', $this->id);
        
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
    
    
    function delete()
    {
        
        $query = "DELETE FROM " . $this->table_name . "WHERE vid = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        
        if ($result = $stmt->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
    
    
    
    
    function readAll($page, $from_record_num, $records_per_page)
    {
        $query = "SELECT vid, aname, atype, aclass, def, light, intel, disc, str
FROM " . $this->table_name . "
ORDER BY  aname ASC LIMIT {$from_record_num}, {$records_per_page}";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
        
        
        
    }
    
    function readOne()
    {
        
        $query = "SELECT aname, atype, aclass, def, light, intel, disc, str
   	    FROM " . $this->table_name . "
	    WHERE vid = ?  LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->name     = $row['aname'];
        $this->type     = $row['atype'];
        $this->aclass   = $row['aclass'];
        $this->def      = $row['def'];
        $this->light    = $row['light'];
        $this->intel    = $row['intel'];
        $this->disc     = $row['disc'];
        $this->strength = $row['str'];
        
    }
    
    public function countAll()
    {
        
        $query = "select vid from " . $this->table_name . "";
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();
        
        $num = $stmt->rowCount();
        
        return $num;
        
    }
    
    
}
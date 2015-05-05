<?php
$page_title = "Update Armor";
include_once "header.php";


echo "<div class='right-button-margin'>";
echo "<a href='index.php' class='button'>Read Armor</a>";
echo "</div>";


// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// include database and object files
include_once 'database.php';
include_once 'class.Armor.php';

// get database connection
$database = new database();
$db       = $database->getConnection();

// prepare product object
$Armor = new Armor($db);

// set ID property of product to be edited
$Armor->id = $id;

// read the details of product to be edited
$Armor->readOne();

?>

<form action='update_armor.php?id=<?php
echo $id;
?>' method='post'>
 
    <table class='table table-hover table-responsive table-bordered'>
     <tr>
	<td>Name</td>
	<td><input type='text' name='name' value='<?php
echo $Armor->name;
?>' class='form-control' required></td>
     </tr>
     <tr>
   	<td>Type</td>
	<td>  
	   <?php
// read the product categories from the database
include_once 'class.ArmorType.php';

$armorType = new ArmorType($db);
$stmt      = $armorType->read();

// put them in a select drop-down
echo "<select class='form-control' name='atype'>";

echo "<option>Please select...</option>";
while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row_category);
    
    
    // current category of the product must be selected
    if ($Armor->tid == $aid) {
        echo "<option value='{$name}' selected>";
    } else {
        echo "<option value='{$name}'>";
    }
    
    echo "$name</option>";
}
echo "</select>";
?>
	</td>
     </tr>
     <tr>
	<td>Class</td>
	<td><input type='text' name='ctype' value='<?php
echo $Armor->aclass;
?>' class='form-control' required></td>
     </tr>
     <tr>
	<td>Defense</td><td>Light</td><td>Intellect</td><td>Discipline</td><td>Strength</td>
     </tr>
     <tr>
	<td><input type='text' name='def' value='<?php
echo $Armor->def;
?>' class='form-control' </td>
	<td><input type='text' name='light' value='<?php
echo $Armor->light;
?>' class='form-control' </td>
	<td><input type='text' name='intel' value='<?php
echo $Armor->intel;
?>' class='form-control' </td>
	<td><input type='text' name='disc' value='<?php
echo $Armor->disc;
?>' class='form-control' </td>
	<td><input type='text' name='str' value='<?php
echo $Armor->strength;
?>'class='form-control' </td>
     </tr>
     <tr><td></td>
	<td>
	  <button type='submit' class='btn-primary'>Update</button>

	</td>
     </tr>
  </table>
</form>

<?php
if ($_POST) {
    
    
    $Armor->name     = $_POST['name'];
    $Armor->type     = $_POST['atype'];
    $Armor->aclass   = $_POST['ctype'];
    $Armor->def      = $_POST['def'];
    $Armor->light    = $_POST['light'];
    $Armor->intel    = $_POST['intel'];
    $Armor->disc     = $_POST['disc'];
    $Armor->strength = $_POST['str'];
    $Armor->id       = $id;
    
    if ($Armor->update()) {
        echo "<div class=\"alert alert-success alert-dismissable\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times</button>";
        echo "Armor was updated.";
        echo "</div>";
        
    } else {
        echo "<div class=\"alert alert-danger alert-dismissable\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times</button>";
        echo "Unable to update Armor.";
        echo "</div>";
        
    }
    
    
}


?>
<?php
$page_title = "Create Armor";
include_once "header.php";
?>

<div class='right-button-margin'>
   <a href='index.php' class='btn btn-default pull-right'>View Armor</a>
</div>

<?php


include_once "database.php";

$database = new database();
$db       = $database->getConnection();


if ($_POST) {
    
    include_once 'class.Armor.php';
    $armor = new Armor($db);
    
    $armor->name     = $_POST['name'];
    $armor->type     = $_POST['atype'];
    $armor->aclass   = $_POST['ctype'];
    $armor->def      = $_POST['def'];
    $armor->light    = $_POST['light'];
    $armor->intel    = $_POST['intel'];
    $armor->disc     = $_POST['disc'];
    $armor->strength = $_POST['str'];
    
    
    //create the armor
    if ($armor->create()) {
        echo "<div class=\"alert alert-success alert-dismissable\">";
        echo "<button type=\"button\" class=\"button add\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
        echo "Armor was Added.";
        echo "</div>";
    }
    
    else {
        echo "<div class=\"alert alert-danger alert-dissmissable\">";
        echo "<button type=\"button\" class=\"button add\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
        echo "Unable to Add Armor.";
        echo "</div>";
    }
}

?>
<form action='create_armor.php' method='post'>

  <table class='table table-hover table-responsive table-bordered'>
     <tr>
	<td>Name</td>
	<td><input type='text' name='name' class='form-control' required></td>
     </tr>
     <tr>
   	<td>Type</td>
	<td>  
	<?php
include_once 'class.ArmorType.php';

$ArmorType = new ArmorType($db);
$stmt      = $ArmorType->read();

echo "<select class='form-control' name='atype'>";
echo "<option>Select Type...</option>";
while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row_category);
    echo "<option value='{$name}'>{$name}</option>";
}
echo "</select>";
?>

	</td>
     </tr>
     <tr>
	<td>Class</td>
	<td><input type='text' name='ctype' class='form-control' required></td>
     </tr>
     <tr>
	<td>Defense</td><td>Light</td><td>Intellect</td><td>Discipline</td><td>Strength</td>
     </tr>
     <tr>
	<td><input type='text' name='def' class='form-control' </td>
	<td><input type='text' name='light' class='form-control' </td>
	<td><input type='text' name='intel' class='form-control' </td>
	<Td><input type='text' name='disc' class='form-control' </td>
	<td><input type='text' name='str' class='form-control' </td>
     </tr>
     <tr><td></td>
	<td>
	   <button type='submit' class="button add">Create</button>
	</td>
     </tr>
  </table>
</form>

<?php
include_once "footer.php";
?>
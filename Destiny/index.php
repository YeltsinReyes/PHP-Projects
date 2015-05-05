<?php
$page_title = "View Armor";
include_once("header.php");

?>



<div class="right-button-margin">
<div class="buttons">
<!-- <a href="create_armor.php" class="btn btn-default pull-right">Create Armor</a> -->
<a href="create_armor.php" class="button">Create Armor</a>
</div>
</div>

<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$records_per_page = 10;

$from_record_num = ($records_per_page * $page) - $records_per_page;

include_once('database.php');
include_once('class.ArmorType.php');
include_once('class.Armor.php');


$database = new database();
$db       = $database->getConnection();


$Armor = new Armor($db);



$stmt = $Armor->readAll($page, $from_record_num, $records_per_page);



$num = $stmt->rowCount();


if ($num > 0) {
    
    $armorType = new ArmorType($db);
    
    echo "<table class='table table-hover table-responsive table-bordered'>";
    
    echo "<tr>";
    
    echo "<th>Name</th>";
    echo "<th>Type</th>";
    echo "<th>Class</th>";
    echo "<th>Defense</th>";
    echo "<th>Light</th>";
    echo "<th>Intelligence</th>";
    echo "<th>Discipline</th>";
    echo "<th>Strength</th>";
    echo "<th>Actions</th>";
    echo "</tr>";
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
        extract($row);
        
        echo "<tr>";
        //echo "<td>{$id}</td>";
        
        echo "<td>{$aname}</td>";
        echo "<td>{$atype}</td>";
        
        echo "<td>{$aclass}</td>";
        echo "<td>{$def}</td>";
        echo "<td>{$light}</td>";
        echo "<td>{$intel}</td>";
        echo "<td>{$disc}</td>";
        echo "<td>{$str}</td>";
        echo "<td>";
        echo "<a href='update_armor.php?id={$vid}' class='button left'>Edit</a>";
        echo "<a href='delete-id={$vid}' class='button left'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    }
    
}


echo "</table>";
include_once 'paging_armor.php';
?>
<script>
$(document).on('click', '.delete-object', function(){
 
    var id = $(this).attr('delete-id');
    var q = confirm("Are you sure?");
 
    if (q == true){
 
        $.post('delete_product.php', {
            object_id: id
        }, function(data){
            location.reload();
        }).fail(function() {
            alert('Unable to delete.');
        });
 
    }
 
    return false;
});
</script>
<?php
include_once 'footer.php';
?>
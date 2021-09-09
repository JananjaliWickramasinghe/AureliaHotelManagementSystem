<?php
require_once("../connection.php");

if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM student WHERE nic like '" . $_POST["keyword"] . "%' ORDER BY nic LIMIT 0,6";

$result = mysqli_query($con, $query);
if(!empty($result)) {
?>
<ul id="country-list">

<?php
foreach($result as $country) {
?>
<li onClick="selectCountry('<?php echo $country["nic"]; ?>');"><?php echo $country["nic"]; ?>:<?php echo $country["fname"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>
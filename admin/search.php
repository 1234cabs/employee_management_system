<?php 

include '../connection/db.php';

$search = $_POST['search'];

$stmt = $conn->prepare("SELECT * FROM users WHERE fullname LIKE ?");
$like = "%$search%";
$stmt->bind_param("s", $like);
$stmt->execute();
$GetSearch = $stmt->get_result();

if($GetSearch->num_rows > 0):

while($row = $GetSearch->fetch_assoc()):


?>

<tr>
    <td><?= $row['id']; ?></td>
    <td><?= $row['fullname']; ?></td>
    <td><?= $row['email']; ?></td>
    <td><?= $row['contact']; ?></td>
    <td><?= $row['username']; ?></td>
    <td><?= $row['position']; ?></td>
    <td><?= $row['role']; ?></td>
    <td><?= $row['date']; ?></td>
</tr>

<?php endwhile;
else:
?>
<tr>
    <td colspan="9" class="text-center">No Users Matched your Search <span class="text-danger"><?= htmlspecialchars($search); ?></span> </td>
</tr>
<?php endif; ?>
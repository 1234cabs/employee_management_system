<?php
include '../connection/db.php';

$search = $_POST['search'] ?? '';

$stmt = $conn->prepare("SELECT * FROM users WHERE fullname LIKE ?");
$like = "%$search%";
$stmt->bind_param("s", $like);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0):

while($row = $result->fetch_assoc()):
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
    <td></td>
</tr>

<?php endwhile; 
else:
?>
    <tr>
        <td colspan="9" class="text-danger text-center">NO RECORDS FOUND!</td>
    </tr>
<?php endif; ?>





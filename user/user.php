<?php 
include '../connection/db.php';
include '../session/session.php';

requiredLogin();
requiredRole('employee');
// if(!isset($_SESSION['users']) || $_SESSION['role'] != 'employee'){
//     header("Location: ../login.php");
// }
?>
<?php include '../template/header.php'; ?>

<?php include '../template/navbar.php'; ?>

<div class="container mt-4">

    <?php include '../alert.php'; ?>

    <a href="profile.php" class="btn btn-success my-3">BACK</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped text-center">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>FULL NAME</th>
                    <th>EMAIL</th>
                    <th>CONTACT</th>
                    <th>USERNAME</th>
                    <th>POSITION</th>
                    <th>ROLE</th>
                    <th>DATE ADDED</th>

                </tr>
            </thead>
         
            <tbody>
                <?php 
                $stmt = $conn->prepare("SELECT * FROM users ORDER BY date DESC");
                $stmt->execute();
                $getResult = $stmt->get_result();

                if($getResult->num_rows > 0):

                while($row = $getResult->fetch_assoc()):
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
            </tbody>
            <?php endwhile;
            else:
            ?>
            <tr>
                <td colspan="9" class="text-danger text-center">NO RECORDS FOUND</td>
            </tr>
            <?php endif; ?>
        </table>

    </div>

</div>





<?php include '../template/footer.php'; ?>
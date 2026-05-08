<?php
include '../connection/db.php'; 
include '../session/session.php';

RequiredLogin();
RequiredRole('admin');
?>
<?php include '../template/header.php'; ?>

<?php include '../template/navbar.php'; ?>

<div class="container mt-4">

    <?php include '../alert.php'; ?>

    <?php include 'modal_add_employee.php'; ?>



    <button type="button" class="btn btn-success my-3" data-bs-toggle="modal" data-bs-target="#addEmployee">
        ADD EMPLOYEE
    </button>



    <div class="table-responsive">


        <input type="text" id="search" class="form-control mb-3" placeholder="Search employee...">

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
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody id="table-data">
                <?php
                $stmt = $conn->prepare("SELECT * FROM users");
                $stmt->execute();
                $GetUser = $stmt->get_result();

                if($GetUser->num_rows > 0):

                while ($row = $GetUser->fetch_array()):
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
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                            <a href="update.php?id=<?= $row['id']; ?>" class="btn btn-outline-info">UPDATE</a>
                            <form action="function/function.php" method="post">
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                <button type="submit" class="btn btn-outline-danger" name="delete" 
                                onclick="return confirm('Are You Sure Want to Delete this Record?')">DELETE</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                 <?php endwhile; 
                 else: ?>
                 <tr>
                    <td colspan="9" class="text-center text-danger">No Data Found</td>
                 </tr>
                 <?php endif; ?>
            </tbody>
        </table>


    </div>

</div>

<script>
    document.getElementById("search").addEventListener("keyup", function() {

        let value = this.value;

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "search.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (this.status == 200) {
                document.getElementById("table-data").innerHTML = this.responseText;
            }
        }

        xhr.send("search=" + value);
    });
</script>




<?php include '../template/footer.php'; ?>
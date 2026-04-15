<?php 
include '../connection/db.php'; 

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit;
}
?>
<?php include '../template/header.php'; ?>

<?php include '../template/navbar.php'; ?>

<div class="container mt-4">

    <?php include '../alert.php'; ?>

    <button type="button" class="btn btn-success my-3" data-bs-toggle="modal" data-bs-target="#addEmployee">
        ADD EMPLOYEE
    </button>

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
                    <th>ACTION</th>
                </tr>
            </thead>
            <?php 
            $stmt = $conn->prepare("SELECT * FROM users");
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()):
            ?>
            <tbody>
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
                       <a href="update.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm">UPDATE</a>
                        <!-- <button class="btn btn-sm btn-primary">Edit</button> -->
                         <form action="function/function.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">

                            <button type="submit" name="delete" class="btn btn-sm btn-danger" 
                            onclick="return confirm('Are You Sure You Want to delete This record?')">
                            DELETE</button>
                         </form>
                       
                    </td>
                </tr>
            </tbody>
            <?php endwhile; ?>

        </table>
    </div>

</div>



<!-- MODAL FOR CREATE DATA -->

<div class="modal fade" id="addEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ADD EMPLOYEE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="function/function.php" method="post">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="">Full Name</label>
                        <input type="text" name="fullname" id="" class="form-control" placeholder="Enter Fullname">
                    </div>

                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" id="" class="form-control" Placeholder="Enter Email">
                    </div>

                    <div class="mb-3">
                        <label for="">Contact</label>
                        <input type="number" name="contact" id="" class="form-control" Placeholder="Contact">
                    </div>

                    <div class="mb-3">
                        <label for="">User Name</label>
                        <input type="text" name="username" id="" class="form-control" placeholder="Enter Username">
                    </div>

                    <div class="mb-3">
                        <label for="">Position</label>
                        <select name="position" id="" class="form-control">
                            <option value="webdev">Web Developer</option>
                            <option value="frontdev">Front End Developer</option>
                            <option value="hrd">HRD</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="">Role</label>
                        <select name="role" id="" class="form-control">
                            <option value="admin">ADMIN</option>
                            <option value="employee">EMPLOYEE</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" name="password" id="" class="form-control" placeholder="Enter Password">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="create">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../template/footer.php'; ?>
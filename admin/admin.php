<?php
include '../connection/db.php';
include '../session/session.php';

// if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
//     header("Location: ../login.php");
// }

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

                $limit = 10;
                
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                if($page < 1) $page = 1;

                $start = ($page - 1 ) * $limit;

                $stmt = $conn->prepare("SELECT * FROM users ORDER BY date DESC LIMIT ?, ?");
                $stmt->bind_param("ii", $start,$limit);
                $stmt->execute();
                $GetAllUser = $stmt->get_result();

                if($GetAllUser->num_rows > 0):

                while($row = $GetAllUser->fetch_assoc()):
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
                            <a href="update.php?id=<?= $row['id']; ?>" class="btn btn-success btn-sm">UPDATE</a>
                            <form action="function/function.php" method="post">
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are You Sure You Want to Delete this Record?')">
                                    DELETE
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endwhile;
                
                else:
                ?>
                <tr>
                    <td colspan="9" class="text-danger text-center">NO RECORDS FOUND</td>
                </tr>
                <?php endif; ?>
            </tbody>


        </table>

        <!-- PAGINATION -->

        <?php 
            $totalQuery = $conn->prepare("SELECT COUNT(*) as total FROM users");
            $totalQuery->execute();
            $totalRow = $totalQuery->get_result()->fetch_assoc();

            $total = $totalRow['total'];
            $totalpages = ceil($total / $limit);
            
            ?>
         <?php if($total > $limit): ?>
        <nav aria-label="Page navigation example" style="margin-left: 81%;">
            
            <ul class="pagination">

                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page - 1; ?>">Previous</a>
                </li>

                <?php for($i = 1; $i <= $totalpages; $i++ ): ?>
                <li class="page-item <?= ($i == $page ) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                </li>
                <?php endfor; ?>

                <li class="page-item <?= ($page >= $totalpages) ? 'disabled' : '' ?>" >
                    <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>
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
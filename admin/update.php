<?php 
include '../connection/db.php';
include '../session/session.php';

requiredLogin();
requiredRole('admin');
// if(!isset($_SESSION['users']) || $_SESSION['role'] != 'admin'){
//     header("Location: ../login.php");
// }

$id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$GetData = $stmt->get_result()->fetch_assoc();
?>
<?php include '../template/header.php'; ?>

<?php include '../template/navbar.php'; ?>

<?php include '../alert.php'; ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="card custom-shadow p-4" style="width: 100%; max-width: 400px; border-radius: 15px;">

        <h3 class="text-center mb-4 text-danger">UPDATE FORM</h3>
        <div class="card" style="width: 22rem;">
            <!-- <img src="..." class="card-img-top" alt="..."> -->
            <div class="card-body">
                <form action="function/function.php" method="post">
                    <div class="mb-3">
                        <input type="hidden" name="id" value="<?= $GetData['id']; ?>">
                        <lable class="form-label">FULLNAME</lable>
                        <input type="text" name="fullname" id="" class="form-control" value="<?= $GetData['fullname']; ?>">
                    </div>
                    <div class="mb-3">
                        <lable class="form-label">EMAIL</lable>
                        <input type="email" name="email" id="" class="form-control" value="<?= $GetData['email']; ?>">
                    </div>

                    <div class="mb-3">
                        <lable class="form-label">CONTACT</lable>
                        <input type="number" name="contact" id="" class="form-control" value="<?= $GetData['contact']; ?>">
                    </div>

                    <div class="mb-3">
                        <lable class="form-label">USERNAME</lable>
                        <input type="text" name="username" id="" class="form-control" value="<?= $GetData['username']; ?>">
                    </div>

                    <!-- <div class="mb-3">
                        <lable class="form-label">POSITION</lable>
                        <select name="position" id="" class="form-control">
                            <option value="webdev">Web Developer</option>
                            <option value="frontdev">Front End Developer</option>
                            <option value="hrd">HRD</option>
                        </select>
                    </div> -->


                    <div class="mb-3">
                    <label for="">POSITION</label>
                    <select name="position" id="" class="form-control">
                        <option value="webdev" <?=  ($GetData['position'] == 'webdev') ? 'selected' : '' ?>>Web Developer</option>
                        <option value="frontdev" <?= ($GetData['position'] == 'frontdev') ? 'selected' : '' ?>>Front End Developer</option>
                        <option value="hrd" <?= ($GetData['position'] == 'hrd') ? 'selected' : '' ?>>HRD</option>
                    </select>
                    </div>


                    <div class="modal-footer">
                        <a href="admin.php" class="btn btn-secondary" style="margin-right: 4px;">CANCEL</a>
                        <button type="submit" class="btn btn-primary" name="update">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>

<?php include '../template/footer.php'; ?>
    <?php 
    // include '../connection/db.php';

    $id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $getUser = $stmt->get_result();
    $user = $getUser->fetch_assoc();   

    ?>
    
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a href="#" class="navbar-brand text-white">LOGO</a>

            <button type="button" class="btn btn-light" style="margin-left: 70%;" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                View Profile
            </button>
        </div>

    </nav>

     <!-- PROFILE MODAL -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog custom-modal">
            <div class="modal-content custom">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-success" id="exampleModalLabel">My Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <tr>
                        <th><b>FULLNAME:</b></th>
                    </tr>
                    <tr>
                        <th >  <?= $user['fullname']; ?></th>
                    </tr>
                    <hr>

                      <tr>
                        <th><b>EMAIL:</b></th>
                    </tr>
                    <tr>
                        <th><?= $user['email']; ?></th>
                    </tr>
                    <hr>

                      <tr>
                        <th><b>CONTACT:</b></th>
                    </tr>
                    <tr>
                        <th><?= $user['contact']; ?></th>
                    </tr>
                    <hr>

                        <tr>
                        <th><b>POSITION:</b></th>
                    </tr>
                    <tr>
                        <th><?= $user['position']; ?></th>
                    </tr>
                    <hr>

                        <tr>
                        <th><b>ROLE:</b></th>
                    </tr>
                    <tr>
                        <th><?= $user['role']; ?></th>
                    </tr>
                    <hr>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="../logout.php" class="btn btn-warning">LogOut</a>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
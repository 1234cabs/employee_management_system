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

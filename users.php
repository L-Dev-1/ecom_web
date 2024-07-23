<?php
session_start();
include('Include/sidebar.php');
include('Include/header.php');
require_once('Config/dbcon.php');
$query = "Select u.id, u.username, u.password, r.role from tbl_users as u inner join tbl_roles as r on u.role = r.id";
$result = mysqli_query($conn, $query);

?>

<div class="container">
  <div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <!-- <h3 class="fw-bold mb-3">Dashboard</h3> -->
        <!-- <h6 class="op-7 mb-2">Free Bootstrap 5 Admin Dashboard</h6> -->
      </div>
      <!-- <div class="ms-md-auto py-2 py-md-0">
              <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
              <a href="#" class="btn btn-primary btn-round">Add Customer</a>
            </div> -->
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <div style="color: blue;" class="card-title">Users Table</div>
          </div>
          <div class="card-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Username</th>
                  <th scope="col">Password</th>
                  <th scope="col">Role</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Assuming $result is the result from your database query
                while ($row = mysqli_fetch_assoc($result)) {
                  $id = $row['id'];
                  $username = $row['username'];
                  $password = $row['password'];
                  $role = $row['role'];
                ?>
                  <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $username ?></td>
                    <td><?php echo $password ?></td>
                    <td><?php echo $role ?></td>

                    <td>
                      <!-- Button trigger modal -->
                      <div class="d-flex">
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $id; ?>">
                          <i class="fas fa-user-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $id; ?>">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </div>

                      <!-- Edit Modal -->
                      <div class="modal fade" id="editModal<?php echo $id; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $id; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="editModalLabel<?php echo $id; ?>">Edit User</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form method="post" action="conn.php">
                                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                <!-- Username input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                  <label class="form-label" for="username">Username</label>
                                  <input type="text" name="username" class="form-control" value="<?php echo $username ?>" required />
                                </div>

                                <!-- Password input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                  <label class="form-label" for="password">Password</label>
                                  <input type="text" name="password" class="form-control" value="<?php echo $password ?>" required />
                                </div>

                                <!-- Role -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                  <label class="form-label" for="role">Role</label>
                                  <select name="role" class="form-select" aria-label="Select Role">
                                    <option selected>----- Select a Role -----</option>
                                    <option value="1" <?php echo ($role == "Admin") ? 'selected' : ''; ?>>Admin</option>
                                    <option value="2" <?php echo ($role == "User") ? 'selected' : ''; ?>>User</option>
                                    <option value="3" <?php echo ($role == "Editor") ? 'selected' : ''; ?>>Editor</option>
                                  </select>
                                </div>
                                <!-- Submit button -->
                                <button data-mdb-ripple-init type="submit" name="update_user" class="btn btn-primary btn-block mb-4">Update</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Delete Modal -->
                      <div class="modal fade" id="deleteModal<?php echo $id; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $id; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="deleteModalLabel<?php echo $id; ?>">Delete Confirmation</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Are you sure you want to delete user <strong><?php echo $username; ?></strong>?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                              <form method="post" action="conn.php">
                                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                <button type="submit" name="delete_user" class="btn btn-danger">Delete</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <div style="color: blue;" class="card-title">Insert Users </div>
          </div>
          <div class="card-body">
            <form method="post" action="conn.php">
              <!-- Name input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form5Example1">Username</label>
                <input type="text" name="username" id="form5Example1" class="form-control" required />
              </div>

              <!-- Email input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form5Example2">Password</label>
                <input type="password" name="password" id="form5Example2" class="form-control" required />

              </div>
              <!-- Role -->
              <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form5Example2">Role</label>
                <select name="role" class="form-select" aria-label="Default select example">
                  <option selected>----- Select a Role -----</option>
                  <option value="1">Admin</option>
                  <option value="2">User</option>
                  <option value="3">Editor</option>
                </select>
              </div>


              <!-- Submit button -->
              <button data-mdb-ripple-init type="submit" name="insert_user" class="btn btn-primary btn-block mb-4">Insert</button>
            </form>
          </div>
        </div>


      </div>

    </div>


  </div>
</div>

<?php
include('Include/footer.php');
?>
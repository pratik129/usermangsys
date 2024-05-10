<?php
require_once('connetion.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
    <style>
        .InlineBlock {
            display: inline-block;
        }
    </style>


</head>

<body>
    <div class="container mt-5">
        <h2>User Management System</h2>
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addUserModal">Add User</button>
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM users";
                $result = mysqli_query($con, $query);

                while ($user = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $user['id'] . "</td>";
                    echo "<td>" . $user['name'] . "</td>";
                    echo "<td>" . $user['email'] . "</td>";
                    echo "<td>" . $user['mobile_number'] . "</td>";
                    echo "<td>" . $user['gender'] . "</td>";
                    echo "<td>" . $user['dob'] . "</td>";
                    echo "<td>" . $user['age'] . "</td>";
                    echo "<td>
                    <button data-id='" . $user['id'] . "'class='btn btn-sm btn-primary editUserBtn'>Edit</button>
                    <button data-id='" . $user['id'] . "'class='btn btn-sm btn-danger deleteUserBtn'>Delete</button>
                  </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

    </div>

    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- User entry form -->
                    <form id="userForm">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile Number:</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" maxlength="10" pattern="[0-9]{10}" required>
                        </div>
                        <div class="form-group">
                            <label>Gender:</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="male" name="gender" value="Male" required>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="female" name="gender" value="Female" required>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="Other" name="gender" value="Other" required>
                                <label class="form-check-label" for="Other">Other</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth:</label>
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div>
                        <div class="form-group">
                            <label for="age">Age:</label>
                            <select class="form-control" id="age" name="age" required>
                                <?php for ($i = 20; $i <= 100; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- Address fields -->
                        <hr>
                        <div id="addressFields">
                            <div class="form-group InlineBlock">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" name="addresses[]">
                            </div>
                            <div class="form-group InlineBlock">
                                <label for="city">City:</label>
                                <input type="text" class="form-control" name="cities[]">
                            </div>
                            <div class="form-group InlineBlock">
                                <label for="state">State:</label>
                                <input type="text" class="form-control" name="states[]">
                            </div>
                            <div class="form-group InlineBlock">
                                <label for="pincode">Pincode:</label>
                                <input type="text" class="form-control InlineBlock" name="pincodes[]">
                            </div>
                        </div>
                        <button type="button" id="addAddressBtn" class="btn btn-secondary">Add Address</button>
                        <hr>
                        <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $('#addAddressBtn').click(function() {
                $('#addressFields').append(`
                <hr>
                <div class="form-group InlineBlock">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" name="addresses[]">
                            </div>
                            <div class="form-group InlineBlock">
                                <label for="city">City:</label>
                                <input type="text" class="form-control" name="cities[]">
                            </div>
                            <div class="form-group InlineBlock">
                                <label for="state">State:</label>
                                <input type="text" class="form-control" name="states[]">
                            </div>
                            <div class="form-group InlineBlock">
                                <label for="pincode">Pincode:</label>
                                <input type="text" class="form-control InlineBlock" name="pincodes[]">
                            </div>
        `);
            });
            $(".deleteUserBtn").on('click',function() {
                if (confirm("Are you sure you want to delete this user?")) {
                    var userId = $(this).data("id");
                    $.ajax({
                        url: "delete_user.php",
                        type: "POST",
                        data: {
                            id: userId
                        },
                        success: function(response) {
                            alert("User deleted successfully");
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            alert("Error deleting user: " + error);
                        }
                    });
                }
            });

            $('#userForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission
                var isValid = $('#userForm')[0].checkValidity();
                if (isValid) {
                    $.ajax({
                        url: 'add_user.php',
                        method: 'POST',
                        data: $('#userForm').serializeArray(),
                        success: function(response) {
                            alert(response);
                            console.log(response);
                            $('#addUserModal').modal('hide'); // Hide modal on successful submission
                            location.reload(); // Reload the page
                        },
                        error: function(xhr, status, error) {
                            alert('Error adding user: ' + error);
                        }
                    });
                } else {
                    $('#userForm').addClass('was-validated'); // Add validation styles
                }
            });
        });
    </script>

</body>

</html>
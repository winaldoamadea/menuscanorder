<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenuScanOrder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        @media (max-width: 576px) {
            .btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
                line-height: 1.5;
            }

            .btn-primary {
                font-size: 0.75rem; /* Adjust as needed */
            }
        }

        .status-column {
            width: 80px; /* Adjust as needed */
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-black">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="<?= base_url('images/MscBlack.png'); ?>" alt="MenuScanOrder Icon" height="30" class="me-2">
                MenuScanOrder
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('')?>" >Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url("logout"); ?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>User Subscription</h2>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
                </div>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>User ID</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th class="status-column">Created_At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <!-- Displaying each user info -->
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= esc($user['id']) ?></td>
                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['name']) ?></td>
                    <td><?= esc($user['status']) ?></td>
                    <td><?= esc($user['created_at']) ?></td>
                    <td>
                        <button class="btn btn-sm btn-primary me-2 mb-2 view-user-btn" data-bs-toggle="modal" data-bs-target="#viewUserModal" data-user-id="<?= $user['id'] ?>" data-user-name="<?= $user['username'] ?>" data-user-status="<?= $user['status'] ?>" data-user-created="<?= $user['created_at'] ?>">View</button>
                        <button class="btn btn-sm btn-dark me-2 mb-2 edit-user-btn" data-bs-toggle="modal" data-bs-target="#editUserModal" data-user-id="<?= $user['id'] ?>" data-user-name="<?= $user['name'] ?>" data-user-status="<?= $user['status'] ?>" data-user-created="<?= $user['created_at'] ?>">Edit</button>
                        <!-- Check if user active -->
                        <?php if ($user['status'] === 'active'): ?>
                            <button class="btn btn-sm btn-warning me-2 mb-2 make-inactive-btn" data-user-status="<?= $user['status'] ?>" data-user-id="<?= $user['id'] ?>">Make Inactive</button>
                        <?php else: ?>
                            <button class="btn btn-sm btn-success me-2 mb-2 make-active-btn" data-user-status="<?= $user['status'] ?>" data-user-id="<?= $user['id'] ?>">Make Active</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<!-- View User Modal -->
<div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewUserModalLabel">View User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="viewUserId" class="form-label">User ID</label>
                        <p id="viewUserId" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label for="viewUserName" class="form-label">Username</label>
                        <input type="text" class="form-control" id="viewUserName" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="viewUserStatus" class="form-label">Status</label>
                        <input type="text" class="form-control" id="viewUserStatus" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="viewUserCreated" class="form-label">Created_At</label>
                        <textarea class="form-control" id="viewUserCreated" rows="3" disabled></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status" required>
                    </div>
                    <!-- Add other input fields for user details as needed -->
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="editUserId" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUsername" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editUsername" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUserStatus" class="form-label">Status</label>
                        <select class="form-select" id="editUserStatus">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for modals and form submissions -->
<script>
    // JavaScript code for view user modal
    document.addEventListener('DOMContentLoaded', function() {
        const viewUserButtons = document.querySelectorAll('.view-user-btn');

        viewUserButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = button.getAttribute('data-user-id');
                const username = button.getAttribute('data-user-name');
                const status = button.getAttribute('data-user-status');
                const createdAt = button.getAttribute('data-user-created');

                document.getElementById('viewUserId').textContent = userId;
                document.getElementById('viewUserName').value = username;
                document.getElementById('viewUserStatus').value = status;
                document.getElementById('viewUserCreated').value = createdAt;

                $('#viewUserModal').modal('show');
            });
        });
    });
</script>

<script>
// JavaScript code for toggle status buttons
document.addEventListener('DOMContentLoaded', function() {
    const toggleStatusButtons = document.querySelectorAll('.make-inactive-btn, .make-active-btn');
    toggleStatusButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = button.getAttribute('data-user-id');
            const currentStatus = button.getAttribute('data-user-status');
            const newStatus = currentStatus === 'active' ? 'inactive' : 'active'; // Toggle between active and inactive
            
            const data = { status: newStatus }; // Create an object to hold the data
            fetch('<?= base_url("user/") ?>' + userId, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                location.reload();
                // Optionally, update UI or handle response as needed
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
</script>


<script>
    // JavaScript code for add user form submission
    document.addEventListener('DOMContentLoaded', function() {
    const addUserForm = document.getElementById('addUserForm');
    addUserForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission behavior

        const email = document.getElementById('email').value;
        const status = document.getElementById('status').value;
        // Get other input field values as needed
        const data = {
            username: email,
            status: status
            // Add other user details here
        };

        fetch('<?= base_url("user"); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('User added successfully:', data);
            // Optionally, you can close the modal or update the UI here
            $('#addUserModal').modal('hide');
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle errors or display error messages here
        });
    });
});
</script>

<script>
    // JavaScript code for edit user modal and form submission
    document.addEventListener('DOMContentLoaded', function() {
        const editUserButtons = document.querySelectorAll('.edit-user-btn');

        editUserButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = button.getAttribute('data-user-id');
                const username = button.getAttribute('data-user-name'); // Changed from 'data-user-status' to 'data-user-name'
                const status = button.getAttribute('data-user-status'); // Get the status attribute

                document.getElementById('editUserId').value = userId;
                document.getElementById('editUsername').value = username;
                document.getElementById('editUserStatus').value = status; // Set the status value
                
                $('#editUserModal').modal('show');
            });
        });

        const editUserForm = document.getElementById('editUserForm');

        editUserForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const userId = document.getElementById('editUserId').value;
            const username = document.getElementById('editUsername').value;
            const status = document.getElementById('editUserStatus').value;

            console.log(userId,username,status);
            const data = {
                name: username,
                status: status
            };

            fetch('<?= base_url("user/") ?>' + userId, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('User updated successfully:', data);
                // Optionally, you can close the modal or update the UI here
                $('#editUserModal').modal('hide');
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle errors or display error messages here
            });
        });
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-F6Za7jjj2jaDqKtKDUpV6z+V62aCDpVVXFqfF8ZbVoPxTXEY4gUgXjPWx8uHHp3s" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php 
include('../connection.php'); 

if (isset($_GET['message'])) {
  echo htmlspecialchars($_GET['message']);
}

// Query to fetch all member records
$sql = "SELECT * FROM users";
$result = $connection->query($sql);
// Check if there are results
if ($result->num_rows > 0) {
    $members = [];

    while ($row = $result->fetch_assoc()) {
        $members[] = $row; // Store member records in an array
    }
} else {
    // No members found
    $members = [];
}

// Query to fetch all member records
$sql = "SELECT * FROM contacts";
$result = $connection->query($sql);
// Check if there are results
if ($result->num_rows > 0) {
    $message = [];

    while ($row = $result->fetch_assoc()) {
        $message[] = $row; // Store member records in an array
    }
} else {
    // No members found
    $message = [];
}

?>
               
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Dashboard</title>
    <style>
      .custom-delete-btn {
    padding: 5px 10px;
    border: 1px solid #dc3545;
    background-color: #dc3545;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.custom-edit-btn {
    padding: 5px 10px;
    border: 1px solid #28a745;
    background-color: #28a745;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.custom-delete-btn:hover {
    background-color: #c82333;
}
.custom-edit-btn:hover {
    background-color: #28a745;
}
    </style>
   
  </head>
  <body>
    
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
          aria-controls="offcanvasExample"
        >
         
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
           <a
          class="navbar-brand d-flex ms-auto my-3 my-lg-0  text-uppercase fw-bold"
          href="#"
          >Admin Dashboard</a>
          </div>
      </div>
    </nav>
    <div
      class="offcanvas offcanvas-start sidebar-nav bg-dark"
      tabindex="-1"
      id="sidebar"
    >
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3">
                CORE
              </div>
            </li>
            <li>
              <a href="dashboard.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                Interface
              </div>
            </li>
            <li>
              <a href="#" class="nav-link px-3 active">
                <span class="me-2"><i class="bi bi-book-fill"></i></span>
                <span>Messages</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  <!-- Mian content -->
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h4>Dashboard</h4>
          </div>
        </div>
        <!-- Card -->
        <div class="row">
          <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white h-100">
            <div class="card-body py-5">
                <h5 class="card-title">Number of Admins</h5>
                <h3 class="card-text"><?php include('dashboard_procedures.php'); 
                echo $totalAdmin; ?></h3>
              </div>
              <div class="card-footer d-flex">
                <!-- View Details -->
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>

          <div class="col-md-3 mb-3">
            <div class="card bg-success text-white h-100">
              <div class="card-body py-5">
                <h5 class="card-title">Total Users</h5>
                <h3 class="card-text"><?php include('dashboard_procedures.php'); 
                echo $totalPeople; ?></h3>
              </div>
              <div class="card-footer d-flex">
              
                <!-- View Details -->
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>

          <div class="col-md-3 mb-3">
            <div class="card bg-success text-white h-100">
              <div class="card-body py-5">
                <h5 class="card-title">Number of Messages</h5>
                <h3 class="card-text"><?php include('dashboard_procedures.php'); 
                echo $messages; ?></h3>
              </div>
              <div class="card-footer d-flex">
                <!-- View Details -->
                <span class="ms-auto">
                  <i class="bi bi-chevron-right"></i>
                </span>
              </div>
            </div>
          </div>


        <!-- Data Table -->
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
             

                <span><i class="bi bi-table me-2"></i></span> Users Data
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table
                    id="example"
                    class="table table-striped data-table"
                    style="width: 100%"
                  >
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date & Time</th>
                        <th>Action</th>
                      </tr>
                    </thead>   
                    <tbody>   
<?php if (!empty($message)): ?>
    <?php foreach ($message as $row): ?>
        <tr><td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['message']); ?></td>
            <td><?php echo htmlspecialchars($row['submit_time']); ?></td>
            <td> 
                <form action="delete.php" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                    
                    <button type="button" class="btn btn-danger deleteBtn" data-id="<?php echo $row['id']; ?>">Delete</button>

                </form>
                <form  style="display:inline;">
                    <!-- <input type="hidden" name="editUserModal" value="<?php echo htmlspecialchars($row['id']); ?>"> -->
                    <button type="button" class="btn btn-success editBtn" 
    data-id="<?php echo htmlspecialchars($row['id']); ?>"
    data-username="<?php echo htmlspecialchars($row['name']); ?>" 
    data-first_name="<?php echo htmlspecialchars($row['email']); ?>"
    data-last_name="<?php echo htmlspecialchars($row['message']); ?>" 
    data-date_of_birth="<?php echo htmlspecialchars($row['submit_time']); ?>">
    Edit
</button>



                </form>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr><td colspan="5">No data found</td></tr>
<?php endif; ?>
</tbody>



                   
  

                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this record? This action cannot be undone.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <!-- The form action and hidden inputs will be dynamically updated by JavaScript -->
        <form id="deleteForm" action="delete-message.php" method="post">
          <input type="hidden" name="id" value="">
          <input type="hidden" name="confirm_delete" value="yes">
          <button type="submit" class="btn btn-danger">Yes, delete it!</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap Modal for Editing Message Data -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Edit Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="update_message.php" method="post" id="editForm">
          <input type="hidden" name="id" id="edit-id">
          <div class="mb-3">
            <label for="edit-username" class="form-label">Username</label>
            <input type="text" class="form-control" id="edit-username" name="name" required>
          </div>
          <div class="mb-3">
            <label for="edit-first-name" class="form-label">Email</label>
            <input type="text" class="form-control" id="edit-first-name" name="email" required>
          </div>
          <div class="mb-3">
            <label for="edit-last-name" class="form-label">Message</label>
            <input type="text" class="form-control" id="edit-last-name" name="message" required>
          </div>
          <div class="mb-3">
            <label for="edit-date-of-birth" class="form-label"></label>
            <input type="text" class="form-control" id="edit-date-of-birth" name="submit_time" required>
          </div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>

        </form>
      </div>
    </div>
  </div>
</div>

<script>
// When the document is ready
document.addEventListener("DOMContentLoaded", function() {
  // Find all delete buttons and set up click event listeners
  document.querySelectorAll('.deleteBtn').forEach(button => {
    button.addEventListener('click', function() {
      const recordId = this.getAttribute('data-id'); // Get the record ID from the button
      // Set the record ID in the modal's form
      document.querySelector('#deleteForm input[name="id"]').value = recordId;
      // Show the modal
      var deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
      deleteModal.show();
    });
  });
});

document.addEventListener("DOMContentLoaded", function() {
    // Delete button functionality is already set up here

    // Set up click event listeners for Edit buttons
    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function() {
            // Retrieve data attributes from the button
            var id = this.getAttribute('data-id');
            var username = this.getAttribute('data-username');
            var firstName = this.getAttribute('data-first_name');
            var lastName = this.getAttribute('data-last_name');
            var dateOfBirth = this.getAttribute('data-date_of_birth');
            
            // Populate the form in the modal with this data
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-username').value = username;
            document.getElementById('edit-first-name').value = firstName;
            document.getElementById('edit-last-name').value = lastName;
            document.getElementById('edit-date-of-birth').value = dateOfBirth;

            // Show the modal
            var editModal = new bootstrap.Modal(document.getElementById('editUserModal'));
            editModal.show();
        });
    });

    // Optional: Handle the form submission within the modal for updating user data
    // document.getElementById('editForm').addEventListener('submit', function(e) {
    //     e.preventDefault();
        
    //     // Here, implement the AJAX call to send the form data to a server-side script (e.g., 'update_user.php')
    //     // This script would process the data, update the user record in the database, and return a response
    // });
});

</script>

    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>
  </body>
</html>

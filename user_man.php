<?php
session_start();
if (!isset($_SESSION['reg'])) {
    header("Location: login.php"); // Redirect to login page if session is not active
    exit();
}
?>
<?php
require 'conn.php';

$sql = "SELECT * FROM reg";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User_Managment</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container-fluid">
    <div class="table-responsive">
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col">User Name</th>
            <th scope="col">Organization</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Email Address</th>
            <th scope="col">Access Limit</th>
            <th scope="col">Position</th>
            <th scope="col" style="width: 50px">Delete User</th>
            <th scope="col">Edit User Info</th>
          </tr>
        </thead>
        <tbody>
        	<?php
        	if ($result->num_rows>0) {
        			while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['Full Name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Organization']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Phone_Number']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Offical_Email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Access_Limit']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Enternal_User']) . "</td>";
                            echo "<td><a href='delete.php?id=" . $row['ID'] . "' class='btn btn-info'>Delete</a></td>";
                            echo "<td><a href='edit_user.php?id=" . $row['ID'] . "' class='btn btn-light'>Edit</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>No data found</td></tr>";
                    }
                    ?>
        </tbody>
      </table>
    </div>
  </div>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<style> 
    table {
      border-collapse: collapse;

    }
    th, td {
      text-align: center;
      vertical-align: middle;
    }
    th{
    	font-size: 12px;
    }
    td{
    	font-size: 10px;
    }
    td .btn{
      width: 80px;
      font-size: 10px;
      color: black;
    }
    td .btn:hover{
      width: 82px;
      color: black;

    }
</style>
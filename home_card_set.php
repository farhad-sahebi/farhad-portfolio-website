<?php
session_start();
if (!isset($_SESSION['reg'])) {
    header("Location: login.php"); // Redirect to login page if session is not active
    exit();
}
?>
<?php
include 'conn.php';
$sql = "SELECT * FROM home_card";
		$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="table-responsive">
      <table class="table">
        <thead class="thead-dark" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Text</th>
            <th scope="col" style="width: 50px">Delete Card</th>
            <th scope="col">Edit Card</th>
          </tr>
        </thead>
        <tbody>
		<?php
        	if ($result->num_rows>0) {
        			while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['Title']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['Text']) . "</td>";
                            echo "<td><a href='delete_home_card.php?id=" . $row['ID'] . "' class='btn btn-info'>Delete</a></td>";
                            echo "<td><a href='edit_home_card.php?id=" . $row['ID'] . "' class='btn btn-light'>Edit</a></td>";
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
      background-color: white;

    }
    th, td {
      text-align: center;
      vertical-align: middle;
    }
    th{
    	font-size: 12px;
    	background-color: white;
    }
    td{
    	font-size: 15px;
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
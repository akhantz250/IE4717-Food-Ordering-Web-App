<?php 
    include "./inc/admin_table.php";
    session_start();
    if (!isset($_SESSION["isAdmin"])) {
        header("Location: ./forbidden.php");
        die();
    }

    if(is_array($fetchData)){  
        foreach($fetchData as $data){
                $id = $data['OrderID'];
                  if(isset($_POST[$id]) && !empty($_POST["input"])) {
                      $input = $_POST['input'];
                      $query = "UPDATE orderprogress SET progress = '$input' WHERE OrderID = $id ";
                      mysqli_query($conn, $query);
                          if ($input == 2){
                              $query = "UPDATE orderprogress SET PreparationStart=CURRENT_TIMESTAMP() WHERE OrderID = '$id' ";
                      mysqli_query($conn, $query);}
                      else if ($input == 3){
                      $query = "UPDATE orderprogress SET DeliveryStart=CURRENT_TIMESTAMP() WHERE OrderID ='$id' ";
                      mysqli_query($conn, $query);}
                      else if ($input == 4){
                      $query = "UPDATE orderprogress SET DateReceived=CURRENT_TIMESTAMP() WHERE OrderID ='$id' ";
                      mysqli_query($conn, $query);
                      }		
                      header("Refresh:0");
                  }
              }
        }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/stylesheets/style.css">
    <link rel="shortcut icon" href="./src/img/leaf.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Primavera</title>
</head>

<body>
    <header class="header">
        <a href="index.php"><p id="site-name">PRIMAVERA</p></a>
        <nav class="nav-bar">
            <ul>
                <li><a href="#">Menu</a></li>
                <li><a href="#">Sales</a></li>
                <li><a href="ordermanagement.php">Orders</a></li>
                <li>
                <a href="adminlogout.php">
                    <span style="display: flex; align-items:center" class="material-symbols-outlined icon">
                            logout
                    </span>
                </a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="main-section" style="padding-top: 80px;">
    <table border='1' style="width:80%; margin:auto; border-collapse: collapse; text-align: center; ">
			<thead>
				<tr>
					<th>Order ID</th>
					<th>Items</th>
					<th>Progress</th>
					<th>Update</th>

			</thead>
			<tbody>
                    <?php if (is_array($fetchData)): ?>
					<?php foreach ($fetchData as $data): ?>
						<tr>

							<td><?php echo $data['OrderID'] ?? ''; ?></td>
							<td><?php
								$sql = "SELECT orderitems.OrderID, menu.Name, orderitems.Quantity FROM orderitems INNER JOIN menu
								ON orderitems.MenuID=menu.MenuID";
								$result = $conn->query($sql);

								while ($row = $result->fetch_assoc())
									if ($data['OrderID'] == $row['OrderID']) {
										echo $row['Name'] . " x " . $row['Quantity'] . "<br />";
									}
								?></td>

							<td><?php
								if ($data['Progress'] == 1) {
									echo 'New';
								} else if ($data['Progress'] == 2) {
									echo 'Preparing';
								} else if ($data['Progress'] == 3) {
									echo 'Delivering';
								} else if ($data['Progress'] == 4) {
									echo 'Completed';
								} else {
									echo 'error';
								}
								?></td>

							<td>
								<form method="post" action="ordermanagement.php">
									<select list name="input">
										<option value="" disabled selected></option>
										<option value=2>Preparing</option>
										<option value=3>Delivery</option>
										<option value=4>Completed</option>
										<label><input type=submit value="Update" name="<?php echo $data['OrderID'] ?? ''; ?>"></label>
								</form>
							</td>
						</tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
		</table>
    </main>
</body>
<footer>
        Project for IE4717 by Zaw and Zion
    </footer>
</body>
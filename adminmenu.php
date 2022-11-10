<?php 
    session_start();
    if (!isset($_SESSION["isAdmin"])) {
        header("Location: ./forbidden.php");
        die();
    }
    include "./inc/db_connection.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST["menuID"]) && isset($_POST["price"]) && isset($_POST["availability"])) {
            $menuID = $_POST["menuID"];
            $price = $_POST["price"];
            $availability = $_POST["availability"];
            $query = "UPDATE menu SET Price='$price',Availability='$availability' WHERE MenuID = '$menuID'";
            $conn -> query($query);
        }
    }
    include "./inc/db_connection.php";
    $rows;
    $query = "SELECT MenuID, Name, Price, Category, ImageURL, Availability FROM menu";
    $result = $conn -> query($query);
    if ($result -> num_rows > 0) {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $rows = false;
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
                <li><a href="./adminmenu.php">Menu</a></li>
                <li><a href="#">Sales</a></li>
                <li><a href="#">Feedback</a></li>
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
    <main class="main-section">
    <h1 class="section-header">Update Menu</h1>
    <table border='1' style="width:80%; margin:auto;border-collapse: collapse;" class="edit-order-table">
			<thead>
				<tr>
					<th>Menu Item</th>
					<th>Price</th>
					<th>Availability</th>
					<th>Update</th>
			</thead>
			<tbody>
                <?php if (is_array($rows)) : ?>
                    <?php foreach($rows as $row) : ?>
                        <?php $available = ($row["Availability"] == 'yes')? true : false; ?>
                        <tr>
                            <td>
                                <div class="flex-row">
                                <img src="./src/img/fooditems/<?php echo $row["ImageURL"]; ?>.png" alt="" style="width: 64px; height:64px; display: block;">                     
                                <div style="margin-left: 16px;">
                                    <div><?php echo $row["Name"]; ?></div>
                                    <p style="opacity: 0.4; margin-top: 8px"><?php echo ucfirst($row["Category"]); ?></p>
                                </div>
                                </div>
                            </td>
                            <form action="./adminmenu.php" method="post" class="menu-form">
                                <td><input type="text" value="<?php echo $row["Price"]; ?>" name="price"></td>
                                <td><select name="availability">
                                    <option value="yes" <?php if ($available) echo "selected='selected'"?>>Yes</option>
                                    <option value="no" <?php if (!$available) echo "selected='selected'"?>>No</option>
                                </select></td>
                                <td>
                                 <button type="submit" value="<?php echo $row["MenuID"]; ?>" name="menuID">Update</button>
                                </td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
		</table>
    </main>
    <script>
        const formList = document.querySelectorAll(".menu-form");
        for (const form of formList) {
            form.addEventListener("submit", (e) => {
                const price = e.target.elements[0].value;
                const availability = e.target.elements[1].value;
                const menuID = e.target.elements[2].value;
                // alert(`${price} ${availability} ${menuID}`);
                if (isNaN(+price)) {
                    alert("Invalid Price");
                    e.preventDefault();
                }
            })
        }
    </script>
</body>
<footer>
        Project for IE4717 by Zaw and Zion
    </footer>
</body>
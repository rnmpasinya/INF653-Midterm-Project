 elseif ($sorting === 'year') {
    usort($filteredVehicles, 'compareYear');
}

// Handle form submission to remove vehicle
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_vehicle'])) {
    $vehicle_id = $_POST['vehicle_id'];

    try {
        // Prepare and execute the DELETE query
        $query = "DELETE FROM vehicle_inventory WHERE vehicle_id = :vehicle_id";
        $statement = $conn->prepare($query);
        $statement->bindParam(':vehicle_id', $vehicle_id);
        $statement->execute();

        // Redirect back to the same page after removing the vehicle
        header("Location: admin_inventory.php");
        exit();
    } catch (PDOException $e) {
        // Handle any errors if the DELETE query fails
        echo "<div style='color: red;'><strong>Error:</strong> An error occurred while removing the vehicle. Please try again. <br>";
        echo "Error Message: " . $e->getMessage() . "</div><br>";
    }
}

?>

<!DOCTYPE html>
</head>
<body>
    <div class="container">
        <h1>Admin Page with Selection Classes</h1>
        <h2>Zippy Admin</h2>
        <h1>Zippy Admin</h1>

        <!-- Navigation links -->
        <ul>

                        <td><?php echo $vehicle['vehicle_class']; ?></td>
                        <td>$<?php echo $vehicle['vehicle_price']; ?></td>
                        <td>
                            <form action="remove_vehicle.php" method="post">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="vehicle_id" value="<?php echo $vehicle['vehicle_id']; ?>">
                                <button type="submit">Remove</button>
                                <button type="submit" name="remove_vehicle">Remove</button>
                            </form>
                        </td>
                    </tr>


        <!-- Additional links -->
        <p><a href="#">View Full Vehicle List</a></p>
        <p><a href="#">Click here to add a vehicle</a></p>
        <p><a href="../Form/add_vehicle_form.php">Click here to add a vehicle</a></p>
        <p><a href="#">Form/Edit Vehicle Makes</a></p>
        <p><a href="#">Form/Edit Vehicle Types</a></p>
        <p><a href="#">Form/Edit Vehicle Classes</a></p>

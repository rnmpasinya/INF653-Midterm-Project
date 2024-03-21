<!-- ../form/add_vehicle.php -->
<!-- ../form/add_vehicle_form.php -->
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection and necessary functions
include_once('../model/database.php');
include_once('../model/class_db.php');

// Function to get all classes from the vehicle_class table
function getAllClasses($conn) {
    try {
        $query = "SELECT DISTINCT vehicle_class FROM vehicle_inventory";
        $statement = $conn->prepare($query);
        $statement->execute();
        $classes = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $classes;
    } catch (PDOException $e) {
        throw new PDOException("Error fetching classes: " . $e->getMessage());
    }
}

// Function to get all makes from the vehicle_inventory table
function getAllMakes($conn) {
    try {
        $query = "SELECT DISTINCT vehicle_make FROM vehicle_inventory";
        $statement = $conn->prepare($query);
        $statement->execute();
        $makes = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $makes;
    } catch (PDOException $e) {
        throw new PDOException("Error fetching makes: " . $e->getMessage());
    }
}

// Function to get all types from the vehicle_inventory table
function getAllTypes($conn) {
    try {
        $query = "SELECT DISTINCT vehicle_type FROM vehicle_inventory";
        $statement = $conn->prepare($query);
        $statement->execute();
        $types = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $types;
    } catch (PDOException $e) {
        throw new PDOException("Error fetching types: " . $e->getMessage());
    }
}

// Fetch all classes, makes, and types and sort them alphabetically
$classes = [];
$makes = [];
$types = [];

try {
    $classes = getAllClasses($GLOBALS['conn']);
    $makes = getAllMakes($GLOBALS['conn']);
    $types = getAllTypes($GLOBALS['conn']);

    // Sort classes, makes, and types alphabetically
    usort($classes, function($a, $b) {
        return strcmp($a['vehicle_class'], $b['vehicle_class']);
    });
    usort($makes, function($a, $b) {
        return strcmp($a['vehicle_make'], $b['vehicle_make']);
    });
    usort($types, function($a, $b) {
        return strcmp($a['vehicle_type'], $b['vehicle_type']);
    });
} catch (PDOException $e) {
    // Display error message if fetching fails
    echo "<div style='color: red;'><strong>Error:</strong> An error occurred while fetching data. Please check the database connection and make sure the tables exist. <br>";
    echo "Error Message: " . $e->getMessage() . "</div><br>";
}

// Function to add a new vehicle
function addVehicle($conn, $year, $make, $model, $type, $class, $price) {
    try {
        // Prepare and execute the INSERT query
        $query = "INSERT INTO vehicle_inventory (vehicle_year, vehicle_make, vehicle_model, vehicle_type, vehicle_class, vehicle_price) VALUES (:year, :make, :model, :type, :class, :price)";
        $statement = $conn->prepare($query);
        $statement->bindParam(':year', $year);
        $statement->bindParam(':make', $make);
        $statement->bindParam(':model', $model);
        $statement->bindParam(':type', $type);
        $statement->bindParam(':class', $class);
        $statement->bindParam(':price', $price);
        $statement->execute();

        // Output verbose information
        echo "<div style='color: green;'><strong>Success:</strong> Vehicle added successfully. Details:<br>";
        echo "Year: $year<br>";
        echo "Make: $make<br>";
        echo "Model: $model<br>";
        echo "Type: $type<br>";
        echo "Class: $class<br>";
        echo "Price: $price<br>";
        echo "</div><br>";
    } catch (PDOException $e) {
        // Handle any errors if the INSERT query fails
        throw new PDOException("Error adding vehicle: " . $e->getMessage());
    }
}

// Handle form submission to add vehicle
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_vehicle'])) {
    // Retrieve form data
    $year = $_POST['year'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $type = $_POST['type'];
    $class = $_POST['class'];
    $price = $_POST['price'];

    try {
        // Please prepare and execute the SQL insert statement
        $query = "INSERT INTO vehicle_inventory (vehicle_year, vehicle_make, vehicle_model, vehicle_type, vehicle_class, vehicle_price) 
                  VALUES (:year, :make, :model, :type, :class, :price)";
        $statement = $conn->prepare($query);
        $statement->bindParam(':year', $year);
        $statement->bindParam(':make', $make);
        $statement->bindParam(':model', $model);
        $statement->bindParam(':type', $type);
        $statement->bindParam(':class', $class);
        $statement->bindParam(':price', $price);
        $statement->execute();

        // Output success message
        echo "<div style='color: green;'><strong>Success:</strong> Vehicle added successfully. Details:<br>";
        echo "Year: $year<br>";
        echo "Make: $make<br>";
        echo "Model: $model<br>";
        echo "Type: $type<br>";
        echo "Class: $class<br>";
        echo "Price: $price<br>";
        echo "</div><br>";

        // Please redirect back to the same page after adding the vehicle
        header("Location: admin_inventory.php");
        exit();
    } catch (PDOException $e) {
        // Handle any errors
        echo "<div style='color: red;'><strong>Error:</strong> An error occurred while adding the vehicle. Please try again. <br>";
        echo "Error Message: " . $e->getMessage() . "</div><br>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle</title>
    <title>Admin Add Vehicle Page</title>
    <!-- Include any additional head elements from your original code here... -->
    <script>
        function showErrorPopup() {
            alert("Error inserting data: Duplicate vehicle in that category.");
            // You can use more sophisticated modal/popup library if needed
        }
    </script>
</head>
<body>
    <h1>Add Vehicle</h1>
    <h1>Zippy Admin</h1>

    <!-- Form elements -->
    <form action="../controller/add.php" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
    <form action="../form/add_vehicle_form.php" method="post">
        <label for="make">Make:</label>
        <select id="make" name="make" required>
            <?php foreach ($makes as $make) : ?>
                <option value="<?php echo $make['vehicle_make']; ?>"><?php echo $make['vehicle_make']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <label for="type">Type:</label>
        <select id="type" name="type" required>
            <?php foreach ($types as $type) : ?>
                <option value="<?php echo $type['vehicle_type']; ?>"><?php echo $type['vehicle_type']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="category_id">Category:</label>
        <select name="category_id" id="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['category_id']; ?>">
                    <?php echo $category['category_name']; ?>
                </option>
        <label for="class">Class:</label>
        <select id="class" name="class" required>
            <?php foreach ($classes as $class) : ?>
                <option value="<?php echo $class['vehicle_class']; ?>"><?php echo $class['vehicle_class']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <button type="submit">Add Vehicle</button>
    </form>
        <!-- Add text box for Year -->
        <label for="year">Year:</label>
        <input type="text" id="year" name="year" required>
        <br>

    <!-- Additional content -->
    <p>Please Enter the details for the new vehicle and click "Add Vehicle" to add it to your inventory.</p>
    <br><br>
    <p>You can also <a href="../controller/index.php">please go back to the Vehicle Inventory</a>.</p>
        <!-- Add text box for Model -->
        <label for="model">Model:</label>
        <input type="text" id="model" name="model" required>
        <br>

    <?php
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Handle form submission
        handleFormSubmission();
    }
        <!-- Add text box for Price -->
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required>
        <br>

        <!-- Add submit button -->
        <button type="submit">Add Vehicle</button>
    </form>

    // Additional functions for managing vehicles can be added here...
    ?>
    <!-- Additional links -->
    <p><a href="../controller/admin.php">View Full Vehicle List</a></p>
    <p><a href="../form/add_vehicle_form.php">Click here to add a vehicle</a></p>
    <p><a href="#">form>/Edit Vehicle Makes</a></p>
    <p><a href="#">form/Edit Vehicle Types</a></p>
    <p><a href="#">form/Edit Vehicle Classes</a></p>   

    <!-- Display form values for troubleshooting -->
    <div>
        <h2>Form Values for Troubleshooting:</h2>
        <p>Make: <?php echo isset($_POST['make']) ? $_POST['make'] : ''; ?></p>
        <p>Type: <?php echo isset($_POST['type']) ? $_POST['type'] : ''; ?></p>
        <p>Class: <?php echo isset($_POST['class']) ? $_POST['class'] : ''; ?></p>
        <p>Year: <?php echo isset($_POST['year']) ? $_POST['year'] : ''; ?></p>
        <p>Model: <?php echo isset($_POST['model']) ? $_POST['model'] : ''; ?></p>
        <p>Price: <?php echo isset($_POST['price']) ? $_POST['price'] : ''; ?></p>
    </div>
</body>
</html>

<?php
// Function to handle form submission
function handleFormSubmission() {
    echo "Handling form submission...\n"; // Output to the web page

    if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['category_id'])) {
        // Extract form data
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];

        // Validate and sanitize input
        try {
            echo "Adding Vehicle...\n"; // Output to the web page

            // Insert into the database (replace with your actual function)
            // addVehicle($GLOBALS['conn'], $title, $description, $category_id);

            echo "Vehicle added successfully!\n"; // Output to the web page

            // Redirect back to add_vehicle_form.php after adding a new vehicle
            header("Location: ../view/add_vehicle_view.php");
            exit();
        } catch (PDOException $e) {
            echo "Error inserting data: " . $e->getMessage(); // Output to the web page
            exit();
        }
    } else {
        echo "Form data is incomplete.\n"; // Output to the web page
    }
}
?>
    

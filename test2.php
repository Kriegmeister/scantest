<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Number Input Form</title>
    <script>
        // Function to dynamically generate number input fields
        function generateFields() {
            var numFields = document.getElementById("num_fields").value;
            numFields = Math.min(numFields, 10); // Limit to a maximum of 10 fields
            var fieldsContainer = document.getElementById("fields_container");
            fieldsContainer.innerHTML = ""; // Clear existing fields

            for (var i = 1; i <= numFields; i++) {
                var label = document.createElement("label");
                label.innerHTML = "Number " + i + ": ";
                
                var input = document.createElement("input");
                input.type = "number";
                input.name = "numbers[]";
                input.required = true;
                input.min = "0"; // Minimum value is 0
                input.step = "1"; // Allow only integer values

                fieldsContainer.appendChild(label);
                fieldsContainer.appendChild(input);
                fieldsContainer.appendChild(document.createElement("br"));
            }
        }
    </script>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the numbers, starting position, and direction from the form
    $numbers = isset($_POST["numbers"]) ? $_POST["numbers"] : [];
    $startingPosition = isset($_POST["starting_position"]) ? $_POST["starting_position"] : "";
    $direction = isset($_POST["direction"]) ? $_POST["direction"] : "";

    // Display the array of numbers, starting position, and direction
    echo "You entered the following numbers: " . implode(", ", $numbers) . "<br>";
    echo "Starting Position: " . htmlspecialchars($startingPosition) . "<br>";
    echo "Direction: " . htmlspecialchars($direction);
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="num_fields">Select the number of fields (max: 10):</label>
    <select id="num_fields" name="num_fields" required onchange="generateFields()">
        <?php
        for ($i = 1; $i <= 10; $i++) {
            echo "<option value=\"$i\">$i</option>";
        }
        ?>
    </select><br>

    <div id="fields_container"></div>

    <label for="starting_position">Enter the starting position:</label>
    <input type="number" id="starting_position" name="starting_position" required min="0" step="1"><br>

    <label for="direction">Select the direction:</label>
    <select id="direction" name="direction" required>
        <option value="left">Left</option>
        <option value="right">Right</option>
    </select><br>

    <button type="submit">Submit</button>
</form>

</body>
</html>

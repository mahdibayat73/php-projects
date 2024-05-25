<?php
session_start();

// Cleaning malicious codes
function validate_input($data)
{
    $data = trim($data);
    $data = stripslashes($data); // Note: changed from stripcslashes to stripslashes
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

// Initialize variables with empty values
$title = $author = $type = $description = "";

// Errors collection
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["create"])) {
        // Initialize variables with empty values
        $title = $author = $type = $description = "";

        // Form information collection
        $title = validate_input($_POST["title"]);
        $author = validate_input($_POST["author"]);
        $type = validate_input($_POST["type"]);
        $description = validate_input($_POST["desc"]);

        // Collect all inputs into an array
        $inputs = [
            'title' => $title,
            'author' => $author,
            'type' => $type,
            'description' => $description
        ];

        // Check if all fields are filled
        foreach ($inputs as $key => $value) {
            if (empty($value)) {
                array_push($errors, "All fields are required!");
                break;
            }
        }

        // Define patterns for each input except 'type'
        $patterns = [
            'title' => "/^[a-zA-Z0-9 ]*$/",
            'author' => "/^[a-zA-Z0-9 ]*$/",
            'description' => "/^[a-zA-Z0-9 ,.]*$/"
        ];

        // Validate inputs against their patterns, excluding 'type'
        foreach ($inputs as $key => $value) {
            if ($key !== 'type' && !preg_match($patterns[$key], $value)) {
                array_push($errors, ucfirst($key) . " contains invalid characters.");
            }
        }

        // Display errors (for debugging purposes)
        if (!empty($errors)) {
            $_SESSION["errors"] = $errors;
            $_SESSION['form_data'] = $inputs;
            header("Location: ../form/add-book.php");
        } else {
            // Connect to data base and sql to insert data
            require_once("../loader/db-connection.php");
            try {
                $sql = "INSERT INTO books (title, author, type, description) VALUES (:title, :author, :type, :description)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":title", $title);
                $stmt->bindParam(":author", $author);
                $stmt->bindParam(":type", $type);
                $stmt->bindParam(":description", $description);
                $stmt->execute();

                // Redirect to index.php(book list page)
                $_SESSION["added"] = "Book Added Successfully";
                header("Location: ../index.php");
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        }
    }
}

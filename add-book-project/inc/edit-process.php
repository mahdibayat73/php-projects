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

    if (isset($_POST["edit"])) {
        // Initialize variables with empty values
        $title = $author = $type = $description = $id = "";

        // Form information collection
        $title = validate_input($_POST["title"]);
        $author = validate_input($_POST["author"]);
        $type = validate_input($_POST["type"]);
        $description = validate_input($_POST["desc"]);
        $id = validate_input($_POST["id"]);

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
            header("Location: ../form/edit-book.php");
            exit();
        } else {
            // Connect to data base and sql to insert data
            require_once("../loader/db-connection.php");
            try {
                $sql = "UPDATE books SET title = :title, author = :author, type = :type, description = :description WHERE id=$id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":title", $title);
                $stmt->bindParam(":author", $author);
                $stmt->bindParam(":type", $type);
                $stmt->bindParam(":description", $description);
                $stmt->execute();
                $_SESSION["edited"] = "Edited successfully";
                // Redirect to index.php(book list page)
                header("Location: ../form/edit-book.php");
                exit();
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        }
    }
}

$conn = null;

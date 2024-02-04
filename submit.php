<!DOCTYPE html>
<html lang="en">
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXOTICA EVENTS AND HOSPITALITY</title>
    <link rel="icon" href="logo.png" type="image/x-icon">
</head>
<style>
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #333;
}

form {
    margin-top: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

input[type="file"] {
    margin-bottom: 10px;
}

input,
textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #4caf50;
    color: #fff;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 4px;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

.error {
    color: #d9534f;
    margin-top: 5px;
}

.success {
    color: #5bc0de;
    margin-top: 5px;
}

</style>
<body>
      <div class="container">
    <h2>Upload Image</h2>

    <?php
   
    // Check if the form is submitted
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle the form submission
        $uploadDir = 'images/'; // Specify your upload directory
        $uploadFile = $uploadDir . basename($_FILES['fileInput']['name']);

        // Additional details
        $alt = $_POST['alt'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        // Check if the uploaded file is an image or PDF
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
        $fileExtension = strtolower(pathinfo($_FILES['fileInput']['name'], PATHINFO_EXTENSION));

        if (in_array($fileExtension, $allowedExtensions)) {
            // Move the uploaded file to the destination
            if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile)) {
                // File upload successful, now insert details into the database
                $localhost = "localhost";
                $username = "root";
                $password = "";
                $database = "contactus";

                $conn = new mysqli($localhost, $username, $password, $database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $stmt = $conn->prepare("INSERT INTO images (path, alt, title, description) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $uploadFile, $alt, $title, $description);

                if ($stmt->execute()) {
                    echo "File uploaded and details inserted into the database successfully.";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
                $conn->close();
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid file type. Allowed types: jpg, jpeg, png, gif, pdf.";
        }
    }
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="fileInput">Choose File:</label>
        <input type="file" name="fileInput" id="fileInput" required>
        <br>
        <label for="alt">Alt Text:</label>
        <input type="text" name="alt" id="alt">
        <br>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title">
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>
        <br>
        <input type="submit" value="Upload">
    </form>
    
   
     
</body>
</html>


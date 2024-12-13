
<?php
session_start(); // Start the session
require_once("db.php");

// If user is not logged in, redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Query to fetch the user's information
$sql = "SELECT student_id, email, phone_number, gender, course, full_name FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the user's information
$user = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Monoton&family=Permanent+Marker&display=swap');
    @media(min-width: 768px) {
        
        
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: rgb(0, 0, 0);
            background: url("flowerbg.png");
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 100vh;
        }

        .container {
            display: flex;
            flex-direction: column;
            background-color: rgba(255, 132, 159, 0.555);
            width: 800px;
            height: 500px;
            justify-content: center;
            align-items: center;
            border-radius: 30px;
            box-shadow: 0 0 5px 5px rgb(255, 183, 195);

        }

        table {
            border: 1px solid black;
            border-radius: 20px;
        }

        table, th, td {
            padding: 1rem;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        table th {
            font-size: 16px;
            font-weight: lighter;
        }

        header h1{
            color: rgb(255, 230, 235);
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 30px;
            font-weight: 200px;
        }

        #greetings {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 24px;
        }

        #greet {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 12px;
            font-weight: bold;
        }

        .button-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            align-items: center;
        }

        button {
            border-style: none;
            border-radius: 20px;
            padding: 12px;
            background-color: rgb(255, 198, 207);
        }

        .button-container button a {
            text-decoration: none;
            color: rgb(12, 12, 12);
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-weight: 400;
        }
    }    

    @media(min-width: 2560px) {
        
        
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: rgb(0, 0, 0);
            background: url("flowerbg.png");
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 100vh;
        }

        .container {
            display: flex;
            flex-direction: column;
            background-color: rgba(255, 132, 159, 0.555);
            width: 1000px;
            height: 700px;
            justify-content: center;
            align-items: center;
            border-radius: 30px;
            box-shadow: 0 0 5px 5px rgb(255, 183, 195);

        }

        table {
            
            border: 1px solid black;
            border-radius: 40px;
           font-size: 18px;
        }

        table, th, td {
            padding: 1rem;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        table th {
            font-size: 16px;
            font-weight: lighter;
        }

        header h1{
            color: rgb(255, 230, 235);
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 60px;
            font-weight: 200px;
        }

        #greetings {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 48px;
        }

        #greet {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 24px;
            font-weight: bold;
        }

        .button-container {
            display: flex;
            gap: 30px;
            justify-content: center;
            align-items: center;
        }

        button {
            border-style: none;
            border-radius: 25px;
            padding: 20px;
            background-color: rgb(255, 198, 207);
        }

        .button-container button a {
            text-decoration: none;
            color: rgb(12, 12, 12);
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-weight: 400;
        }
    }    
    </style>

</head>
<body>
    <header><h1>STUDENT DASHBOARD</h1></header>
    <div class="container">
    <?php if ($user): ?>

        <p id="greetings">Welcome, <?php echo htmlspecialchars($user['full_name']); ?></p>
        <p id="greet">Here is your dashboard overview:</p>
        <table border="1">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Course</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo htmlspecialchars($user['student_id']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['phone_number']); ?></td>
                    <td><?php echo htmlspecialchars($user['gender']); ?></td>
                    <td><?php echo htmlspecialchars($user['course']); ?></td>
                  
                </tr>
            </tbody>
        </table><br>
    <?php else: ?>
        <p>No user information found.</p>
    <?php endif; ?>

    <br><br>
   <div class="button-container"> 
    <button><a href="">Update Profile</a></button>
    <button><a href="">View Grades</a></button>
    <button><a href="logout.php">Logout</a></button>
    </div>
    </div>
</body>
</html>
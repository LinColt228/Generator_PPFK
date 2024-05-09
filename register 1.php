<?php
// Підключення до бази даних
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test1base";

// Створення з'єднання
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка з'єднання
if ($conn->connect_error) {
    die("Помилка підключення до бази даних: " . $conn->connect_error);
}

// Отримання даних з форми реєстрації
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Рекомендується хешувати пароль перед збереженням у базу даних

    // Вставка даних у таблицю користувачів
    $sql = "INSERT INTO users (email, phone, login, pass) VALUES ('$email', '$phone', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Користувач успішно зареєстрований!";
    } else {
        echo "Помилка: " . $sql . "<br>" . $conn->error;
    }
}

// Закриття з'єднання з базою даних
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        /* Стилі для навігаційного меню */
        nav {
            background-color: #1E1E1E;
            overflow: hidden;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        nav ul li {
            float: left;
            margin-right: 20px;
        }
        nav ul li a {
            display: block;
            color: #FFFFFF;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
        }
        nav ul li a:hover {
            background-color: #FFFFFF;
            color: #1E1E1E;
            border-radius: 5px;
        }
        /* Стилі для форми */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            width: 300px;
            margin: 100px auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<nav>
        <ul>
            <li><a href="index.html">Головна</a></li>
            <!-- Показувати посилання на реєстрацію та вхід тільки якщо користувач не авторизований -->
            {% if not session.logged_in %}
            <li><a href="register.html">Регестрація</a></li>
            <li><a href="login.html">Вхід</a></li>
            {% endif %}
            <!-- Показувати посилання на вихід тільки якщо користувач авторизований -->
            {% if session.logged_in %}
            <li><a href="create direction.html">Стоврити напрямок</a></li>
            {% endif %}
            <!-- Додайте інші посилання на ваш вміст тут -->
        </ul>
    </nav>

<div class="container">
    <h2>Registration</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="phone">Phone:</label><br>
        <input type="tel" id="phone" name="phone" required><br>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br>
        <input type="submit" value="Register">
        <!-- Доданий блок для відображення повідомлення про помилку -->
    </form>
</div>

</body>
</html>

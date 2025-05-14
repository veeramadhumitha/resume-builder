<nav style="background:#f2f2f2; padding: 10px;">
    <a href="home.php">Home</a> |
    <a href="about.php">About</a> |
    <a href="faq.php">FAQ</a> |
    <a href="contact.php">Contact</a>
</nav>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact - Resume Builder</title>
    <style>
        body { font-family: Arial; padding: 30px; }
        input, textarea { width: 100%; padding: 10px; margin-top: 10px; }
        button { padding: 10px 20px; margin-top: 10px; }
    </style>
</head>
<body>
    <h1>Contact Us</h1>
    <form action="#" method="POST">
        <label>Name:</label><br>
        <input type="text" name="name"><br>
        <label>Email:</label><br>
        <input type="email" name="email"><br>
        <label>Message:</label><br>
        <textarea name="message" rows="5"></textarea><br>
        <button type="submit">Send</button>
    </form>
</body>
</html>

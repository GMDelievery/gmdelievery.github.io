<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mein Shop</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function openPopup() {
            var popup = window.open('', 'Registration', 'width=400,height=300');
            popup.document.write('<h2>Registrierung</h2>');
            popup.document.write('<form>');
            popup.document.write('<label for="username">Spielername:</label><br>');
            popup.document.write('<input type="text" id="username" name="username"><br><br>');
            popup.document.write('<label for="apiToken">API-Token:</label><br>');
            popup.document.write('<input type="text" id="apiToken" name="apiToken"><br><br>');
            popup.document.write('<input type="submit" value="Registrieren">');
            popup.document.write('</form>');
        }
    </script>
</head>
<body>
    <header style="background-color: #04D5B2;">
        <h1>Willkommen in unserem Shop</h1>
        <nav>
            <ul>
                <li><a href="#" onclick="openPopup();">Register</a></li>
            </ul>
        </nav>
    </header>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Mein Shop</p>
    </footer>
</body>
</html>
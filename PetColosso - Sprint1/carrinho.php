<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Conta - Pet Colosso</title>
    <link rel="stylesheet" href="style.css">

    <link href="https://fonts.googleapis.com/css2?family=
        Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome
        /4.7.0/css/font-awesome.min.css">
</head>
    <body>

        <!------------- Menu ------------->

        <?php
            include ('menu.php');
        ?>

        <!------------- Footer ------------->

        <?php
            include ('footer.php');
        ?>

        <!------------- JS menu ------------->

        <script>
            var MenuItems = document.getElementById("MenuItems");

            MenuItems.style.maxHeight = "0px";

            function menutoggle() {
                if (MenuItems.style.maxHeight == "0px") {
                    MenuItems.style.maxHeight = "200px";
                } else {
                    MenuItems.style.maxHeight = "0px";
                }
            }
        </script>
    </body>
</html>
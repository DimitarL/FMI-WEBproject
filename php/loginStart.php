<?php
session_start();
?>
<!DOCTYPE html>
<html lang="bg">

<head>
    <meta http-equiv="content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=3.0, minimum-scale=0.86">
    <title>Презентиране на реферати</title>
    <link href="../css/login.css" rel="stylesheet" />
</head>

<body>
    <header class="header">
        <h1>Презентиране на реферати</h1>
    </header>

    <div class="container">
        <main>
            <form action="../php/loginRegister.php" class="informationForm" method="POST" enctype="multipart/form-data">
                <h2>Вход</h2>
                <?php
                if (isset($_SESSION['errorMessage'])) {
                    echo "<span style='color:red;'>Грешно потребителско име или грешна парола!</span>";
                } ?>
                <label for="username"> Потребителско име: </label>
                <input type="text" id="username" name="username" maxlength="64" required>

                <label for="password"> Парола: </label>
                <input type="password" id="password" name="password" maxlength="64">

                <div class="mainButtons">
                    <button type="submit" class="whiteButtons cancelButton"> Влез </button>
                </div>
            </form>
        </main>
    </div>
</body>

</html>
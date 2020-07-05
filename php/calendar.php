<!DOCTYPE html>
<html>

<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Календар</title>
    <link rel="stylesheet" type="text/css" href="../css/calendar.css">
</head>

<body>
    <?php session_start(); ?>
    <header class="header">
        <h2> Календар за презентиране</h2>
        <a href='../php/logout.php'><button> Изход </button></a>
    </header>
    <hr>
    <main class="table">
        <table>
            <thead>
                <tr>
                    <th>Ден</th>
                    <th>Дата на представяне</th>
                    <th>Зала</th>
                    <th>Тема</th>
                    <th>Лично име</th>
                    <th>Фамилия</th>
                    <th>Факултетен номер</th>
                    <th>Покана</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 0;
                include './db_connection.php';
                $conn = dbConnection();
                $sql = "SELECT d.day, d.timeDate, d.room, t.topic, s.firstName, s.lastName, s.facultyNumber, t.invitationPath from dates d 
                inner join presentations p on d.timedate=p.timeDate inner join topicsInfo t on p.topicId=t.topicId inner join students s on p.username=s.username where d.hasPresentation='1'";
                $stmt = $conn->prepare($sql);
                $stmt->execute() or die("Failed to query from DB!");
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td>
                            <?php echo $result["day"]; ?>
                        </td>
                        <td>
                            <?php echo $result["timeDate"]; ?>
                        </td>
                        <td>
                            <?php echo $result["room"]; ?>
                        </td>
                        <td>
                            <?php echo $result["topic"] ?>
                        </td>
                        <td>
                            <?php echo $result["firstName"] ?>
                        </td>
                        <td>
                            <?php echo $result["lastName"] ?>
                        </td>
                        <td>
                            <?php echo $result["facultyNumber"] ?>
                        </td>
                        <td>
                            <?php echo $result["invitationPath"] ?>
                        </td>
                    </tr>
                <?php
                }
                $sql = "SELECT timeDate, room, day from dates where hasPresentation='0'";
                $stmt = $conn->prepare($sql);
                $stmt->execute() or die("Failed to query from DB!");
                $counter = 0;
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td>
                            <?php echo $result["day"]; ?>
                        </td>
                        <td>
                            <?php echo $result["timeDate"]; ?>
                        </td>
                        <td>
                            <?php echo $result["room"]; ?>
                        </td>
                        <?php for ($i = 0; $i < 5; $i++) { ?>
                            <td>
                                <?php echo "" ?>
                            </td>

                    <?php }
                    }
                    ?>
            </tbody>
        </table>
        <div class="edit">
            <?php
            $user = $_SESSION["username"];
            $sql = "SELECT count(username) from presentations where username=:usernamePlaceholder";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":usernamePlaceholder", $user);
            $stmt->execute() or die("Failed to query from DB!");
            if ($stmt->fetchColumn() != 0) { ?>
                <input type="submit" value="Отпиши се" name="removeFromTable" id="removeFromTable">
            <?php
            } else if (strcmp($_SESSION["role"], "admin") == 0) { ?>
                <input type="submit" value="Генерирай часове" onclick="window.location='../html/generateDate.html'">
            <?php } else if (strcmp($_SESSION["role"], "student") == 0) { ?>
                <input type="submit" value="Запиши се!" onclick="window.location='../html/presentation_record.html'">
            <?php } ?>
            <input type="submit" value="Към презентацията" onclick="window.location='../html/presentation.html'">
        </div>
    </main>
</body>

</html>
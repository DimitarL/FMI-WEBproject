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
                    <th>Лично име</th>
                    <th>Фамилия</th>
                    <th>Факултетен номер</th>
                    <th>Курс</th>
                    <th>Видеоконферентна връзка</th>
                    <th>Тема</th>
                    <th>Покана</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 0;
                include './db_connection.php';
                $conn = dbConnection();
                $sql = "SELECT d.timeDate, d.room, s.firstName, s.lastName, s.facultyNumber, s.course, p.presentation, p.invitation, p.topic FROM presentations p INNER JOIN students s on p.username=s.username LEFT JOIN dates d on d.timeDate=p.timeDate  ORDER BY d.timeDate";
                $stmt = $conn->prepare($sql);
                $stmt->execute() or die("Failed to query from DB!");
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td>
                            <?php if ($counter == 0) {
                                $datePresentation = $result["timeDate"];
                                $counter++;
                            } else {
                                $splitDateBefore = explode(" ", $datePresentation);
                                $splitDateAfter = explode(" ", $result["timeDate"]);
                                if (strcmp($splitDateBefore[0], $splitDateAfter[0])) {
                                    $counter++;
                                    $datePresentation = $result["timeDate"];
                                }
                            }
                            echo "Ден " . $counter; ?>
                        </td>
                        <td>
                            <?php
                            echo $result["timeDate"]; ?>
                        </td>
                        <td>
                            <?php echo $result["room"]; ?>
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
                            <?php echo $result["course"] ?>
                        </td>
                        <td>
                            <?php echo $result["presentation"] ?>
                        </td>
                        <td>
                            <?php echo $result["topic"] ?>
                        </td>
                        <td>
                            <a href="<?php echo $result["invitation"] ?>" alt="invitation" download>
                                <p>Изтегли поканата</p>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                $sql = "SELECT timeDate, room from dates where hasPresentation='0'";
                $stmt = $conn->prepare($sql);
                $stmt->execute() or die("Failed to query from DB!");
                $counter = 0;
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td>
                            <?php if ($counter == 0) {
                                $datePresentation = $result["timeDate"];
                                $counter++;
                            } else {
                                $splitDateBefore = explode(" ", $datePresentation);
                                $splitDateAfter = explode(" ", $result["timeDate"]);
                                if (strcmp($splitDateBefore[0], $splitDateAfter[0])) {
                                    $counter++;
                                    $datePresentation = $result["timeDate"];
                                }
                            }
                            echo "Ден " . $counter; ?>
                        </td>
                        <td>
                            <?php echo $result["timeDate"] ?>
                        </td>
                        <td>
                            <?php echo $result["room"] ?>
                        </td>
                        <?php for ($i = 0; $i < 7; $i++) { ?>
                            <td>
                                <?php echo "" ?>
                            </td>
                    <?php }
                    } ?>
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
<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Календар</title>
    <link rel="stylesheet" type="text/css" href="../css/calendar.css">
</head>
<body>
<header class="header">
        <h2> Календар за презентиране</h2>
        <button onclick="">Изход</button>
    </header>
    <hr>
    <main class="table">
    <table>
        <thead>
            <tr>
                <th>Дата на представяне</th>
                <th>Лично име</th>
                <th>Фамилия</th>
                <th>Курс</th>
                <th>Група</th>
                <th>Презентация</th>
                <th>Покана</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include './db_connection.php';
                $conn=dbConnection();
        
                $sql="SELECT d.timeDate, s.firstName, s.lastName, s.course, s.groupNumber, p.presentation, p.invitation FROM presentations p INNER JOIN students s on p.username=s.username LEFT JOIN dates d on d.timeDate=p.timeDate  ORDER BY p.timeDate";
                $stmt=$conn->prepare($sql);
                $stmt -> execute() or die("Failed to query from DB!");
                while($result=$stmt->fetch(PDO::FETCH_ASSOC)){?>
                <tr>
                    <td>
                        <?php echo $result["timeDate"]?>
                    </td>
                    <td>
                        <?php echo $result["firstName"]?>
                    </td>
                    <td>
                        <?php echo $result["lastName"]?>
                    </td>
                    <td>
                        <?php echo $result["course"]?>
                    </td>
                    <td>
                        <?php echo $result["groupNumber"]?>
                    </td>
                    <td>
                        <?php echo $result["presentation"]?>
                    </td>
                    <td>
                    <a href="<?php echo $result["invitation"]?>" alt="invitation" download>
                        <p>Изтегли поканата</p>
                    </a>
                    </td>
                </tr>
                <?php
                }
                $sql="SELECT timeDate from dates where hasPresentation='0'";
                $stmt=$conn->prepare($sql);
                $stmt -> execute() or die("Failed to query from DB!");
                while($result=$stmt->fetch(PDO::FETCH_ASSOC)){?>
                    <tr>
                        <td>
                            <?php echo $result["timeDate"]?>
                        </td>
                        <td>
                        <?php echo ""?>
                    </td>
                    <td>
                        <?php echo ""?>
                    </td>
                    <td>
                    <?php echo ""?>
                    </td>
                    <td>
                    <?php echo ""?>
                    </td>
                    <td>
                    <?php echo ""?>
                    </td>
                    <td>
                    <?php echo ""?>
                    </td>
                        <?php
                        }
                ?>
                
        </tbody>
    </table>
    <div class="edit">
        <input type="submit" value="Запиши се" onclick="window.location='../html/presentation_record.html'">
        <input type="submit" value="Към презентацията" onclick="window.location=''">
    </div>
    </main>
</body>
</html>


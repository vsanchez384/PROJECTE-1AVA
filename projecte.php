<?php
    $file = 'games.json';
    $json = file_get_contents($file);
    $games = json_decode($json, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Video Games</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .game {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Search Video Games</h1>
        <form action="search.php" method="post">
            <input type="text" name="search" placeholder="Search game by name or platform...">
            <input type="submit" value="Search">
        </form>

        <?php
            foreach ($games as $game) {
                echo '<div class="game">';
                echo '<h2>' . $game['name'] . '</h2>';
                echo '<p>Platform: ' . $game['platform'] . '</p>';
                echo '<p>Year: ' . $game['year'] . '</p>';
                echo '</div>';
            }
        ?>
    </div>
</body>
</html>
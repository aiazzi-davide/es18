<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca</title>
</head>
<body>
<h1>Autori</h1>
<p>
    <?php
    require 'func.php';
    global $conn;
    //lista autori in vita e numero romanzi
    $sql = "SELECT a.NomeAutore, COUNT(*) AS Romanzi FROM autori a JOIN romanzi r ON a.NomeAutore=r.NomeAutore WHERE AnnoM IS NULL GROUP BY NomeAutore";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<h2>Lista autori in vita e numero romanzi</h2>";
        while ($row = $result->fetch_assoc()) {
            echo 'Autore: '.$row['NomeAutore'].' Romanzi: '.$row['Romanzi'].'<br>';
        }
    }
    else {
        echo "0 results";
    }
    ?>
    <button onclick="window.location.href='index.php'">Torna alla home</button>
</p>
</body>
</html>




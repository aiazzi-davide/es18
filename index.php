<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca</title>
</head>
<body>
<h1>Biblioteca</h1>
<p>Per favore, seleziona lo scrittore</p>
    <?php
        require 'func.php';
        global $conn;
        // Query per selezionare tutti gli autori
        $sql = "SELECT NomeAutore FROM autori";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        // Start the form and the select element
        echo '<form action='.$_SERVER['PHP_SELF'].' method="post">';
        echo '<select name="autore">';
        while ($row = $result->fetch_assoc()){
            echo '<option name="autore" value="'.$row['NomeAutore'].'">'.$row['NomeAutore'].'<br>';
        }
        echo '</select>';
        echo '<input type="submit" value="conferma">';
        echo '</form>';
        }
        else {
            echo "0 results";
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['autore'])) {
            $autore = $_POST['autore'];
            $sql = "SELECT Titolo FROM romanzi WHERE NomeAutore = '$autore'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                echo "<h2>Libri scritti da $autore</h2>";
                while ($row = $result->fetch_assoc()) {
                    echo $row['Titolo'].'<br>';
                }
            }
            else {
                echo "0 results";
            }
        }
        echo '<form action='.$_SERVER['PHP_SELF'].' method="post">';
        echo '<input type="text" name="cerca">';
        echo '<input type="submit" value="cerca">';
        echo '</form>';
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cerca'])) {
            $query = 'SELECT * FROM romanzi r JOIN autori a ON r.NomeAutore=a.NomeAutore WHERE CodiceR LIKE "%'.$_POST['cerca'].'%"';
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                echo "<h2>Risultati della ricerca</h2>";
                while ($row = $result->fetch_assoc()) {
                    echo 'Titolo: '.$row['Titolo']. ' Autore: '.$row['NomeAutore'].' Anno: '.$row['Anno'].' Nazione: '.$row['Nazione'].'<br>';
                }
            }
            else {
                echo "0 results";
            }
        }
    $conn->close();
    ?>
<button type="submit"> <a href="index.php">Torna indietro</a></button>
<button type="submit"> <a href="autori.php">Autori</a></button>
</body>
</html>




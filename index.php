<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Api</title>
</head>
<body>
    <form action="student.php" method="GET">
        <label for="text_get_all">Lista studenti</label>
        <input type="submit" value="Lista studenti"><br>
        
        <label for="text_get">Ricerca studente</label>
        <select name="id">
            <option selected disabled hidden value="">Id Studente</option>
            <?php
                include('./class/DBConnection.php');
                $db = new DBConnection;
                $db = $db->returnConnection();
                $sql = "SELECT id FROM student ORDER BY id ASC;";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                foreach($result as $key)
                {   
                    echo '<option value="' . $key['id'] . '">' . $key['id'] . '</option>';
                }   
            ?>
        </select>
        <input type="submit" value="Ricerca studente">
    </form> 
    <br><br>
    <form action="student.php" method="POST">
        <legend>Inserisci i dati richiesti</legend>
        <label for="text_name">Inserisci il nome dello studente</label>
        <input type="name" name="name" required><br>
        <label for="text_surname">Inserisci il cognome dello studente</label>
        <input type="surname" name="surname" required><br>
        <label for="text_sisi_cod">Inserisci il sisi_cod dello studente</label>
        <input type="sisi_cod" name="sidiCod" required><br>
        <label for="text_tax_cod">Inserisci il tax_cod dello studente</label>
        <input type="tax_cod" name="taxCod" required><br>
        <input type="submit" value="Inserimento">
    </form>
</body>
</html>
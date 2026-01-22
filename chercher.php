<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chercher.php</title>
</head>

<body>
    <form action="tableau.php" method="GET">
        <label for="Pays"> Insérez le pays que vous cherchez : </label> &nbsp;
        <input type ="text" name="Pays"> &nbsp; <br>
        <input type="checkbox" name="debut" value="Debut"> Début <br>
        <input type="checkbox" name="fin" value="Fin"> Fin <br>
        <input type="submit" value="submit">
    </form>
</body>


</html>
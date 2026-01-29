<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tableau.html</title>

</head>

<style>
table{
    border-collapse: collapse;
    border: solid 4px;
    table-layout:fixed;
    width:1000px;
}

th, td { 
    text-align: center;
    border: solid 1px;
}



</style>


<?php
$json = file_get_contents('countries.json');
$data = json_decode($json, true);

$Debut = isset($_GET['debut']);
$Fin = isset($_GET['fin']);
$Pays_recherche = isset($_GET['Pays']) ? $_GET['Pays'] : '';

?>
<?php
$cpt = 0;
$matched_rows = [];

for ($i = 0; $i < count($data); $i++) {
    $pays = $data[$i]['country-name'];
    $capitale = $data[$i]['capitale'];
    $code = $data[$i]['iso2'];

    $nomBas = strtolower($pays);
    $rechBas = strtolower($Pays_recherche);
    $match = false;

    if ($Pays_recherche !== '') {
        if ($Debut && $Fin) {
            if (str_starts_with($nomBas, $rechBas) || str_ends_with($nomBas, $rechBas)) {
                $match = true;
            }
        } elseif ($Debut) {
            if (str_starts_with($nomBas, $rechBas)) {
                $match = true;
            }
        } elseif ($Fin) {
            if (str_ends_with($nomBas, $rechBas)) {
                $match = true;
            }
        } else {
            if (str_contains($nomBas, $rechBas)) {
                $match = true;
            }
        }
    } else {
        // pas de recherche -> on ajoutera tout plus tard si nécessaire
        $match = false;
    }
    if ($match) {
        $cpt += 1;
    }
}

?>



<body>


<table>
<?php

print("Résultats :" . $cpt . " pour votre recherche : " . $Pays_recherche . ($Debut ? " - debut" : "") . ($Fin ? " - fin" : "") . "<br>");

print ("<th> Nom </th>");
print ("<th> Capitale </th>");
print ("<th> Code </th>");  
print ("<th> Drapeau </th>");
?>

<?php 
    for ($i = 0; $i < count($data); $i++) {
        $pays_indice_i = $data[$i]['country-name'];
        $capitale_indice_i = $data[$i]['capital'];
        $code_indice_i = $data[$i]['iso2'];
        $match = false;
        
        $nomBas = strtolower($pays_indice_i);
        $rechBas = strtolower($Pays_recherche);

        if ($Debut && $Fin) {
            if (str_starts_with($nomBas, $rechBas) || str_ends_with($nomBas, $rechBas)) {
                $match = true;
                print("<tr>");
                print("<td>" . $pays_indice_i . "</td>");
                print("<td>" . $capitale_indice_i . "</td>");
                print("<td>" . $code_indice_i . "</td>");
                print("<td><img src='https://flagsapi.com/" . $code_indice_i . "/flat/64.png' /></td>");
                print("</tr>");
            }
        } elseif ($Debut && !$match) {
            if (str_starts_with($nomBas, $rechBas)) {
                $match = true;
                print("<tr>");
                print("<td>" . $pays_indice_i . "</td>");
                print("<td>" . $capitale_indice_i . "</td>");
                print("<td>" . $code_indice_i . "</td>");
                print("<td><img src='https://flagsapi.com/" . $code_indice_i . "/flat/64.png' /></td>");
                print("</tr>");
            }
        } elseif ($Fin && !$match) {
            if (str_ends_with($nomBas, $rechBas)) {
                $match = true;
                print("<tr>");
                print("<td>" . $pays_indice_i . "</td>");
                print("<td>" . $capitale_indice_i . "</td>");
                print("<td>" . $code_indice_i . "</td>");
                print("<td><img src='https://flagsapi.com/" . $code_indice_i . "/flat/64.png' /></td>");
                print("</tr>");
            }
        } elseif (str_contains($nomBas, $rechBas) && !$match) {
            $match = true;
            print("<tr>");
            print("<td>" . $pays_indice_i . "</td>");
            print("<td>" . $capitale_indice_i . "</td>");
            print("<td>" . $code_indice_i . "</td>");
                print("<td><img src='https://flagsapi.com/" . $code_indice_i . "/flat/64.png' /></td>");
                print("</tr>");
            }
        }
        if ($cpt === 0) {
            print("Veuillez consulter le tableau suivant : <br>");
            for ($i = 0; $i < count($data); $i++) {
                $pays_indice_i = $data[$i]['country-name'];
                $capitale_indice_i = $data[$i]['capital'];
                $code_indice_i = $data[$i]['iso2'];
                print("<tr>");
                print("<td>" . $pays_indice_i . "</td>");
                print("<td>" . $capitale_indice_i . "</td>");
                print("<td>" . $code_indice_i . "</td>");
                print("<td><img src='https://flagsapi.com/" . $code_indice_i . "/flat/64.png' /></td>");
                print("</tr>");
            }
        }

?>


    </table>
</body>




</html>
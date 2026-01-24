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

<body>
<table>
<?php
print ("<th> Nom </th>");
print ("<th> Capitale </th>");
print ("<th> Code </th>");  
print ("<th> Drapeau </th>");

$flag = false;
$paysLen = strlen($Pays_recherche); // longueur de la chaîne recherchée
for ($i = 0; $i < count($data); $i++) {
    $pays_indice_i = $data[$i]['country-name'];
    $lenData = strlen($pays_indice_i); // longueur du nom du pays dans les données
    if ($Debut) {

        if (str_starts_with(strtolower($pays_indice_i), strtolower($Pays_recherche))) {
            $flag = true;
        } 
        

    }

    else if ($Fin) {
        if ($paysLen <= $lenData) {
            if (str_ends_with(strtolower($pays_indice_i), strtolower($Pays_recherche))) {
                $flag = true;
            }
        }
    }

    else if (!$Debut && !$Fin) {
        if (strpos(strtolower($pays_indice_i), strtolower($Pays_recherche)) !== false) {
            $flag = true;
        }
    }


}

?>
    <?php 
    if ($flag) {
        echo("<h3> Certains resultats correspondent à votre recherche : <u>" . $Pays_recherche . "</u>" . ($Debut ? " (Début)" : "") . ($Fin ? " (Fin)" : "" ) . " : </h3> <br>");  
        echo("Voici la liste des pays ci-dessous : <br><br><br>"); 
        
        for ($i = 0; $i < count($data); $i++) {
            $pays_indice_i = $data[$i]['country-name'];
            $match = false;
            
            $nomBas = strtolower($pays_indice_i);
            $rechBas = strtolower($Pays_recherche);

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

            if ($match) {
                $nomCode = $data[$i]['iso2'];
                ?>
                <tr>
                    <td><?php echo $pays_indice_i; ?></td>
                    <td><?php echo $data[$i]['capital']; ?></td>
                    <td>&nbsp;&nbsp;<?php echo $nomCode; ?>&nbsp;&nbsp;</td>
                    <td><img src="https://flagsapi.com/<?php echo $nomCode; ?>/flat/64.png" /></td>
                </tr>
                <?php
            }
        }
    }

    else {
        echo("<h3> Aucun resultat ne correspond à votre recherche : <u>" . $Pays_recherche . "</u></h3> <br>");  
        echo("Voici la liste des pays ci-dessous : <br><br><br>"); 

        for ($i = 0; $i < count($data); $i++) {
            print("<tr>");
                $nomPays = $data[$i]['country-name'];
                $Capitale = $data[$i]['capital'];
                $nomCode = $data[$i]['iso2'];
                $Drapeau = "<img src=https://flagsapi.com/" . $nomCode . "/flat/64.png />";
                print("<td> " . $nomPays . " </td>");
                print("<td> " . $Capitale . " </td>");
                print("<td> &nbsp;&nbsp;" . $nomCode . " &nbsp;&nbsp;</td>");
                print("<td> &nbsp;" . $Drapeau . "&nbsp; </td>");
            }
            print("</tr>");
        }
    ?>


    </table>
</body>




</html>
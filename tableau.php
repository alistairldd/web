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
$Pays = isset($_GET['Pays']) ? $_GET['Pays'] : '';

?>

<body>
<table>
<?php
print ("<th> Nom </th>");
print ("<th> Capitale </th>");
print ("<th> Code </th>");  
print ("<th> Drapeau </th>");

$flag = false;
$paysLen = strlen($Pays);
for ($i = 0; $i < count($data); $i++) {
    $lenData = strlen($data[$i]['country-name']);
    if ($Debut) {
        if ($paysLen <= $lenData) {
            $tmp = substr($data[$i]['country-name'], 0, $paysLen);
            if ($tmp == $Pays) {
                $flag = true;
            }
        }
    }

    else if ($Fin) {
        if ($paysLen <= $lenData) {
            $tmp = substr($data[$i]['country-name'], $lenData-$paysLen);
            if ($tmp == $Pays) {
                $flag = true;
            }
        }
    }


}

?>




    
    <?php 
    if ($flag) {
        echo("<h3> Certains resultats correspondent à votre recherche : <u>" . $Pays . "</u>" . ($Debut ? " (Début)" : "") . "</h3> <br>");  
        echo("Voici la liste des pays ci-dessous : <br><br><br>"); 
        
        for ($i = 0; $i < count($data); $i++) {
            $vu = false;
            if (!$vu &&$Debut) {
                $tmp = substr($data[$i]['country-name'], 0, $paysLen);
                if ($tmp == $Pays) {
                    $vu = true;
                    print("<tr>");

                    $nomPays = $data[$i]['country-name'];
                    $Capitale = $data[$i]['capital'];
                    $nomCode = $data[$i]['iso2'];
                    $Drapeau = "<img src=https://flagsapi.com/" . $nomCode . "/flat/64.png />";
                    print("<td> " . $nomPays . " </td>");
                    print("<td> " . $Capitale . " </td>");
                    print("<td> &nbsp;&nbsp;" . $nomCode . " &nbsp;&nbsp;</td>");
                    print("<td> &nbsp;" . $Drapeau . "&nbsp; </td>");
                    print("</tr>");
                }
                
            }
            else if (!$vu && $Fin){
                $tmp = substr($data[$i]['country-name'], $lenData-$paysLen);
                if ($tmp == $Pays) {
                    $vu = true;
                    print("<tr>");
                    
                    $nomPays = $data[$i]['country-name'];
                    $Capitale = $data[$i]['capital'];
                    $nomCode = $data[$i]['iso2'];
                    $Drapeau = "<img src=https://flagsapi.com/" . $nomCode . "/flat/64.png />";
                    print("<td> " . $nomPays . " </td>");
                    print("<td> " . $Capitale . " </td>");
                    print("<td> &nbsp;&nbsp;" . $nomCode . " &nbsp;&nbsp;</td>");
                    print("<td> &nbsp;" . $Drapeau . "&nbsp; </td>");
                    print("</tr>");
                

                }
            }

            
        }
    }

    else {
        echo("<h3> Aucun resultat ne correspond à votre recherche : <u>" . $Pays . "</u></h3> <br>");  
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
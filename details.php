<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chercher.php</title>
</head>

<?php

$json = file_get_contents('countries.json');
$data = json_decode($json, true);

$Pays = isset($_GET['Pays']) ? $_GET['Pays'] : '';
$ISO2 = isset($_GET['iso2']) ? $_GET['iso2'] : '';
$ISO3 = isset($_GET['iso3']) ? $_GET['iso3'] : '';
$TOPLEVELDOMAIN = isset($_GET['top-level-domain']) ? $_GET['top-level-domain'] : '';
$FIPS = isset($_GET['fips']) ? $_GET['fips'] : '';
$ISONUMERIC = isset($_GET['iso-numeric']) ? $_GET['iso-numeric'] : '';
$GEONAMEID = isset($_GET['geonameid']) ? $_GET['geonameid'] : '';
$E164 = isset($_GET['e164']) ? $_GET['e164'] : '';
$PHONECODE = isset($_GET['phone-code']) ? $_GET['phone-code'] : '';
$CONTINENT = isset($_GET['continent']) ? $_GET['continent'] : '';
$CAPITAL = isset($_GET['capital']) ? $_GET['capital'] : '';
$TIMEZONEINCAPITAL = isset($_GET['time-zone-in-capital']) ? $_GET['time-zone-in-capital'] : '';
$CURRENCY = isset($_GET['currency']) ? $_GET['currency'] : '';
$LANGUAGECODES = isset($_GET['language-codes']) ? $_GET['language-codes'] : '';
$LANGUAGES = isset($_GET['languages']) ? $_GET['languages'] : '';
$AREAKM2 = isset($_GET['area-km2']) ? $_GET['area-km2'] : '';
$INTERNETHOSTS = isset($_GET['internet-hosts']) ? $_GET['internet-hosts'] : '';
$INTERUSERS = isset($_GET['internet-users']) ? $_GET['internet-users'] : '';
$PHONEMOBILE = isset($_GET['phones-mobile']) ? $_GET['phones-mobile'] : '';
$PHONELANDLINE = isset($_GET['phones-landline']) ? $_GET['phones-landline'] : '';
$GDP = isset($_GET['gdp']) ? $_GET['gdp'] : '';

?>

<body>

<h1>Détails sur le pays <?php echo $Pays; ?></h1>

<?php

    foreach ($data as $country) {
        if ($country['country-name'] === $Pays) {
            $paysData = $country;
            break;
        }
    }
    /*on peut ajouter un bouton pour modifier les informations du pays sans modifier le nom du pays */

    print("<form action = 'details.php\"  method=\"GET\"> <input type=\"hidden\" name=\"Pays\" value=\"" . $paysData['country-name'] . "\">");
    print("<button>Modifier</button>");
    print("</form>");

    print("<p> Nom du pays : " . $paysData['country-name'] . "</p>");
    print("<p><img src='https://flagsapi.com/" . $paysData['iso2'] . "/flat/64.png' /></p>");
    print("<p> Code ISO2 : " . $paysData['iso2'] . "</p>");

    print("<form action = 'details.php'  method='GET'> <input type='hidden' name='Pays' value='" . $paysData['country-name'] . "'>");
    print("<button name='iso2' value='" . $paysData['iso2'] . "'>Modifier</button>");
    print("</form>");

    print("<p> Code ISO3 : " . $paysData['iso3'] . "</p>");
    print("<p> Domaine de premier niveau : " . $paysData['top-level-domain'] . "</p>");
    print("<p> FIPS : " . $paysData['fips'] . "</p>");
    print("<p> ISO Numérique : " . $paysData['iso-numeric'] . "</p>");
    print("<p> ID Géoname : " . $paysData['geonameid'] . "</p>");
    print("<p> E164 : " . $paysData['e164'] . "</p>");
    print("<p> Code téléphonique : " . $paysData['phone-code'] . "</p>");
    print("<p> Continent : " . $paysData['continent'] . "</p>");
    print("<p> Capitale : " . $paysData['capital'] . "</p>");
    print("<p> Fuseau horaire de la capitale : " . $paysData['time-zone-in-capital'] . "</p>");
    print("<p> Devise : " . $paysData['currency'] . "</p>");
    print("<p> Codes de langue : " . $paysData['language-codes'] . "</p>");
    print("<p> Langues : " . $paysData['languages'] . "</p>");
    print("<p> Superficie (km²) : " . $paysData['area-km2'] . "</p>");
    print("<p> Hôtes Internet : " . $paysData['internet-hosts'] . "</p>");
    print("<p> Utilisateurs Internet : " . $paysData['internet-users'] . "</p>");
    print("<p> Téléphones mobiles : " . $paysData['phones-mobile'] . "</p>");
    print("<p> Téléphones fixes : " . $paysData['phones-landline'] . "</p>");
    print("<p> PIB : " . $paysData['gdp'] . "</p>");

?>


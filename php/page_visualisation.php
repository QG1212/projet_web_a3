<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once ('../php/database.php')
function pdc(){
    $db = dbconnect();

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT 
                p.id_pdc_itinerance AS 'ID_PDC',
                s.nom_station AS 'Nom_Station',
                p.puissance_nominale AS 'Puissance_kW',
                p.tarification AS 'Tarif_Euros',
                c.denomination_acces AS 'Condition_Acces',
                t.denomination_prise AS 'Type_Prise'
            FROM pdc p
            JOIN station s ON p.id_station_itinerance = s.id_station_itinerance
            JOIN condition_acces c ON p.id_condition_acces = c.id_condition_acces
            JOIN Avoir a ON p.id_pdc_itinerance = a.id_pdc_itinerance
            JOIN prise_type t ON a.id_prise = t.id_prise";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($resultats);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'erreur',
        'message' => 'Erreur de base de données : ' . $e->getMessage()
    ]);
}
}

?>
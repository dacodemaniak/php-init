<?php
/**
 * /index.php
 * @author ADRAR - jean-luc.a@ideafactory.fr - Sept. 2020
 * @version 1.0.0
 *  Point d'entrée de l'application PHP
 */
ini_set('display_errors', true);
error_reporting(E_ALL);



// Charger le fichier qui contient la définition de la classe Request
require_once(__DIR__ . '/../src/Core/Http/Request/Request.php');


// Créer une instance de l'objet Request
$request = new Request();

// Récupérer une "Réponse"
$response = $request->process();

// Envoyer la réponse vers le client
$response->send();
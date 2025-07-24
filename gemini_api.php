<?php
require_once __DIR__ . '/vendor/autoload.php';

use Google\Cloud\VertexAI\V1\PredictionServiceClient;
use Google\Cloud\AIPlatform\V1\PublisherModelName;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

function analyzeToothWithGemini($tooth, $complaint, $painLevel) {
    $apiKey = $_ENV['GEMINI_API_KEY'];

    $prompt = "Diş numarası: $tooth\nŞikayet: $complaint\nAğrı seviyesi: $painLevel\n
    Lütfen bir diş sağlığı uzmanı gibi bu şikayetle ilgili öneride bulun.";

    $postData = [
        "contents" => [[
            "parts" => [[ "text" => $prompt ]]
        ]]
    ];

    $ch = curl_init("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=$apiKey");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [ "Content-Type: application/json" ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
        return $data['candidates'][0]['content']['parts'][0]['text'];
    } else {
        return "❌ Yapay zeka yanıtı alınamadı.";
    }
}

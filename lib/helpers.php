<?php
require __DIR__ . "/../vendor/autoload.php";
use Symfony\Component\HttpClient\HttpClient;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();
$apiUrl     = $_ENV['TELEGRAM_ENDPOINT'];
$httpClient = HttpClient::create();

class Http
{
   public $url;

   public function __construct($method)
   {
      global $apiUrl;
      $this->url = $apiUrl . $method;
   }
   public function getReq($query = [])
   {
      global $httpClient;
      $response = $httpClient->request('GET', $this->url, [
         'query' => $query
      ]);
      $content = $response->getContent();

      return $content;
   }
   public function postReq($body = [])
   {
      global $httpClient;
      $response = $httpClient->request('POST', $this->url, [
         'body' => $body
      ]);
      $content = $response->getContent();

      return $content;
   }
}

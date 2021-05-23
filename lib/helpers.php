<?php
require __DIR__ . "/../vendor/autoload.php";
use Symfony\Component\HttpClient\HttpClient;

//Loading ENVs
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();

$apiUrl     = $_ENV['TELEGRAM_ENDPOINT'];
$httpClient = HttpClient::create();

// For GET & POST requests utility function
class Http
{
   private $url, $method;

   public function __construct($method, $url = '')
   {
      global $apiUrl;
      if ($url) {
         $this->url = $url;
      } else {
         $this->url = $apiUrl;
      }
      $this->method = $method;
   }
   public function getReq($query = [])
   {
      global $httpClient;
      $response = $httpClient->request('GET', $this->url . $this->method, [
         'query' => $query
      ]);
      $content = $response->getContent();

      return $content;
   }
   public function postReq($body = [])
   {
      global $httpClient;
      $response = $httpClient->request('POST', $this->url . $this->method, [
         'body' => $body
      ]);
      $content = $response->getContent();

      return $content;
   }
}

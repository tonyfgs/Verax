<?php

namespace modele;

// require __DIR__ . '/vendor/autoload.php';

use modele\IArticleDataManager;
use metier\Article;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class articlesService implements IArticleDataManager {
    private $client;
    private $apiBaseUrl;

    public function __construct($apiBaseUrl) {
        $this->apiBaseUrl = $apiBaseUrl;
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $this->apiBaseUrl,
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
    }

    public function getAllArticles() : array {
        try {
            $response = $this->client->request('GET', '/articles');
            $body = $response->getBody();
            $articles = json_decode($body, true);
            return $articles;
        } catch (GuzzleException $e) {
            echo "Erreur lors de la récupération des articles : " . $e->getMessage();
            return [];
        }
    }

    public function getArticle($id) : Article {
        try {
            $response = $this->client->request('GET', "/articles/{$id}");
            $body = $response->getBody();
            $article = json_decode($body, true);
            return $article;
        } catch (GuzzleException $e) {
            echo "Erreur lors de la récupération de l'article : " . $e->getMessage();
            return null;
        }
    }

    public function getDerniersArticles($nbArticles) {
        // Cette méthode pourrait être implémentée de manière similaire si votre API supporte cette fonctionnalité
        throw new \Exception("getDerniersArticles method not implemented.");
    }
}

// Exemple d'utilisation
// $articlesService = new ArticlesService('http://181.214.189.133:9092');
// $articles = $articlesService->getAllArticles();
// print_r($articles);
<?php

namespace Tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    protected $client;

    protected function setUp():void
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost:8888'
        ]);
    }

    public function testCreateLoan()
    {
        $response = $this->client->post('/api/loans', [
            'json' => [
                'sum' => 7000
            ]
        ]);
        $this->assertEquals(201, $response->getStatusCode());
    }

    public function testUpdateLoan()
    {
        $response = $this->client->put('/api/loans/1', [
            'json' => [
                'sum' => 8000
            ]
        ]);
        $this->assertEquals(204, $response->getStatusCode());
    }

    public function testGetLoansWithoutQueryParams()
    {
        $response = $this->client->get('/api/loans');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetLoansWithParams()
    {
        $response = $this->client->get('/api/loans', [
            'query' => [
                'dateCreate' => date('Y-m-d')
            ]
        ]);
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->client->get('/api/loans', [
            'query' => [
                'sum' => 8000
            ]
        ]);
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->client->get('/api/loans', [
            'query' => [
                'sum' => 8000,
                'dateCreate' => date('Y-m-d')
            ]
        ]);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDeleteLoan()
    {
        $response = $this->client->delete('/api/loans/1');
        $this->assertEquals(204, $response->getStatusCode());
    }

}
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testName()
    {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText('hello response');
    }

    public function testHeader()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertSeeText('Febri')->assertSeeText("Lubis")
            ->assertHeader('Content-Type','application/json')
            ->assertHeader('Author', 'Febri Ananda Lubis')
            ->assertHeader('App', 'Belajar Laravel');
    }

    public function testView()
    {
        $this->get('/response/type/view')
            ->assertSeeText('Hello Febri');
    }

    public function testJson()
    {
        $this->get('/response/type/json')
            ->assertJson([
                'firstName' => "Febri",
                "lastName" => "Lubis"
            ]);
    }

    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'image/png');
    }

    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertDownload('febri.png');
    }


}

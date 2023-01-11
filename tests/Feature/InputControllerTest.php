<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Febri')
            ->assertSeeText("Hello Febri");

        $this->post('/input/hello', [
            "name" => "Febri"
        ]) ->assertSeeText("Hello Febri");
    }

    public function testInputNested()
    {
        $this->post('/input/hello/first',[
            "name" => [
                "first" => "Febri",
                "last" => "Ananda"
            ]
        ]) ->assertSeeText("Hello Febri");
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            "name" => [
                "first" => "Febri",
                "last" => "Ananda"
            ]
        ])->assertSeeText("name")->assertSeeText("first")
            ->assertSeeText("last")->assertSeeText("Febri")
            ->assertSeeText("Ananda");
    }

    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            "products" => [
                [
                    "name" => "Apple Mac Book Pro",
                    "price" => 30000000
                ],
                [
                    "name" => "Samsung Galaxy S10",
                    "price" => 1500000
                ]
            ]
        ]) ->assertSeeText("Apple Mac Book Pro")
            ->assertSeeText("Samsung Galaxy S10");
    }

    public function testInputType()
    {
        $this->post('/input/hello/type', [
            "name" => "Budi",
            "married" => "true",
            "birth_date" => "1990-10-10"
        ])->assertSeeText('Budi')
            ->assertSeeText("true")
            ->assertSeeText("1990-10-10");
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "Febri",
                "middle" => "Ananda",
                "last" => "Lubis"
            ]
        ])->assertSeeText("Febri")
            ->assertSeeText("Lubis")
            ->assertDontSeeText("Ananda");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            "username" => "febri123",
            "password" => "rahasia",
            "admin" => "true"
        ])->assertSeeText("febri123")
            ->assertSeeText("rahasia")
            ->assertDontSeeText("admin");
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge',[
            "username" => "febri123",
            "password" => "rahasia",
            "admin" => true
        ])->assertSeeText("febri123")
            ->assertSeeText("rahasia")
            ->assertSeeText("admin")
            ->assertSeeText("false");
    }


}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $firstname1 = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        self::assertEquals($firstname1, $firstName2);

        var_dump(Config::all());
    }

    public function testConfigDependency()
    {
        $config = $this->app->make('config');
        $firstName3 = $config->get('contoh.author.first');

        $firstname1 = config('contoh.author.first');
        $firstName2 = Config::get('contoh.author.first');

        self::assertEquals($firstname1, $firstName2);
        self::assertEquals($firstname1, $firstName3);

        var_dump(Config::all());
    }

    public function testFacadeMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('Febri Keren');

        $firstName = Config::get('contoh.author.first');

        self::assertEquals('Febri Keren', $firstName);
    }


}

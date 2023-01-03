<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Febri');

        $this->get('/hello-again')
            ->assertSeeText('Hello Febri');
    }

    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('World Febri');
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'Febri'])
            ->assertSeeText('Hello Febri');

        $this->view('hello.world', ['name' => 'Febri'])
            ->assertSeeText('World Febri');
    }


}

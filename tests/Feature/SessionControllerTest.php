<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testCreateSession()
    {
        $this->get("/session/create")
            ->assertSeeText("OK")
            ->assertSessionHas("UserId", "Febri")
            ->assertSessionHas("IsMember", true);
    }

    public function testGetSession()
    {
        $this->withSession([
            "UserId" => "Febri",
            "IsMember" => "true"
        ])->get('/session/get')
            ->assertSeeText("User ID : Febri, Is Member : true");

    }

    public function testSessionFailed()
    {
        $this->withSession([])->get('/session/get')
            ->assertSeeText("User ID : guest, Is Member : false");
    }

}

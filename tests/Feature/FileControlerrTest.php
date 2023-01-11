<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileControlerrTest extends TestCase
{
    public function testUpload()
    {
        $picture = UploadedFile::fake()->image('febri.png');

        $this->post('/file/upload', [
            'picture' => $picture
        ])->assertSeeText("OK febri.png");
    }

}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileStorageTest extends TestCase
{
    public function testStorage()
    {
        $fileSystem = Storage::disk("local");

        $fileSystem->put("file.txt", "Febri Ananda Lubis");

        $content = $fileSystem->get("file.txt");

        self::assertEquals("Febri Ananda Lubis", $content);
    }

    public function testPublic()
    {
        $filesystem = Storage::disk('public');

        $filesystem->put('file.txt', "Febri Ananda Lubis");

        $content = $filesystem->get("file.txt");

        self::assertEquals('Febri Ananda Lubis', $content);
    }

}

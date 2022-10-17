<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class TestStorage extends TestCase
{
    public function testStorage()
    {
        $filesystem = Storage::disk("local");
        $filesystem->put("file.txt", "Put Your Content Here");
        self::assertEquals("Put Your Content Here", $filesystem->get("file.txt"));
    }

    public function testUpload()
    {
        $image = UploadedFile::fake()->image("tegar.png");

        $this->post('/file/upload', [
            'picture' => $image
        ])->assertSeeText("OK : tegar.png");
    }
}

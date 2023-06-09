<?php

namespace Tests\Unit\Actions;

use App\Actions\StoreCompanyLogo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StoreCompanyLogoTest extends TestCase
{
    public function test_empty_file(): void
    {
        $this->assertNull(
            resolve(StoreCompanyLogo::class)->execute(null)
        );
    }

    public function test_actual_file(): void
    {
        $storage = Storage::fake();

        $logo = UploadedFile::fake()->image('my-logo.png');

        $storedFile = resolve(StoreCompanyLogo::class)->execute($logo);

        $this->assertStringStartsWith('/storage/company-logos/', $storedFile);

        $storage->assertExists('public/company-logos/'.$logo->hashName());
    }
}

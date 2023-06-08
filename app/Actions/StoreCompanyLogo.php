<?php

namespace App\Actions;

use Illuminate\Http\UploadedFile;

/**
 * When handling user inputs, we store the logo in a temp directory.
 * Before saving the path to database, we should move that to a public storage.
 */
class StoreCompanyLogo
{
    public function execute(?UploadedFile $file): ?string
    {
        if (! $file) {
            return null;
        }

        $logoPath = $file->storePublicly('public/company-logos');

        // Because the path will be served in public storage, we need to adjust the path again
        // so its ready to be rendered in <img> element.
        // Note: prefix "/" to ensure the image URL is relative to root domain when rendering in views.
        return str($logoPath)->replaceFirst('public/', '/storage/');
    }
}

<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Orchid\Platform\Events\UploadFileEvent;

class UploadListener
{
    public function handle(UploadFileEvent $event)
    {
        $storage = Storage::disk('public');
        $attachment = $event->attachment;
        $filename = "$attachment->name.$attachment->extension";
        $path = $attachment->path . $filename;

        if ($storage->exists($path)) {
            $image = Image::make($storage->path($path));

            if ($attachment->group === 'product.thumbnail') {
                $image->resize(500);
                $image->crop(200, 200);
            }

            if ($attachment->group === 'product.all') {
                $image->resize(800);
            }

            $image->save();
        }
    }
}

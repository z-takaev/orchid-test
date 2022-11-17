<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\AsSource;

class Product extends Model
{
    use HasFactory;
    use AsSource;
    use Attachable;

    protected $fillable = [
      'name',
      'description',
      'price',
      'thumbnail',
    ];

    public function preview()
    {
        return $this->hasOne(Attachment::class, 'id', 'thumbnail')
            ->withDefault();
    }

}

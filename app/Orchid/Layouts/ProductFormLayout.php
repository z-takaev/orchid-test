<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class ProductFormLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('product.id')
                ->hidden(),
            Cropper::make('product.thumbnail')
                ->title('Превью')
                ->groups('product.thumbnail')
                ->targetId(),
            Upload::make('product.attachment')
                ->title('Все изображения')
                ->groups('product.all'),
            Input::make('product.name')
                ->required(),
            Quill::make('product.description'),
            Input::make('product.price')
                ->type('number')
                ->required(),
            Button::make('Сохранить')
                ->method('updateOrCreate')
        ];
    }
}

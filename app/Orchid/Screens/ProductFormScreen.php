<?php

namespace App\Orchid\Screens;

use App\Models\Product;
use App\Orchid\Layouts\ProductFormLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;

class ProductFormScreen extends Screen
{
    public $product;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Product $product): iterable
    {
        return [
            'product' => $product,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->product->exists ? 'Редактирование' : 'Создание';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Удалить')
                ->method('remove'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ProductFormLayout::class,
        ];
    }


    /**
     * @param Request $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function updateOrCreate(Request $request, Product $product): RedirectResponse
    {
        $data = $request->get('product');

        $product->exists
            ? $product->update($data)
            : Product::create($data);

        return redirect()
                ->route('platform.products');
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function remove(Product $product): RedirectResponse
    {
        $product->deleteOrFail();

        return redirect()
            ->route('platform.products');
    }
}

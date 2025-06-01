<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // Не забудь импортировать модель Category
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Для валидации

class ProductController extends Controller
{
    /**
     * Отображает список всех товаров. [cite: 3]
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Получаем все товары с их категориями
        $products = Product::with('category')->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Показывает форму для создания нового товара. [cite: 3]
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(); // Получаем все категории для выпадающего списка
        return view('products.create', compact('categories'));
    }

    /**
     * Сохраняет новый товар в базе данных. [cite: 3]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Валидация данных [cite: 12]
        $request->validate([
            'name' => 'required|string|max:255', 
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string', 
            'price' => 'required|numeric|min:0.01', // Цена должна быть числом и больше 0 [cite: 11]
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
                         ->with('success', 'Товар успешно добавлен.');
    }

    /**
     * Отображает полную информацию о конкретном товаре. [cite: 3]
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // Автоматически загружает категорию благодаря Product::with('category') в index
        // Если переходим сюда напрямую, можно использовать $product->load('category');
        return view('products.show', compact('product'));
    }

    /**
     * Показывает форму для редактирования существующего товара. [cite: 3]
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Обновляет информацию о товаре в базе данных. [cite: 3]
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // Валидация данных [cite: 12]
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
                         ->with('success', 'Товар успешно обновлен.');
    }

    /**
     * Удаляет товар из базы данных. [cite: 3]
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Товар успешно удален.');
    }
}
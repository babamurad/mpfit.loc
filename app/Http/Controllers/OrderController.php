<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product; // Не забудь импортировать модель Product
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Для валидации

class OrderController extends Controller
{
    /**
     * Отображает список всех заказов.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Получаем все заказы с их товарами
        $orders = Order::with('product')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    /**
     * Показывает форму для создания нового заказа. [cite: 4]
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all(); // Получаем все товары для выбора в заказе
        return view('orders.create', compact('products'));
    }

    /**
     * Сохраняет новый заказ в базе данных. [cite: 4]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Валидация данных [cite: 12]
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id', // Товар должен существовать [cite: 10]
            'quantity' => 'required|integer|min:1', // Количество должно быть целым числом, минимум 1 [cite: 4]
            'customer_comment' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id); // Находим выбранный товар
        $totalPrice = $product->price * $request->quantity; // Расчитываем итоговую цену

        Order::create([
            'customer_name' => $request->customer_name,
            'order_date' => now(), // Дата создания, по умолчанию текущая [cite: 5]
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice, // Автоматический расчет
            'status' => 'new', // По умолчанию "новый" [cite: 5]
            'customer_comment' => $request->customer_comment,
        ]);

        return redirect()->route('orders.index')
                         ->with('success', 'Заказ успешно добавлен.');
    }

    /**
     * Отображает полную информацию о конкретном заказе. [cite: 7]
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        // Автоматически загружает товар благодаря Order::with('product') в index
        // Если переходим сюда напрямую, можно использовать $order->load('product');
        return view('orders.show', compact('order'));
    }

    /**
     * Показывает форму для редактирования существующего заказа. (Не требуется по ТЗ, но для полноты CRUD)
     * Если нужно только изменение статуса, этот метод можно удалить или использовать для этого.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $products = Product::all();
        return view('orders.edit', compact('order', 'products'));
    }

    /**
     * Обновляет информацию о заказе в базе данных. [cite: 7]
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // Для update мы будем использовать его в основном для изменения статуса,
        // но здесь оставлена полная валидация, если потребуется.
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0.01', // Цена обновляется автоматически при store, но при edit может быть изменена вручную
            'status' => ['required', Rule::in(['new', 'completed'])],
            'customer_comment' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id); // Находим выбранный товар
        $totalPrice = $product->price * $request->quantity; // Перерасчитываем итоговую цену

        $order->update(array_merge($request->all(), ['total_price' => $totalPrice]));

        return redirect()->route('orders.index')
                         ->with('success', 'Заказ успешно обновлен.');
    }

    /**
     * Удаляет заказ из базы данных.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')
                         ->with('success', 'Заказ успешно удален.');
    }

    /**
     * Изменяет статус заказа на "выполнен". [cite: 7]
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function complete(Order $order)
    {
        $order->update(['status' => 'completed']);

        return redirect()->route('orders.show', $order->id)
                         ->with('success', 'Статус заказа успешно изменен на "выполнен".');
    }
}
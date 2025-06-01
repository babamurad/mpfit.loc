@extends('layouts.app')

@section('title', 'Просмотр заказа: ' . $order->id)

@section('content')
    <h1>Заказ №{{ $order->id }}</h1>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Вернуться к списку</a>

    <div>
        <strong>Номер заказа:</strong> {{ $order->id }}<br> [cite: 6]
        <strong>Дата создания:</strong> {{ $order->created_at->format('d.m.Y H:i') }}<br> [cite: 6]
        <strong>ФИО покупателя:</strong> {{ $order->customer_name }}<br> [cite: 6]
        <strong>Товар:</strong> {{ $order->product->name }}<br>
        <strong>Количество:</strong> {{ $order->quantity }} шт.<br>
        <strong>Итоговая цена:</strong> {{ number_format($order->total_price, 2, ',', ' ') }} руб.<br> [cite: 6]
        <strong>Статус:</strong> {{ $order->status == 'new' ? 'Новый' : 'Выполнен' }}<br> [cite: 6]
        <strong>Комментарий покупателя:</strong> {{ $order->customer_comment ?? 'Нет комментария' }}<br> [cite: 6]
        <strong>Последнее обновление:</strong> {{ $order->updated_at->format('d.m.Y H:i') }}
    </div>

    <div class="form-actions">
        @if ($order->status == 'new')
            <form action="{{ route('orders.complete', $order->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('PATCH') {{-- Используем PATCH для частичного обновления --}}
                <button type="submit" class="btn btn-success" onclick="return confirm('Вы уверены, что хотите изменить статус заказа на "выполнен"?');">
                    Отметить как "выполнен"
                </button> [cite: 7]
            </form>
        @else
            <button class="btn btn-success" disabled>Заказ выполнен</button>
        @endif
        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить этот заказ?');">Удалить заказ</button>
        </form>
    </div>
@endsection
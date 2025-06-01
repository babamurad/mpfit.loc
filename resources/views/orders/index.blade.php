@extends('layouts.app')

@section('title', 'Список заказов')

@section('content')
    <h1>Список заказов</h1>
    <a href="{{ route('orders.create') }}" class="btn btn-primary">Добавить новый заказ</a>
    <table>
        <thead>
            <tr>
                <th>Номер заказа (ID)</th>
                <th>Дата создания</th>
                <th>ФИО покупателя</th>
                <th>Статус</th>
                <th>Итоговая цена</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->status == 'new' ? 'Новый' : 'Выполнен' }}</td>
                    <td>{{ number_format($order->total_price, 2, ',', ' ') }} руб.</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info">Просмотр</a>
                        {{-- Редактирование заказа (не строго по ТЗ, но может быть полезно) --}}
                        {{-- <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Редактировать</a> --}}
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить этот заказ?');">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Заказы пока не добавлены.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $orders->links() }}
@endsection
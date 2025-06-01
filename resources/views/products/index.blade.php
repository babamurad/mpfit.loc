@extends('layouts.app')

@section('title', 'Список товаров')

@section('content')
    <h1>Список товаров</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Добавить новый товар</a>
    <table>
        <thead>
            <tr>
                <th>Название</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ number_format($product->price, 2, ',', ' ') }} руб.</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Просмотр</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Редактировать</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить этот товар?');">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Товары пока не добавлены.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $products->links() }}
@endsection
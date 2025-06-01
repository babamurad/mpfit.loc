@extends('layouts.app')

@section('title', 'Просмотр товара: ' . $product->name)

@section('content')
    <h1>{{ $product->name }}</h1>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Вернуться к списку</a>

    <div>
        <strong>Название:</strong> {{ $product->name }}<br>
        <strong>Категория:</strong> {{ $product->category->name }}<br>
        <strong>Описание:</strong> {{ $product->description ?? 'Нет описания' }}<br>
        <strong>Цена:</strong> {{ number_format($product->price, 2, ',', ' ') }} руб.<br>
        <strong>Создан:</strong> {{ $product->created_at->format('d.m.Y H:i') }}<br>
        <strong>Обновлен:</strong> {{ $product->updated_at->format('d.m.Y H:i') }}
    </div>

    <div class="form-actions">
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Редактировать</a>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить этот товар?');">Удалить</button>
        </form>
    </div>
@endsection
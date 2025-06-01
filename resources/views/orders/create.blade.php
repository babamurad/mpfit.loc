@extends('layouts.app')

@section('title', 'Добавить заказ')

@section('content')
    <h1>Добавить новый заказ</h1>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Вернуться к списку</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="customer_name">ФИО покупателя:</label> [cite: 5]
            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required>
        </div>
        <div class="form-group">
            <label for="product_id">Товар:</label>
            <select name="product_id" id="product_id" required>
                <option value="">Выберите товар</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" data-price="{{ $product->price }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }} ({{ number_format($product->price, 2, ',', ' ') }} руб.)
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Количество:</label> [cite: 4]
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}" min="1" required>
        </div>
        {{-- Дата создания и статус устанавливаются автоматически в контроллере --}}
        <div class="form-group">
            <label for="customer_comment">Комментарий покупателя:</label> [cite: 6]
            <textarea name="customer_comment" id="customer_comment" rows="3">{{ old('customer_comment') }}</textarea>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Создать заказ</button>
        </div>
    </form>
@endsection
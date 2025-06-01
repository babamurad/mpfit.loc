@extends('layouts.app')

@section('title', 'Редактировать товар: ' . $product->name)

@section('content')
    <h1>Редактировать товар: {{ $product->name }}</h1>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Вернуться к списку</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Используем PUT метод для обновления --}}
        <div class="form-group">
            <label for="name">Название:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
        </div>
        <div class="form-group">
            <label for="category_id">Категория:</label>
            <select name="category_id" id="category_id" required>
                <option value="">Выберите категорию</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Описание:</label>
            <textarea name="description" id="description" rows="5">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Цена (руб.):</label>
            <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $product->price) }}" required>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Обновить товар</button>
        </div>
    </form>
@endsection
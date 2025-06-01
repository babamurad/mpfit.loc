{{-- Этот файл не является обязательным по ТЗ, так как требуется только изменение статуса через кнопку.
     Но если нужно полноценное редактирование заказа, его можно использовать. --}}
     @extends('layouts.app')

     @section('title', 'Редактировать заказ: ' . $order->id)
     
     @section('content')
         <h1>Редактировать заказ: {{ $order->id }}</h1>
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
     
         <form action="{{ route('orders.update', $order->id) }}" method="POST">
             @csrf
             @method('PUT')
             <div class="form-group">
                 <label for="customer_name">ФИО покупателя:</label>
                 <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', $order->customer_name) }}" required>
             </div>
             <div class="form-group">
                 <label for="product_id">Товар:</label>
                 <select name="product_id" id="product_id" required>
                     <option value="">Выберите товар</option>
                     @foreach($products as $product)
                         <option value="{{ $product->id }}" {{ old('product_id', $order->product_id) == $product->id ? 'selected' : '' }}>
                             {{ $product->name }} ({{ number_format($product->price, 2, ',', ' ') }} руб.)
                         </option>
                     @endforeach
                 </select>
             </div>
             <div class="form-group">
                 <label for="quantity">Количество:</label>
                 <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $order->quantity) }}" min="1" required>
             </div>
             <div class="form-group">
                 <label for="status">Статус:</label>
                 <select name="status" id="status" required>
                     <option value="new" {{ old('status', $order->status) == 'new' ? 'selected' : '' }}>Новый</option>
                     <option value="completed" {{ old('status', $order->status) == 'completed' ? 'selected' : '' }}>Выполнен</option>
                 </select>
             </div>
             <div class="form-group">
                 <label for="customer_comment">Комментарий покупателя:</label>
                 <textarea name="customer_comment" id="customer_comment" rows="3">{{ old('customer_comment', $order->customer_comment) }}</textarea>
             </div>
             <div class="form-actions">
                 <button type="submit" class="btn btn-success">Обновить заказ</button>
             </div>
         </form>
     @endsection
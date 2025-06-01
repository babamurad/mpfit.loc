<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Получим некоторые товары для создания заказов
        $product1 = Product::where('name', 'Книга "Путешествие по Laravel"')->first();
        $product2 = Product::where('name', 'Стеклянная ваза')->first();
        $product3 = Product::where('name', 'Гиря 16 кг')->first();

        if (!$product1 || !$product2 || !$product3) {
            $this->command->info('Не удалось найти необходимые продукты для OrderSeeder. Убедитесь, что ProductSeeder был запущен.');
            return;
        }

        Order::create([
            'customer_name' => 'Иванов Иван Иванович',
            'order_date' => now(), // Текущая дата и время
            'product_id' => $product1->id,
            'quantity' => 1,
            'total_price' => $product1->price * 1,
            'status' => 'new',
            'customer_comment' => 'Подарок на день рождения',
        ]);

        Order::create([
            'customer_name' => 'Петрова Анна Сергеевна',
            'order_date' => now()->subDays(5), // Заказ 5 дней назад
            'product_id' => $product2->id,
            'quantity' => 1,
            'total_price' => $product2->price * 1,
            'status' => 'completed', // Этот заказ уже выполнен
            'customer_comment' => null,
        ]);

        Order::create([
            'customer_name' => 'Сидоров Алексей Дмитриевич',
            'order_date' => now(),
            'product_id' => $product3->id,
            'quantity' => 2,
            'total_price' => $product3->price * 2, // 2 гири
            'status' => 'new',
            'customer_comment' => 'Доставка после 18:00',
        ]);
    }    
}

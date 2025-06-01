<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Убедимся, что категории существуют
        $categoryLight = Category::where('name', 'легкий')->first();
        $categoryFragile = Category::where('name', 'хрупкий')->first();
        $categoryHeavy = Category::where('name', 'тяжелый')->first();

        // Если категории не существуют (чего быть не должно после CategorySeeder), создадим их
        if (!$categoryLight) $categoryLight = Category::create(['name' => 'легкий']);
        if (!$categoryFragile) $categoryFragile = Category::create(['name' => 'хрупкий']);
        if (!$categoryHeavy) $categoryHeavy = Category::create(['name' => 'тяжелый']);


        Product::create([
            'name' => 'Книга "Путешествие по Laravel"',
            'category_id' => $categoryLight->id,
            'description' => 'Увлекательное руководство по разработке на Laravel.',
            'price' => 1250.75,
        ]);

        Product::create([
            'name' => 'Стеклянная ваза',
            'category_id' => $categoryFragile->id,
            'description' => 'Элегантная ваза из тонкого стекла, ручная работа.',
            'price' => 3500.00,
        ]);

        Product::create([
            'name' => 'Гиря 16 кг',
            'category_id' => $categoryHeavy->id,
            'description' => 'Чугунная гиря для занятий спортом.',
            'price' => 2100.50,
        ]);

        Product::create([
            'name' => 'Настольная лампа',
            'category_id' => $categoryLight->id,
            'description' => 'Современная настольная лампа с регулировкой яркости.',
            'price' => 999.99,
        ]);

        Product::create([
            'name' => 'Хрустальные бокалы (набор 6 шт.)',
            'category_id' => $categoryFragile->id,
            'description' => 'Набор из 6 изысканных хрустальных бокалов для вина.',
            'price' => 5800.00,
        ]);
    
    }
}

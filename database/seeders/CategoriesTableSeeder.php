<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electronics',
            'Furniture',
            'Stationery',
            'Classroom Supplies',
            'Laboratory Equipment',
            'Books',
            'Sports Equipment',
            'Cleaning Supplies',
            'IT Accessories',
            'Multimedia & Audio-Visual',
            'Safety and Security',
            'Uniforms and Apparel',
            'Maintenance Tools'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}

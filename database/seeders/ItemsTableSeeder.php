<?php

namespace Database\Seeders;

use App\Models\Items;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [1, 2, 3, 4]; // Example category IDs

        $items = [
            [
                'name' => 'Laptop',
                'category' => $categories[0], // Electronics
                'description' => 'A personal computer for mobile use.',
                'amount' => 10,
                'image' => 'item_image/laptop.png' // Ensure this image exists in the storage
            ],
            [
                'name' => 'Whiteboard',
                'category' => $categories[1], // Furniture
                'description' => 'A board for writing or drawing with markers.',
                'amount' => 5,
                'image' => 'item_image/whiteboard.png' // Ensure this image exists in the storage
            ],
            [
                'name' => 'Biology Textbook',
                'category' => $categories[2], // Books
                'description' => 'A comprehensive guide to biology.',
                'amount' => 15,
                'image' => 'item_image/biology_textbook.jpeg' // Ensure this image exists in the storage
            ],
            [
                'name' => 'Basketball',
                'category' => $categories[3], // Sports Equipment
                'description' => 'Official size basketball for games.',
                'amount' => 8,
                'image' => 'item_image/basketball.jpeg' // Ensure this image exists in the storage
            ],
        ];

        foreach ($items as $item) {
            Items::create($item);
        }
    }
}

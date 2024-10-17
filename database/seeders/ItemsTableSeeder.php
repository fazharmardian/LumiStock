<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [1, 2, 3, 4, 5, 6]; // Example category IDs

        $items = [
            [
                'name' => 'Laptop',
                'category_id' => $categories[0], // Electronics
                'description' => 'A lightweight laptop with 16GB RAM and 512GB SSD.',
                'amount' => 12,
                'image' => 'item_images/laptop.png' // Ensure this image exists in the storage
            ],
            [
                'name' => 'Whiteboard',
                'category_id' => $categories[1], // Furniture
                'description' => 'A board for writing or drawing with markers.',
                'amount' => 5,
                'image' => 'item_images/whiteboard.png' // Ensure this image exists in the storage
            ],
            [
                'name' => 'Biology Textbook',
                'category_id' => $categories[2], // Books
                'description' => 'A comprehensive guide to biology.',
                'amount' => 15,
                'image' => 'item_images/biology_textbook.jpg' // Ensure this image exists in the storage
            ],
            [
                'name' => 'Basketball',
                'category_id' => $categories[3], // Sports Equipment
                'description' => 'Official size basketball for games.',
                'amount' => 8,
                'image' => 'item_images/basketball.jpg' // Ensure this image exists in the storage
            ],
            [
                'name' => 'Standing Desk',
                'category_id' => $categories[1], // Furniture
                'description' => 'An ergonomic adjustable standing desk.',
                'amount' => 3,
                'image' => 'item_images/standing_desk.jpg' // Ensure this image exists in the storage
            ],
            [
                'name' => 'Physics Textbook',
                'category_id' => $categories[2], // Books
                'description' => 'An in-depth textbook covering fundamental physics topics.',
                'amount' => 20,
                'image' => 'item_images/physics_textbook.jpg' // Ensure this image exists in the storage
            ],
            [
                'name' => 'Tennis Racket',
                'category_id' => $categories[3], // Sports Equipment
                'description' => 'Professional-grade tennis racket for tournament play.',
                'amount' => 7,
                'image' => 'item_images/tennis_racket.jpg' // Ensure this image exists in the storage
            ],
            [
                'name' => 'Projector',
                'category_id' => $categories[0], // Electronics
                'description' => 'HD projector with 4K support for presentations.',
                'amount' => 4,
                'image' => 'item_images/projector.jpg' // Ensure this image exists in the storage
            ],
            [
                'name' => 'Office Chair',
                'category_id' => $categories[1], // Furniture
                'description' => 'Ergonomic office chair with lumbar support.',
                'amount' => 10,
                'image' => 'item_images/office_chair.jpg' // Ensure this image exists in the storage
            ],
            [
                'name' => 'Chemistry Lab Kit',
                'category_id' => $categories[2], // Books/Science Kits
                'description' => 'Complete kit for chemistry experiments.',
                'amount' => 5,
                'image' => 'item_images/chemistry_lab_kit.jpg' // Ensure this image exists in the storage
            ],
            [
                'name' => 'Football',
                'category_id' => $categories[3], // Sports Equipment
                'description' => 'Standard size football for outdoor play.',
                'amount' => 6,
                'image' => 'item_images/football.jpg' // Ensure this image exists in the storage
            ],
            [
                'name' => 'Microphone',
                'category_id' => $categories[0], // Electronics
                'description' => 'USB microphone for high-quality audio recording.',
                'amount' => 8,
                'image' => 'item_images/microphone.jpg' // Ensure this image exists in the storage
            ],
            [
                'name' => 'Bookshelf',
                'category_id' => $categories[1], // Furniture
                'description' => 'Wooden bookshelf with five tiers for storage.',
                'amount' => 2,
                'image' => 'item_images/bookshelf.jpg' // Ensure this image exists in the storage
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}

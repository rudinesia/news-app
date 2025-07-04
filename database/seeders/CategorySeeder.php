<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Politik',
                'slug' => 'politik',
                'description' => 'Berita seputar politik dalam dan luar negeri',
            ],
            [
                'name' => 'Ekonomi',
                'slug' => 'ekonomi',
                'description' => 'Berita ekonomi, bisnis, dan keuangan',
            ],
            [
                'name' => 'Teknologi',
                'slug' => 'teknologi',
                'description' => 'Berita teknologi, gadget, dan inovasi',
            ],
            [
                'name' => 'Olahraga',
                'slug' => 'olahraga',
                'description' => 'Berita olahraga nasional dan internasional',
            ],
            [
                'name' => 'Hiburan',
                'slug' => 'hiburan',
                'description' => 'Berita hiburan, selebriti, dan entertainment',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

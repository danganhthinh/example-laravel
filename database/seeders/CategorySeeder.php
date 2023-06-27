<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        for ($i = 1; $i < 20; $i++) {
            Category::create([
                'name' => 'Category' . ' ' .$i,
            ]);
        }

    }
}

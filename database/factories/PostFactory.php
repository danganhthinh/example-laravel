<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $category = Category::inRandomOrder()->first();

        $images = [
            "https://icdn.dantri.com.vn/thumb_w/680/2023/05/15/1-1684135845324.png",
            "https://icdn.dantri.com.vn/thumb_w/680/2023/05/15/cach-lam-rau-muong-xao-toi-xanh-muot-gion-ngon-202106261000257134-1684108198372.jpg",
            "https://icdn.dantri.com.vn/thumb_w/680/2023/05/12/dsf6614-edited-1683885579802.jpeg?watermark=true",
            "https://icdn.dantri.com.vn/thumb_w/680/2023/05/12/ngu3-1683867363939.jpg"
        ];
        return [
            'title' => "title" . " " .fake()->title(),
            'author' => fake()->name(),
            'category_id' => $category->id,
            'content' => fake()->paragraph(),
            'thumbnail' => $images[rand(0,2)]
        ];
    }
}

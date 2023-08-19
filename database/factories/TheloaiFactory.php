<?php

namespace Database\Factories;

use App\Models\Theloai;
use Illuminate\Database\Eloquent\Factories\Factory;

class TheloaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           'tentheloai' => $this->faker->word,
            'slug_theloai' => $this->faker->slug,
            'mota' => $this->faker->paragraph,
            'kichhoat' => $this->faker->randomElement([0, 1]),
        ];
    }
}

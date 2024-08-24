<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'image' => $this->faker->imageUrl(),
            'title' => $this->faker->sentence(3),
            'slug' =>$this->faker->slug(),
            'content'=>$this->faker->paragraph(10),
            'published_at'=>$this->faker->dateTimeBetween('-2 week','+2 week'),
            'featured' => $this->faker->boolean(10)
        ];
    }
}

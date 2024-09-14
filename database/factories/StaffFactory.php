<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    protected $model = Staff::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['Male', 'Female']);
        $position = $this->faker->randomElement(['Staff', 'Supervisor']);
        return [
            'name' => $this->faker->name(),
            'gender' => $gender,
            'position' => $position,
            'phone_no' => $this->faker->numerify('##########'),
            'email' => $this->faker->email(),
            'password' =>  Hash::make('password'),
            'profile_name' => 'cute.jpg',
        ];
    }
}

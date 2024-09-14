<?php

namespace Database\Factories;
use App\Models\Survey;
use App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Survey>
 */
class SurveyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type = $this->faker->randomElement(["Sole proprietorship", "Partnership", "Corporation"]);
        return [
            'business_name' => $this->faker->company(),
            'business_type' => $type,
            'owner_name' => $this->faker->name(),
            'staff_id' => Staff::factory(),
            'phone_no' => $this->faker->numerify('##########'),
            'photo' => 'hello.jpg',
            'address' => $this->faker->address(),
            'latitude_logitude' => '-84.3880,33.7490',
            'staff_remark' => $this->faker->paragraph(10),
        ];
    }
}

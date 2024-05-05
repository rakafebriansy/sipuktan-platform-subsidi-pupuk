<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::create([
            'id' => 1,
            'pertanyaan' => fake()->sentence(),
            'jawaban' => fake()->sentence(),
            'id_pemerintah' => 1
        ]);
        Faq::create([
            'id' => 2,
            'pertanyaan' => fake()->sentence(),
            'jawaban' => fake()->sentence(),
            'id_pemerintah' => 1
        ]);
        Faq::create([
            'id' => 3,
            'pertanyaan' => fake()->sentence(),
            'jawaban' => fake()->sentence(),
            'id_pemerintah' => 1
        ]);
        Faq::create([
            'id' => 4,
            'pertanyaan' => fake()->sentence(),
            'jawaban' => fake()->sentence(),
            'id_pemerintah' => 1
        ]);
    }
}

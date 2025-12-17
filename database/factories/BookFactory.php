<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        $topics = ['Algoritmos', 'Python', 'React', 'Sistemas', 'Redes', 'Circuitos', 'Mecatrónica', 'Big Data', 'Machine Learning', 'Seguridad', 'Cloud Computing', 'Docker', 'Kubernetes', 'DevOps', 'Matemática Discreta', 'Física Aplicada'];
        $levels = ['Avanzado', 'para Principiantes', 'Aplicado', 'Moderno', 'en la Industria', 'Fundamental', 'Práctico', 'y sus Aplicaciones', 'Integral'];

        $title = $this->faker->randomElement($topics) . ' ' . $this->faker->randomElement($levels);

        return [
            'title' => $title,
            'author' => $this->faker->name(),
            'stock' => $this->faker->numberBetween(1, 15),

            // AGREGAMOS ESTA LÍNEA PARA SOLUCIONAR EL ERROR:
            'year' => $this->faker->year(),
        ];
    }
}

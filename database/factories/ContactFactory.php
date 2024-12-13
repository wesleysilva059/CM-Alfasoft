<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    /**
     * Defina o modelo de dados padrão.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'contact' => $this->faker->numerify('#########'),  // Garante que o contato tenha 9 dígitos
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}

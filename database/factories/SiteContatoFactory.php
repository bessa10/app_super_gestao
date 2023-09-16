<?php

namespace Database\Factories;

use App\Models\SiteContato;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SiteContatoFactory extends Factory
{   
    protected $model = SiteContato::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome'                  => $this->faker->name(),
            'telefone'              => $this->faker->phoneNumber(),
            'email'                 => $this->faker->safeEmail(),
            'motivo_contatos_id'    => $this->faker->numberBetween(1,3),
            'mensagem'              => $this->faker->text(200),
            //'password'            => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //'remember_token'      => Str::random(10),
        ];
    }
}

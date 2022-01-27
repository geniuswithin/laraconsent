<?php

namespace Ekoukltd\LaraConsent\Database\Factories;

use Ekoukltd\LaraConsent\Models\ConsentOption;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ConsentOptionFactory extends Factory
{
    protected $model = ConsentOption::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'key'               => Str::slug($this->faker->slug(4)),
            'version'           => $this->faker->randomNumber(),
            'title'             => $this->faker->words(3, true),
            'label'             => 'Tick here to accept the terms',
            'text'              => $this->faker->paragraph,
            'is_mandatory'      => 1,
            'is_current'        => 1,
            'force_user_update' => 1,
            'enabled'         => 1,
            'models'            => config('laraconsent.models'),
            'published_at'      => now(),
        ];
    }
}
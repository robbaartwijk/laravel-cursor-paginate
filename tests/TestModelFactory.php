<?php

namespace Bitsnbolts\CursorPaginate\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TestModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        ];
    }
}

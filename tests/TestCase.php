<?php

namespace Tests;

use Exception;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use DatabaseMigrations, CreatesApplication;
    private Generator $faker;


    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        Artisan::call('migrate:refresh');
    }
    

}

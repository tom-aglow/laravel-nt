<?php

namespace Tests;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


abstract class DatabaseTestCase extends TestCase
{
    use DatabaseMigrations;
}

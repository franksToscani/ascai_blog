<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // I test non richiedono né `npm run dev` né `npm run build`
        $this->withoutVite();
    }
}

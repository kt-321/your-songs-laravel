<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    
    public function from(string $url)
    {
        session()->setPreviousUrl(url($url));
        return $this;
    }
}

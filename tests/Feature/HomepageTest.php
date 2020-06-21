<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepageTest extends TestCase
{
    /**
     * Test Homepage loads
     *
     * @test
     */
    public function checkIfHomePageLoadsWithoutErrors()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

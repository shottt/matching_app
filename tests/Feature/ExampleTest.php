<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {   
        $this->get('/')->assertStatus(200);
        //$this->get('/index')->assertStatus(200);
        //$this->post('/api/ctrl_sign_in')->assertStatus(200);
        

        
        //$response->assertStatus(200);
    }
}

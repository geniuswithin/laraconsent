<?php

namespace Ekoukltd\LaraConsent\Tests\Unit;

use Ekoukltd\LaraConsent\Models\ConsentOption;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConsentOptionTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @test
     * A basic test example.
     *
     * @return void
     */
    public function test_consent_form(): void
    {
        $data = ['title'  => 'Terms and Conditions'];
        
        $consentForm = ConsentOption::factory()->create($data);
        $this->assertEquals($data[ 'title' ], $consentForm->title);
        $this->assertEquals(1,$consentForm->is_mandatory);
        $this->assertEquals(1,$consentForm->is_current);
        
    }
}

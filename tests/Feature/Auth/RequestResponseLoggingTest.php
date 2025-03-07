<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class RequestResponseLoggingTest extends TestCase
{
    use RefreshDatabase;

    public function test_request_response_logging_during_authentication(): void
    {
        // Arrange
        Log::shouldReceive('info')
            ->twice()
            ->andReturn(null);

        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ]);

        // Act
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        // Assert
        $response->assertStatus(302); // Redirect after successful login
        $this->assertAuthenticated();

        // You can also dump the response data for debugging
        // Uncomment the following line when needed
        // dd($response->getContent(), $response->headers->all());
    }

    public function test_failed_login_request_logging(): void
    {
        // Arrange
        Log::shouldReceive('info')
            ->twice()
            ->andReturn(null);

        // Act
        $response = $this->post('/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'wrongpassword',
        ]);

        // Assert
        $response->assertStatus(302); // Redirect back with errors
        $this->assertGuest();
    }
}
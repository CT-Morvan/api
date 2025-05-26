<?php

namespace Tests\Feature;

use App\Models\Bioimpedance;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BioimpedanceTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_can_create_bioimpedance_successfully(): void
    {
        $bioimpedanceData = [
            'exam_date' => '2024-01-15',
            'weight' => 75.5,
            'imc' => 24.2,
            'fat_percentage' => 15.8,
            'muscle_percentage' => 42.3,
            'basal_metabolism' => 1850.0,
            'metabolic_age' => 28.0,
            'visceral_fat' => 8.5,
            'height' => 175.0,
        ];

        $response = $this->actingAs($this->user)
            ->postJson("/api/{$this->user->id}/bioimpedances", $bioimpedanceData);

        $response->assertStatus(201);

        $this->assertDatabaseHas('bioimpedances', [
            'user_id' => $this->user->id,
            'exam_date' => '2024-01-15',
            'weight' => 75.5,
            'imc' => 24.2,
            'fat_percentage' => 15.8,
            'muscle_percentage' => 42.3,
            'basal_metabolism' => 1850.0,
            'metabolic_age' => 28.0,
            'visceral_fat' => 8.5,
        ]);
    }

    public function test_bioimpedance_creation_requires_authentication(): void
    {
        $bioimpedanceData = [
            'exam_date' => '2024-01-15',
            'weight' => 75.5,
            'imc' => 24.2,
            'fat_percentage' => 15.8,
            'muscle_percentage' => 42.3,
            'basal_metabolism' => 1850.0,
            'metabolic_age' => 28.0,
            'visceral_fat' => 8.5,
            'height' => 175.0,
        ];

        $response = $this->postJson("/api/{$this->user->id}/bioimpedances", $bioimpedanceData);

        $response->assertStatus(401);
    }

    public function test_bioimpedance_creation_validates_required_fields(): void
    {
        $response = $this->actingAs($this->user)
            ->postJson("/api/{$this->user->id}/bioimpedances", []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'exam_date',
            'weight',
            'imc',
            'fat_percentage',
            'muscle_percentage',
            'basal_metabolism',
            'metabolic_age',
            'visceral_fat',
            'height',
        ]);
    }

    public function test_bioimpedance_creation_validates_exam_date_format(): void
    {
        $bioimpedanceData = [
            'exam_date' => 'invalid-date',
            'weight' => 75.5,
            'imc' => 24.2,
            'fat_percentage' => 15.8,
            'muscle_percentage' => 42.3,
            'basal_metabolism' => 1850.0,
            'metabolic_age' => 28.0,
            'visceral_fat' => 8.5,
            'height' => 175.0,
        ];

        $response = $this->actingAs($this->user)
            ->postJson("/api/{$this->user->id}/bioimpedances", $bioimpedanceData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['exam_date']);
    }

    public function test_bioimpedance_creation_validates_numeric_fields(): void
    {
        $bioimpedanceData = [
            'exam_date' => '2024-01-15',
            'weight' => 'not-a-number',
            'imc' => 'not-a-number',
            'fat_percentage' => 'not-a-number',
            'muscle_percentage' => 'not-a-number',
            'basal_metabolism' => 'not-a-number',
            'metabolic_age' => 'not-a-number',
            'visceral_fat' => 'not-a-number',
            'height' => 'not-a-number',
        ];

        $response = $this->actingAs($this->user)
            ->postJson("/api/{$this->user->id}/bioimpedances", $bioimpedanceData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([
            'weight',
            'imc',
            'fat_percentage',
            'muscle_percentage',
            'basal_metabolism',
            'metabolic_age',
            'visceral_fat',
            'height',
        ]);
    }

    public function test_bioimpedance_creation_with_partial_valid_data(): void
    {
        $bioimpedanceData = [
            'exam_date' => '2024-01-15',
            'weight' => 75.5,
            'imc' => 24.2,
            'fat_percentage' => 15.8,
            'muscle_percentage' => 42.3,
            'basal_metabolism' => 1850.0,
            'metabolic_age' => 28.0,
            'visceral_fat' => 8.5,
            'height' => 175.0,
            'extra_field' => 'should be ignored',
        ];

        $response = $this->actingAs($this->user)
            ->postJson("/api/{$this->user->id}/bioimpedances", $bioimpedanceData);

        $response->assertStatus(201);

        $this->assertDatabaseHas('bioimpedances', [
            'user_id' => $this->user->id,
            'exam_date' => '2024-01-15',
            'weight' => 75.5,
        ]);
    }

    public function test_multiple_bioimpedances_can_be_created_for_same_user(): void
    {
        $firstBioimpedance = [
            'exam_date' => '2024-01-15',
            'weight' => 75.5,
            'imc' => 24.2,
            'fat_percentage' => 15.8,
            'muscle_percentage' => 42.3,
            'basal_metabolism' => 1850.0,
            'metabolic_age' => 28.0,
            'visceral_fat' => 8.5,
            'height' => 175.0,
        ];

        $secondBioimpedance = [
            'exam_date' => '2024-02-15',
            'weight' => 74.0,
            'imc' => 23.8,
            'fat_percentage' => 14.5,
            'muscle_percentage' => 43.1,
            'basal_metabolism' => 1870.0,
            'metabolic_age' => 27.0,
            'visceral_fat' => 7.8,
            'height' => 175.0,
        ];

        $this->actingAs($this->user)
            ->postJson("/api/{$this->user->id}/bioimpedances", $firstBioimpedance)
            ->assertStatus(201);

        $this->actingAs($this->user)
            ->postJson("/api/{$this->user->id}/bioimpedances", $secondBioimpedance)
            ->assertStatus(201);

        $this->assertEquals(2, Bioimpedance::where('user_id', $this->user->id)->count());
    }
} 
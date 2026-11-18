<?php

namespace Tests\Feature;

use App\Models\Cab;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminCabCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_cab_and_load_its_edit_form_with_put_spoofing(): void
    {
        Storage::fake('public');
        $city = $this->createCity();

        $this->actingAs(User::factory()->create(['is_admin' => true]))
            ->post(route('admin.cabs.store'), [
                'name' => 'City Cab',
                'registration_number' => 'MH01AB1234',
                'type' => 'Sedan',
                'city_id' => $city->id,
                'capacity' => 4,
                'rate_per_km' => 12.5,
                'base_fare' => 100,
                'image' => UploadedFile::fake()->image('cab.png'),
                'status' => 'active',
            ])
            ->assertRedirect(route('admin.cabs.index'))
            ->assertSessionHas('success', 'Cab added successfully.');

        $cab = Cab::query()->where('registration_number', 'MH01AB1234')->firstOrFail();

        $this->assertNull($cab->cab_associate_id);
        $this->assertSame($city->id, $cab->city_id);
        Storage::disk('public')->assertExists($cab->image);

        $this->get(route('admin.cabs.edit', $cab))
            ->assertOk()
            ->assertSee('<form method="POST" action="'.route('admin.cabs.update', $cab).'"', false)
            ->assertSee('name="_method" value="PUT"', false);

        $this->get(route('admin.cabs.show', $cab))
            ->assertOk()
            ->assertSee($cab->registration_number);
    }

    public function test_admin_cannot_create_cab_with_a_non_image_file(): void
    {
        Storage::fake('public');
        $city = $this->createCity();

        $this->actingAs(User::factory()->create(['is_admin' => true]))
            ->post(route('admin.cabs.store'), [
                'name' => 'City Cab',
                'registration_number' => 'MH01AB1234',
                'type' => 'Sedan',
                'city_id' => $city->id,
                'capacity' => 4,
                'rate_per_km' => 12.5,
                'base_fare' => 100,
                'image' => UploadedFile::fake()->create('cab.pdf', 20, 'application/pdf'),
                'status' => 'active',
            ])
            ->assertSessionHasErrors('image');

        $this->assertDatabaseMissing('cabs', ['registration_number' => 'MH01AB1234']);
    }

    public function test_admin_can_manage_vehicle_types_from_the_admin_page(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->get(route('admin.vehicle-types.index'))
            ->assertOk()
            ->assertSee('Vehicle Types')
            ->assertSee(route('admin.vehicle-types.create'));

        $this->post(route('admin.vehicle-types.store'), [
            'name' => 'SUV',
            'status' => 'active',
        ])
            ->assertRedirect(route('admin.vehicle-types.index'))
            ->assertSessionHas('success', 'Vehicle type added successfully.');

        $this->assertDatabaseHas('vehicle_types', [
            'name' => 'SUV',
            'status' => 'active',
        ]);
    }

    private function createCity(): City
    {
        $state = State::query()->create([
            'country_id' => Country::query()->create(['name' => 'India'])->id,
            'name' => 'Maharashtra',
        ]);

        return City::query()->create([
            'state_id' => $state->id,
            'name' => 'Mumbai',
            'primary_image' => 'cities/mumbai.jpg',
            'short_description' => 'A city in Maharashtra.',
        ]);
    }
}

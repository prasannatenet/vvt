<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CabBookPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_cab_book_page_renders_the_search_form(): void
    {
        $response = $this->get(route('cabs.book'));

        $response->assertStatus(200);
        $response->assertSee('Book Your Cab');
        $response->assertSee('Pickup City');
        $response->assertSee('Drop City');
        $response->assertSee('Select City');
        $response->assertSee('Select or type a city');
        $response->assertSee('Pickup Date');
        $response->assertSee('Pickup Time');
        $response->assertSee('Drop Date');
        $response->assertSee('Drop Time');
        $response->assertSee('Service Type');
        $response->assertSee('Select a service');
        $response->assertSee('Vehicle Preference (Optional)');
        $response->assertSee('Any Vehicle Type');
        $response->assertSee('Search Available Cabs');
    }

    public function test_cab_book_form_requires_all_required_fields(): void
    {
        $response = $this->post(route('cabs.book.store'), []);

        $response->assertSessionHasErrors([
            'pickup_city_id',
            'drop_city',
            'pickup_date',
            'pickup_time',
            'drop_date',
            'drop_time',
            'service_type',
        ]);
    }

    public function test_valid_submission_redirects_to_search_results(): void
    {
        $city = $this->createCity();
        $pickupDate = now()->addDay()->toDateString();

        $response = $this->post(route('cabs.book.store'), [
            'pickup_city_id' => $city->id,
            'drop_city' => 'Delhi',
            'pickup_date' => $pickupDate,
            'pickup_time' => '10:00',
            'drop_date' => $pickupDate,
            'drop_time' => '14:00',
            'service_type' => 'One Way',
            'vehicle_type' => 'Sedan',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertStringStartsWith(
            route('cabs.search').'?',
            $response->headers->get('Location')
        );
    }

    public function test_drop_date_must_not_be_before_pickup_date(): void
    {
        $city = $this->createCity();
        $tomorrow = now()->addDay()->toDateString();

        $response = $this->post(route('cabs.book.store'), [
            'pickup_city_id' => $city->id,
            'drop_city' => 'Delhi',
            'pickup_date' => $tomorrow,
            'pickup_time' => '10:00',
            'drop_date' => now()->toDateString(),
            'drop_time' => '14:00',
            'service_type' => 'One Way',
        ]);

        $response->assertSessionHasErrors('drop_date');
    }

    private function createCity(): City
    {
        $state = State::query()->create([
            'country_id' => Country::query()->create(['name' => 'India'])->id,
            'name' => 'Delhi',
        ]);

        return City::query()->create([
            'state_id' => $state->id,
            'name' => 'New Delhi',
            'primary_image' => 'cities/delhi.jpg',
            'short_description' => 'Capital city.',
        ]);
    }
}

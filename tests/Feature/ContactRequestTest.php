<?php

namespace Tests\Feature;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactRequestTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_validates_store_contact_request_with_valid_data()
    {
        $data = [
            'name' => 'John Doe',
            'contact' => '123456789',
            'email' => 'johndoe@example.com',
        ];

        $request = new StoreContactRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    /** @test */
    public function it_invalidates_store_contact_request_with_invalid_email()
    {
        $data = [
            'name' => 'John Doe',
            'contact' => '123456789',
            'email' => 'invalid-email',
        ];

        $request = new StoreContactRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }

    /** @test */
    public function it_invalidates_store_contact_request_with_duplicate_contact()
    {
        $existingContact = Contact::factory()->create([
            'contact' => '123456789',
        ]);

        $data = [
            'name' => 'John Doe',
            'contact' => '123456789',
            'email' => 'johndoe@example.com',
        ];

        $request = new StoreContactRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }

    /** @test */
    public function it_validates_update_contact_request_with_valid_data()
    {
        $contact = Contact::factory()->create();

        $data = [
            'name' => 'Updated Name',
            'contact' => '987654321',
            'email' => 'updated@example.com',
        ];

        $request = new UpdateContactRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    /** @test */
    public function it_invalidates_update_contact_request_with_invalid_email()
    {
        $contact = Contact::factory()->create();

        $data = [
            'name' => 'Updated Name',
            'contact' => '987654321',
            'email' => 'invalid-email',
        ];

        $request = new UpdateContactRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
    }
}

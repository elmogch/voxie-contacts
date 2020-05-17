<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Http\Response as HttpResponse;
use \Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Facades;

use App\Contact;

class ContactTest extends TestCase {
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /*
    public function test_api_contacts() {
        $response = $this->get('/api/contacts');
        $response->assertStatus(HttpResponse::HTTP_OK);
    }
    */

    /**
     * Test import CSV filw
     * POST: /api/contacts/{id}
     *
     * @return void
     */
    public function test_can_import_contacts_csv_file() {
        $data = ['contacts' => UploadedFile::fake()
            ->createWithContent(
                'contacts.csv',
                Storage::disk('local')->get('contacts.csv')
            )];

        $this->postJson('/api/contacts', $data)
            ->assertStatus(HttpResponse::HTTP_CREATED);
        
        $this->assertDatabaseHas('contacts', [
            'email' => 'luis@q-ark.mx',
        ]);
    }

    /**
     * Test show contact
     * GET: /api/contacts/{id}
     *
     * @return void
     */
    public function test_can_show_contact() {

        $contact = factory(Contact::class)->create();

        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
        ]);

        $this->get('/api/contacts/'.$contact->id)
            ->assertStatus(200);
    }
    
    /**
     * Test list contacts
     * GET: /api/contacts
     *
     * @return void
     */
    public function test_can_list_contacts() {
        $contacts = Contact::get();

        $response = $this->get('/api/contacts')
            ->assertStatus(HttpResponse::HTTP_OK)
            ->assertJson($contacts->toArray())
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'team_id',
                    'unsubscribed_status',
                    'first_name',
                    'last_name',
                    'phone',
                    'email',
                    'sticky_phone_number_id',
                    'twitter_id',
                    'fb_messenger_id',
                    'created_at',
                    'updated_at',
                    'time_zone',
                ],
            ]);
    }

    /**
     * Test delete contact
     * GET: /api/contacts/{id}
     *
     * @return void
     */
    public function test_can_delete_contact() {

        $contact = factory(Contact::class)->create();

        $this->delete('/api/contacts/'.$contact->id)
            ->assertStatus(200);

        $this->assertDeleted($contact);
    }
}

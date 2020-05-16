<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Contact;
use App\CustomAttribute;
use App\Http\Requests\StoreContacts;
use App\Src\CsvReader;

/**
 * Class ContactController
 * Read and Store contacts
 * @package App\Http\Controllers\API
 */
class ContactController extends Controller {
    /**
	 * Status Code for response
	 * @var Integer
	 */
    protected $status_code = 200;
    
    /**
	 * Contact model instance colection
	 * @var Contact
	 */
	private $contacts;

    /**
     * Display a listing of contacts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // $contacts = Contact::paginate(config('voxie.pagination_rows'));
        $contacts = Contact::all();
        return response()->json($contacts, $this->status_code);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $contact = Contact::with('customAttributes')->findOrFail($id);
        return response()->json($contact, $this->status_code);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContacts $request) {
        $contacts_created = [];
        $contacts_file = $request->file('contacts');
        
        $csvReader = new CsvReader($contacts_file->getRealPath());
        $contacts = $csvReader->toArray();
        
        foreach($contacts as $contact) {
            $custom_attributes = [];
            if(!isset($contact['time_zone'])) {
                $contact['time_zone'] = date_default_timezone_get();
            }
            $contact_created = Contact::create($contact);
            $contact_created_array = $contact_created->toArray();

            $contact_columns = $contact_created->getTableColumns();

            foreach($contact as $contact_column_key => $contact_column_value) {
                if (!in_array($contact_column_key, $contact_columns) && !empty($contact_column_value)) {
                    $custom_attributes[] = [
                        'key' => $contact_column_key,
                        'value' => $contact_column_value,
                    ];
                    $contact_created_array[$contact_column_key] = $contact_column_value;
                }
            }
            $custom_attribute_created = $contact_created->customAttributes()->createMany($custom_attributes);

            $contacts_created[] = $contact_created_array;
        }
        
        return response()->json($contacts_created, $this->status_code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $contact = Contact::find($id);
        if ($contact) {
            $contact->customAttributes()->delete();
            $contact->delete();
        }
        return $this->index();
    }
}

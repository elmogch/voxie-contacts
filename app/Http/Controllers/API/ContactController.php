<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Storage;

use App\Contact;
use App\CustomAttribute;
use App\Http\Requests\StoreContacts;

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
        return response()->json($contacts, HttpResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $contact = Contact::with('customAttributes')->findOrFail($id);
        return response()->json($contact, HttpResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContacts $request) {
        $contacts_file_path = realpath('../storage/app/contacts.csv');
        // $contacts_file_path = getcwd().'/storage/app/contacts.csv';
        echo "contacts_file_path: ".$contacts_file_path."<br><br>\n\n";
        $contacts = Contact::transformCsvToArray($contacts_file_path);
        // $contacts = [0 => 'asdf'];
        echo "contacts: <pre>".print_r($contacts, true)."</pre>   <br><br>\n\n";
        echo "--------------------<br><br>\n\n";

        $contacts_created = [];
        $contacts_file_path = $request
            ->file('contacts')
            ->getRealPath();
        
        $contacts = Contact::transformCsvToArray($contacts_file_path);
        
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
        
        return response()->json($contacts_created, HttpResponse::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        if ($id==='all') {
            // This 'delete all' option never should be implemented in production environment
            CustomAttribute::query()->delete();
            Contact::query()->delete();
        } else  {
            $contact = Contact::find($id);
            if (!$contact) {
                return response()->json(['message' => 'Not Found!'], HttpResponse::HTTP_NOT_FOUND);
            }
            $contact->customAttributes()->delete();
            $contact->delete();
        }
        return $this->index();

    }
}

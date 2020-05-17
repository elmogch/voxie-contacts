<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Storage;

use App\Contact;

class ContactTest extends TestCase
{
    /**
     * Test transform csv to array
     *
     * @return void
     */
    public function test_can_transform_csv_to_array(){
        $contacts_file_path = getcwd().'/storage/app/contacts.csv';
        $contacts = Contact::transformCsvToArray($contacts_file_path);
        $this->assertIsArray($contacts);
    }
}

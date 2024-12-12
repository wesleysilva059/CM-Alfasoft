<?php

namespace App\Services;

use App\Models\Contact;
use App\Services\ContactServiceInterface;
use App\Exceptions\ContactNotFoundException;
use App\Exceptions\DuplicateContactException;

class ContactService implements ContactServiceInterface
{
    public function getAllContacts()
    {
        return Contact::all();
    }

    public function getContactById($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            throw new ContactNotFoundException();
        }

        return $contact;
    }

    public function createContact(array $data)
    {
        if (Contact::where('phone', $data['phone'])->orWhere('email', $data['email'])->exists()) {
            throw new DuplicateContactException();
        }

        return Contact::create($data);
    }

    public function updateContact($id, array $data)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            throw new ContactNotFoundException();
        }

        $contact->update($data);

        return $contact;
    }

    public function deleteContact($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            throw new ContactNotFoundException();
        }

        $contact->delete();
    }
}

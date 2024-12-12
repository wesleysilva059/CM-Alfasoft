<?php

namespace App\Services;

use App\Models\Contact;

interface ContactServiceInterface
{
    public function getAllContacts();

    public function getContactById($id);

    public function createContact(array $data);

    public function updateContact($id, array $data);

    public function deleteContact($id);
}

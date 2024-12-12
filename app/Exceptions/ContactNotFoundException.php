<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class ContactNotFoundException extends Exception
{
    public function render()
    {
        return response()->json([
            'error' => 'Contact not found.'
        ], Response::HTTP_NOT_FOUND);
    }
}

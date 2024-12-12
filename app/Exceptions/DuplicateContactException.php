<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class DuplicateContactException extends Exception
{
    public function render()
    {
        return response()->json([
            'error' => 'A contact with the same phone or email already exists.'
        ], Response::HTTP_CONFLICT);
    }
}

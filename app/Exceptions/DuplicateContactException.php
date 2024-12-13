<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class DuplicateContactException extends Exception
{
    public function render()
    {
        return response()->json([
            'error' => 'Um registro com o mesmo contato ou e-mail já existe.'
        ], Response::HTTP_CONFLICT);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Services\ContactServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactServiceInterface $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index(): JsonResponse
    {
        $contacts = $this->contactService->getAllContacts();
        return response()->json($contacts, Response::HTTP_OK);
    }

    public function show($id): JsonResponse
    {
        try {
            $contact = $this->contactService->getContactById($id);
            return response()->json($contact, Response::HTTP_OK);
        } catch (\Exception $e) {
            return $e->render();
        }
    }

    public function store(StoreContactRequest $request): JsonResponse
    {
        try {
            $contact = $this->contactService->createContact($request->validated());
            return response()->json($contact, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $e->render();
        }
    }

    public function update(UpdateContactRequest $request, $id): JsonResponse
    {
        try {
            $contact = $this->contactService->updateContact($id, $request->validated());
            return response()->json($contact, Response::HTTP_OK);
        } catch (\Exception $e) {
            return $e->render();
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->contactService->deleteContact($id);
            return response()->json(['message' => 'Contact deleted successfully.'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return $e->render();
        }
    }
}

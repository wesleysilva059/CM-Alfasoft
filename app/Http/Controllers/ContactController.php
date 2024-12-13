<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Services\ContactServiceInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactServiceInterface $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        try {
            $contacts = $this->contactService->getAllContacts();
            return view('contacts.index', compact('contacts'));
        } catch (Exception $e) {
            return redirect()->route('contacts.index')->with('error', 'Erro ao carregar lista de contatos.');
        }
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function show($id)
    {
        try {
            $contact = $this->contactService->getContactById($id);
            return view('contacts.show', compact('contact'));
        } catch (Exception $e) {
            return redirect()->route('contacts.index')->with('error', 'Contato não encontrado.');
        }
    }

    public function store(StoreContactRequest $request)
    {
        try {
            $this->contactService->createContact($request->validated());
            return redirect()->route('contacts.index')->with('success', 'Contato criado com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar contato.');
        }
    }

    public function edit($id)
    {
        try {
            $contact = $this->contactService->getContactById($id);
            return view('contacts.edit', compact('contact'));
        } catch (Exception $e) {
            return redirect()->route('contacts.index')->with('error', 'Erro ao carregar contato para edição.');
        }
    }

    public function update(UpdateContactRequest $request, $id)
    {
        try {
            $this->contactService->updateContact($id, $request->validated());
            return redirect()->route('contacts.index')->with('success', 'Contato atualizado com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar contato.');
        }
    }

    public function destroy($id)
    {
        try {
            $this->contactService->deleteContact($id);
            return redirect()->route('contacts.index')->with('success', 'Contato deletado com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('contacts.index')->with('error', 'Erro ao deletar contato.');
        }
    }
}

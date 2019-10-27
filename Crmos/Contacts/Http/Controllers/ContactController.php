<?php

namespace Crmos\Contacts\Http\Controllers;

use Illuminate\Http\Request;
use Nwidart\Modules\Routing\Controller;
use Crmos\Contact\Http\Requests\ContactRequest;
use Crmos\Contact\Services\ContactService;
use Crmos\Contacts\Models\Contact;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index($contactableType, $contactableId)
    {
        $this->authorize('index', Contact::class);

        $contactable = $this->contactService->instantiate($contactableType, $contactableId);

        return response()->json($this->contactService->all($contactable)->toArray(), 200);
    }

    public function store(ContactRequest $request, $contactableType, $contactableId)
    {
        $this->authorize('create', Contact::class);

        $contactable = $this->contactService->instantiate($contactableType, $contactableId);

        $contact = $this->contactService->make($contactable, $request->all());

        return response()->json($contact->toArray(), 201);
    }

    public function show($contactableType, $contactableId, $id)
    {
        $contactable = $this->contactService->instantiate($contactableType, $contactableId);

        $contact = $this->contactService->get($contactable, $id);

        $this->authorize('view', $contact);

        return response()->json($contact->toArray(), 200);
    }

    public function update(Request $request, $contactableType, $contactableId, $id)
    {
        $contactable = $this->contactService->instantiate($contactableType, $contactableId);

        $contact = $this->contactService->get($contactable, $id);

        $this->authorize('update', $contact);

        $contact = $this->contactService->update($contactable, $id, $request->all());

        return response()->json($contact->toArray(), 200);
    }

    public function destroy($contactableType, $contactableId, $id)
    {
        $contactable = $this->contactService->instantiate($contactableType, $contactableId);

        $contact = $this->contactService->get($contactable, $id);

        $this->authorize('delete', $contact);

        $this->contactService->delete($contactable, $id);

        return response()->json('', 204);
    }
}

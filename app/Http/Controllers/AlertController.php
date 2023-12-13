<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlertCreateRequestData;
use App\Http\Requests\AlertUpdateRequestData;
use App\Models\Alert;
use Inertia\Inertia;

class AlertController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Alert/Index', ['alerts' => Alert::all()]);
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('Alert/Create');
    }

    public function store(AlertCreateRequestData $request): \Illuminate\Http\RedirectResponse
    {

        $alert = auth()->user()->alerts()->create([
            'message'         => $request->message,
            'targeting_rules' => $request->rules,
        ]);

        return redirect()->route('alerts.edit', ['alert' => $alert->ulid]);
    }

    public function edit(Alert $alert): \Inertia\Response
    {
        return Inertia::render('Alert/Edit', ['alert' => $alert]);
    }

    public function update(Alert $alert, AlertUpdateRequestData $requestData)
    {
        $alert->update(['message' => $requestData->message, 'targeting_rules' => $requestData->rules]);

        return back()->with('message','Alert updated successfully.');
    }
}

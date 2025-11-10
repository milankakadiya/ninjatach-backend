<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class ClientController extends Controller {

    use AuthorizesRequests, ValidatesRequests;

    public function index(Request $request) {
        $perPage = $request->get('per_page', 10);

        $clients = User::where('created_by', $request->user()->id)
            ->with('interests')
            ->paginate($perPage);

        return response()->json($clients);
    }

    public function store(StoreClientRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt('password');
        $data['role_id'] = 2;
        $data['created_by'] = $request->user()->id;

        $client = User::create($data);

        if ($request->has('interests')) {
            $client->interests()->sync($request->interests);
        }

        return response()->json($client->load('interests'), 201);
    }

    public function update(UpdateClientRequest $request, User $client)
    {
        $this->authorize('update', $client);

        $data = $request->validated();

        $client->update($data);

        if ($request->has('interests')) {
            $client->interests()->sync($request->interests);
        }

        return response()->json($client->load('interests'));
    }

    public function destroy(User $client) {
        $client->delete();
        return response()->json(['message' => 'Client deleted']);
    }
}

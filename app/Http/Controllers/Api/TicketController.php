<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Traits\ResolvesDepartmentConnection;


class TicketController extends Controller
{ 
    use ResolvesDepartmentConnection;
    public function store(StoreTicketRequest $request)
    {
        $data = $request->validated();

        $type = $data['type'];
        $dbConnection = $this->resolveConnection($type);
        if (empty($dbConnection)) return response()->json(['error' => 'Invalid department'], 404);

        DB::connection($dbConnection)->table('tickets')->insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],
            'type' => $data['type'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Ticket submitted successfully']);
    }
}

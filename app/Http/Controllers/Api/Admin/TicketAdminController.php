<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Traits\ResolvesDepartmentConnection;

class TicketAdminController extends Controller
{
    use ResolvesDepartmentConnection;
    public function index()
    {
        // Merge tickets from all DBs
        $departments = [
           'Technical Issues' => 'technical_connection',
            'Account & Billing' => 'account_connection',
            'Product & Service' => 'product_connection',
            'General Inquiry' => 'general_connection',
            'Feedback & Suggestions' => 'feedback_connection',
        ];

        $tickets = [];

        foreach ($departments as $type => $connection) {
            $rows = DB::connection($connection)->table('tickets')
                ->select('*', DB::raw("'$type' as dept_type"))
                ->get();
            $tickets = array_merge($tickets, $rows->toArray());
        }
        return response()->json($tickets);
    }

    public function show($type, $id)
    {
       $dbConnection = $this->shortKeyConnection($type);
       if (empty($dbConnection)) return response()->json(['error' => 'Invalid department'], 404);

       $ticket = Ticket::on($dbConnection)->find($id);
       return response()->json($ticket);
    }

    public function updateNote(Request $request, $type, $id)
    {
        $request->validate([
            'admin_note' => 'required|string',
        ]);

       $dbConnection = $this->shortKeyConnection($type);
       if (empty($dbConnection)) return response()->json(['error' => 'Invalid department'], 404);

       Ticket::on($dbConnection)->find($id)->update([
           'admin_note' => $request->admin_note,
           'status' => 'Noted',
       ]);       
        return response()->json(['message' => 'Note added and ticket updated']);
    }
}

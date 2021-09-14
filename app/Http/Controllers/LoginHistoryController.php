<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class LoginHistoryController extends Controller
{

public function history(){

$retrieveLoginHistory = User::all();

return response()->json([

    'message' => 'Transaction retrieves successfully',

    'data' => $retrieveLoginHistory
    
], 200);

}
}
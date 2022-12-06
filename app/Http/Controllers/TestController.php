<?php

namespace App\Http\Controllers;

use App\Models\CodeName;
use App\Models\CodeNameRelationship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    public function check_name(Request $request)
    {
        $user = CodeName::where('name', 'LIKE', "%{$request->get('user_code_name')}%")->first();

        if ($user == null) {
            return view('sorry_not_found');
        }

        if ($user->picked != null) {
            return redirect(route('picked'));
        }

        Session::put('user_code_name', $user->id);

        return redirect(route('draw'));
    }

    public function draw_save()
    {
        $user = CodeName::find(Session::get('user_code_name'));

        if ($user == null) {
            return redirect(route('main'));
        }

        if ($user->picked != null) {
            return redirect(route('picked'));
        }

        do {
            $receiver = CodeName::inRandomOrder()
                ->whereNotIn('id', CodeNameRelationship::all()->pluck('receiver_id'))
                ->first();

            $checking = CodeNameRelationship::where('receiver_id', $receiver->id)->first();
        } while ($checking != null || $receiver->id == $user->id);

        CodeNameRelationship::create([
            'picker_id' => $user->id,
            'receiver_id' => $receiver->id
        ]);

        return redirect(route('picked'));
    }
}

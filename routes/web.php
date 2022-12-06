<?php

use App\Http\Controllers\TestController;
use App\Models\CodeName;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/paypal', [TestController::class, 'paypal']);
Route::post('/paypal-post', [TestController::class, 'paypal_post']);

Route::get('/', function () {
    $user = CodeName::find(Session::get('user_code_name'));
    if ($user != null) {
        return redirect(route('draw'));
    }


    return view('main');
})->name('main');

Route::get('/draw', function () {
    $user = CodeName::find(Session::get('user_code_name'));
    if ($user == null) {
        return redirect(route('main'));
    }

    if ($user->picked != null) {
        return redirect(route('picked'));
    }

    return view('draw', compact('user'));
})->name('draw');

Route::post('/check_name', [TestController::class, 'check_name'])->name('check_name');
Route::post('/draw/save', [TestController::class, 'draw_save'])->name('draw.save');
Route::get('/picked', function () {
    $user = CodeName::find(Session::get('user_code_name'));

    if ($user == null) {
        return redirect(route('main'));
    }

    if ($user->picked == null) {
        return redirect(route('draw'));
    }

    return view('picked', compact('user'));
})->name('picked');

Route::get('/list_pickings/{token}', function ($token) {
    $hash = '$2y$10$rTXOQxMQ8gg2NAgO10qJUuhUWO9ufFDyT4IkmCTJOKv2sRY450QD2';

    if (!password_verify($token, $hash)) {
        abort(404);
    }

    $code_names = App\Models\CodeName::all();

    $code_name_rel = App\Models\CodeNameRelationShip::all();

    return view('list', compact('code_names', 'code_name_rel'));
});


Route::get('/download_csv/{token}', function ($token) {
    $hash = '$2y$10$rTXOQxMQ8gg2NAgO10qJUuhUWO9ufFDyT4IkmCTJOKv2sRY450QD2';

    if (!password_verify($token, $hash)) {
        abort(404);
    }

    $code_name_rel = App\Models\CodeNameRelationShip::all();
    $fileName = 'Dotty_Christmas_Draw_Lots' . date('Y_m_d_H_i_s') . '.csv';

    $headers = array(
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    );

    $columns = array('Gifter', 'Receiver');
    $callback = function () use ($code_name_rel, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($code_name_rel as $data) {

            fputcsv($file, array($data->picker->name, $data->receiver->name));
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
})->name('download');

Route::get('/repick', function() {
    Session::put('user_code_name', null);

    return redirect(route('draw'));
});
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Register;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('mail',[MailController::class,'index']);
/*
Route::resource('user',UserController::class);
Route::get('otp',[UserController::class, 'otp'])->name('otp');
Route::get('forgotForm',[UserController::class, 'forgotForm']);
Route::get('forgot',[UserController::class, 'forgot'])->name('forgot');
Route::get('changePassword',[UserController::class, 'changePassword'])->name('changePassword');
*/
//link
Route::resource('register',Register::class);
Route::get('verify',[Register::class,'verify'])->name('verify');

Route::get('forgot',[Register::class,'forgot']);
Route::get('forgotPass',[Register::class,'forgotPass'])->name('forgotPass');
Route::get('changepass',[Register::class,'changepass'])->name('changepass');
Route::get('changepassword',[Register::class,'changepassword'])->name('changepassword');

Route::controller(AuthController::class)->group(function () {
    Route::get('/auth', 'index');
    Route::get('/registerForm', 'registerForm');
    Route::get('/register', 'register');
    Route::get('/verify', 'verify');
    Route::get('/loginForm', 'loginForm');
    Route::post('/login', 'login');
});

Route::middleware(['auth','checkAuth'])->group(function () {
    Route::get('dashboard',[AuthController::class,'index'])->name('dashboard');
   
    //Route::get('adduser',[EventController::class,'index']);
    
});

//  if(auth()->user()->user_type=="admin"){
//         Route::get('adduser',[EventController::class,'index']);
//     }else 
if(auth()->user()&&auth()->user()->user_type=="user"){
        //Route::view('customers','customers')->name;
        Route::get('/user', function () {
            return "user";
        });
    }
Route::get('/',function(Request $request){
    return $request->username();    //username is custome functionality using macro use function or class and object
});
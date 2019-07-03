<?php

namespace App\Http\Controllers\Auth;

use App\Enum\MailMessage;
use App\Enum\UserRoles;
use App\Enum\UserStatus;
use App\Http\Controllers\Controller;
use App\Mail\ActivateEmail;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return Response
     */
    public function showRegistrationForm()
    {
        return redirect('/');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $fullname = $request->first_name . ' ' . $request->last_name;

        $this->activateEmail($request->email, $fullname);

        return response([
            'message' => MailMessage::REGISTER,
        ], 200);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'phone' => ['required', 'string'],
        ], [
            'first_name.required' => 'The first name field is required.',
            'last_name.required' => 'The last name field is required.',
            'phone.required' => 'The phone field is required.'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'fullname' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => UserRoles::SHOP,
            'phone_number' => $data['phone'],
            'active' => UserStatus::INACTIVE
        ]);
    }

    /**
     * Send mail after register successful
     *
     * @param $email
     * @return \App\Mail
     */
    protected function activateEmail($email, $fullname)
    {
        $token_active_mail = $this->generateUniqueAccessToken();

        User::where('email', $email)->update([
            'token_active_mail' => $token_active_mail,
        ]);

        $data = [
            'fullname' => $fullname,
            'token_active_mail' => $token_active_mail
        ];

        return \Mail::to($email)->send(new ActivateEmail($data));

    }

    /**
     * create random token active mail
     *
     * @param
     * @return $token_active_mail
     */
    protected function generateUniqueAccessToken()
    {
        do {
            $token_active_mail = str_random(64);
        } while ($user = User::where('token_active_mail', $token_active_mail)->first());

        return $token_active_mail;
    }

    protected function updateStatus(Request $request)
    {
        $check = User::where('token_active_mail', $request->token_active_mail)->update([
            'active' => UserStatus::ACTIVE
        ]);

        if ($check) {
            return redirect('/');
        }
    }

}

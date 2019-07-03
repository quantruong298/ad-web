<?php

namespace App\Http\Controllers;

use App\Enum\Paginate;
use App\Enum\UserRoles;
use App\Enum\UserStatus;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    /**
     * Show the list user.
     *
     * @param $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = $this->getUserList($request->keyword);
            $view = view('components.users.list', compact('users'));
            return $view->render();
        } else {
            $users = $this->getUserList($request->keyword);
            return view('layouts.users.index', compact('users'));
        }
    }

    /**
     * Create new user.
     *
     * @param array $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function storeUser(UserRequest $request)
    {
        User::create([
            'fullname' => $request->full_name,
            'email' => $request->email_add,
            'password' => Hash::make($request->password),
            'role_id' => UserRoles::SHOP,
            'phone_number' => $request->phone_add,
            'active' => UserStatus::ACTIVE,
        ]);

        $users = $this->getUserList();
        $view = view('components.users.list', compact('users'));

        return response([
            'message' => 'Stored success.',
            'view' => $view->render()
        ], 200);
    }

    /**
     * Edit user.
     *
     * @param array $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateUser(UserRequest $request)
    {
        $result = User::where('id', $request->id)
            ->where('email', $request->email)
            ->update([
                'fullname' => $request->full_name,
                'phone_number' => $request->phone
            ]);

        if ($result) {
            $users = $this->getUserList();
            $view = view('components.users.list', compact('users'));

            return response([
                'status' => 'success',
                'message' => 'Updated success.',
                'view' => $view->render()
            ], 200);
        } else {
            return response([
                'status' => 'fail',
                'message' => 'Updated fail.',
            ], 200);
        }
    }

    /**
     * Delete user.
     *
     * @param array $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deleteUser(Request $request)
    {
        User::where('id', $request->id)->delete();

        $users = $this->getUserList();
        $view = view('components.users.list', compact('users'));

        return response([
            'message' => 'Deleted success.',
            'view' => $view->render()
        ], 200);
    }

    /**
     * Get a list user
     *
     * @param $keyword
     * @return \App\User
     */
    public function getUserList($keyword = null)
    {
        $results = User::select('id', 'email', 'fullname', 'phone_number')
            ->where('role_id', '<>', UserRoles::ADMIN);

        if ($keyword != '') {
            $results = $results->where('email', 'LIKE', '%' . $keyword . '%');
        }

        return $results->orderBy('id', 'desc')->paginate(Paginate::USER)->withPath(route('user'));
    }

    /**
     * Get a list user by id
     *
     * @param $request ->id
     * @return \App\User
     */
    public function getInfoUserById(Request $request)
    {
        return User::select('id', 'email', 'fullname', 'phone_number')->where('id', $request->id)->get();
    }
}

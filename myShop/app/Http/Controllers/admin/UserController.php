<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    //The index view for the user
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    //Displaying the user create form
    public function create()
    {
        return view('admin.users.createForm');
    }

    //Used for insertion of the user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:5',
            'role_id' => 'required'
        ]);

        // DB::transaction ensures atomicity, data integrity, and thread safety by treating user creation and role assignment as a single "all-or-nothing" operation.

        DB::transaction(function () use ($validated) {

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'is_active' => 1,
            ]);

            $user->roles()->attach($validated['role_id']);
        });

        return redirect()->route('users')->with('success', 'User created successfully');
    }

    public function edit(Request $request)
    {
        $userEdit = $request->filled('id')
            ? User::with('roles')->findOrFail($request->id)
            : null;

        $roles = Role::all();

        return view('admin.users.createForm', compact('userEdit', 'roles'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'id'       => ['required', 'exists:users,id'],
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', Rule::unique('users', 'email')->ignore($request->id)],
            'password' => ['nullable'],
            'role_id'     => ['required', 'exists:roles,id'],
        ]);

        // dd($data);

        $user = User::findOrFail($data['id']);

        $user->name = $data['name'];
        $user->email = $data['email'];

        $passwordReset = !empty($data['password']);
        if ($passwordReset) {
            $user->password = Hash::make($data['password']);
        }


        $user->save();
        $user->roles()->sync([$data['role_id']]);

        if ($passwordReset && $user->id = Auth::id()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('staff.login')
                ->with('success', 'Password changed. Please log in again.');
        }

        return redirect()->route('users')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id == Auth::id()) {
            return redirect()->route('user')->with('failed', 'Login User can not Delete its account');
        }
        $user->delete();


        return redirect()->route('users')->with('success', 'User deleted successfully');
    }
}

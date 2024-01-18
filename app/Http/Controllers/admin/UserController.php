<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\File;


class UserController extends Controller
{
    public function index()
    {
    	return view('admin.users.index');
    }

    public function create()
    {
    	return view('admin.users.create');
    }

    public function store_old(Request $request)
    {
    	$validated = $request->validate([
    		'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role_as'  => ['required', 'integer'],
    	]);

    	User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as,
        ]);
        return redirect('/admin/users')->with('message', 'User Created successfully');

    }
    public function store(UserFormRequest $request)
    {
        $validatedData = $request->validated();

        $user = new User;
        $user->name = $validatedData['name'];
        $user->father_name = $validatedData['father_name'];
        $user->mobile_no = $validatedData['mobile_no'];
        $user->address = $validatedData['address'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role_as = $validatedData['role_as'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;

            $file->move('uploads/user', $filename);

            $user->image = $filename;
        }

        // for class
        if ($request->class) {
            $user->class = $request->class;
        }

        // for Qualification
        if ($request->qualification) {
            $user->qualification = $request->qualification;
        }

        $user->status = $request->status==true ? '1':'0';
        $user->save();

        return redirect('admin/users')->with('message', 'User Added Successfully');
    }

    public function edit(int $userId)
    {
    	$user = User::findOrFail($userId);
    	return view('admin.users.edit', compact('user'));
    }

    public function update_old(Request $request, int $userId)
    {
    	$validated = $request->validate([
    		'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'role_as'  => ['required', 'integer'],
    	]);

    	User::findOrFail($userId)->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as,
        ]);
        return redirect('/admin/users')->with('message', 'User Updated successfully');

    }

    public function update(UserFormRequest $request, $user)
    {
        $validatedData = $request->validated();

        $user = User::findOrFail($user);

        $user->name = $validatedData['name'];
        $user->father_name = $validatedData['father_name'];
        $user->mobile_no = $validatedData['mobile_no'];
        $user->address = $validatedData['address'];
        $user->password = Hash::make($validatedData['password']);
        $user->role_as = $validatedData['role_as'];

        if ($request->hasFile('image')) {

            $path = 'uploads/user/'.$user->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');

            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;

            $file->move('uploads/user', $filename);

            $user->image = $filename;
        }

        $user->status = $request->status==true ? '1':'0';
        $user->update();

        return redirect('admin/users')->with('message', 'User Updated Successfully');
    }
}

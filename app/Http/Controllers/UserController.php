<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request){
      

        if ($request->ajax()) {
            $data = User::with('role')->select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $editBtn = '<a href="' . route('users.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                        $deleteBtn = '
                            <form action="' . route('users.destroy', $row->id) . '" method="POST" class="d-inline">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>';
                        
                        return $editBtn . ' ' . $deleteBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('users');
    }

    /**
     * Show the form for creating a new resource.
     */


public function create()
    {
        
        return view('editUser');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request){
        $validator =  $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric',
            'gender' => 'required',
            'status' => 'in:active,inactive',
            'profile_image' => 'image|mimes:jpg,png|max:1024', // Max 1MB
            'address' => 'nullable',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('users.create')
                ->withErrors($validator)
                ->withInput()->With( $request->all());
        }
        $user = new User();
        $user->name = $request->name;
        $user->role_id = $request->role;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->status = $request->status ?? 'active'; // Default to active if not provided
        $user->address = $request->address;
    
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image');
            $imageName = time() . '.' . $profileImage->getClientOriginalExtension();
            $profileImage->move(public_path('profile_images'), $imageName);
            $user->profile_image = $imageName;
        }
    
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
public function show(string $id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(string $id){
        $user = null;

    if ($id) {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }
    }

    return view('editUser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id){
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }
    
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|numeric|digits:10',
            'gender' => 'required',
            'status' => 'in:active,inactive',
            'profile_image' => 'image|mimes:jpg,png|max:1024', // Max 1MB
            'address' => 'nullable',
        ]);
    
        $user->name = $request->name;
        $user->role_id = $request->role;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->status = $request->status ?? 'active'; // Default to active if not provided
        $user->address = $request->address;
    
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            if (!empty($user->profile_image)) {
                $imagePath = public_path('profile_images') . '/' . $user->profile_image;
                
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $profileImage = $request->file('profile_image');
            $imageName = time() . '.' . $profileImage->getClientOriginalExtension();
            $profileImage->move(public_path('profile_images'), $imageName);
            $user->profile_image =  $imageName;
        }
    
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
public function destroy(string $id){
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }
    
        $user->delete();
    
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}

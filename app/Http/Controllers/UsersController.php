<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UsersRequest;
use App\Models\Personalinfo;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        return $users = $this->search($query);
        
        

        return view('users.index')->with('users', $users);
    }

    public function search($query) 
    {
        //DB::table()::join()
        return DB::table('users')->where('name', 'like', '%' . $query . '%')
                      ->orWhere('email', 'like', '%' . $query . '%')
                      ->orderBy('id', 'desc')
                      
                      ->orderBy('created_at', 'asc')
                      ->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsersRequest $request)
    {
        $user =  User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return ['success' => true, 'user' => $user];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }


    public function edit($id)
    {
        
        $user = User::find($id);
        return view('users.edit')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        return ['success' => true, 'user' => $user];

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return ['success' => true];
    }
}

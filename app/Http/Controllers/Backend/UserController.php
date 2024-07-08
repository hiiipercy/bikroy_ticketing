<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\Ticket;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = User::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return ucfirst($row->name);
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1 ? 'Active' : 'Inactive';
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <a href="' . route("user.show", $row->id) .   '" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></a>
                    <a href="' . route("user.edit", $row->id) .   '" class="btn btn-primary btn-sm"><i class="fa-solid fa-edit"></i></a>
                    <button type="button" class="btn btn-danger btn-sm delete_data ml-1" data-id="' . $row->id . '" data-name="' . $row->name .'"><i class="fa-solid fa-trash"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.modules.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::get();
        return view('backend.modules.user.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        if ($request->has('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $uniqueName = md5(rand() . time() . $filename) . '.' . $extension;
            $path = 'assets/img/user/';
            $file->move($path, $uniqueName);
            $image = $path . $uniqueName;
        } else {
            $image = Null;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'role_type' => $request->role_type,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'image' => $image
        ]);

        $user->save();
      
        
        session()->flash('cls', 'success');
        session()->flash('msg', 'User created successfully');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('backend.modules.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.modules.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);

        if ($request->has('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $uniqueName = md5(rand() . time() . $filename) . '.' . $extension;
            $path = 'assets/img/user/';
            $image = $path . $uniqueName;
            $file->move($path, $uniqueName);

            if (File::exists($user->image)) {
                File::delete($user->image);
            }
        } else {
            $image = $user->image;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'role_type' => $request->role_type,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'image' => $image,
        ]);

        $user->save();
        session()->flash('cls', 'success');
        session()->flash('msg', 'User updated successfully');
        return redirect()->route('user.index');
    }


    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $user = User::find($request->id);
            if($user){
                $user->delete();
                $output = ['status'=>'success','message'=>'User has been deleted successfull.'];
            }else{
                $output = ['status'=>'error','message'=>'User not found!'];
            }

            return response()->json($output);
            
        }
        
    }
}

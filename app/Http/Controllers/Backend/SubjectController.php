<?php

namespace App\Http\Controllers\Backend;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\CreateSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(\request()->ajax()){
            $data = Subject::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    return $row->name;
                })
                ->addColumn('status', function($row){
                    return $row->status == 1 ? 'Active' : 'Inactive';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <a href="' . route("subject.edit", $row->id) .   '" class="btn btn-primary btn-sm"><i class="fa-solid fa-edit"></i></a>
                    <button type="button" class="btn btn-danger btn-sm delete_data ml-1" data-id="' . $row->id . '" data-name="' . $row->name .'"><i class="fa-solid fa-trash"></i></button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.modules.subject.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.modules.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSubjectRequest $request)
    {

        $subject =Subject::create([
            'name' => $request->name,
            'status' => $request->status
        ]
        );

        $subject->save();
        session()->flash('cls', 'success');
        session()->flash('msg', 'Subject created successfully');
        return redirect()->route('subject.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('backend.modules.subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectRequest $request, int $id)
    {   

        $subject = Subject::find($id);

        $subject->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        $subject->save();
        session()->flash('cls', 'success');
        session()->flash('msg', 'Subject updated successfully');
        return redirect()->route('subject.index');
    }


    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $subject = Subject::find($request->id);
            if($subject){
                $subject->delete();
                $output = ['status'=>'success','message'=>'Subject has been deleted successfullY.'];
            }else{
                $output = ['status'=>'error','message'=>'Subject not found!'];
            }

            return response()->json($output);
            
        }
        
    }
}

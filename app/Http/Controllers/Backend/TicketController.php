<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Subject;
use App\Models\Feedback;
use App\Mail\CreateTicket;
use Illuminate\Support\Str;
use App\Mail\SendTicketMail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Notifications\TicketFeedbackNotification;

class TicketController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
        // $user = Ticket::with('user')->get();
        $user = User::where('status', 1)->pluck('name', 'id');
        $subject = Subject::where('status', 1)->pluck('name', 'id');

        
        if(request()->ajax()){
            $data = Ticket::orderBy('id','desc');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->filter(function($query) use ($request){
                    if(!empty($request->user_id)){
                        $query->where('user_id',$request->user_id);
                    }

                    if(!empty($request->subject_id)){
                        $query->where('subject_id',$request->subject_id);
                    }

                    if(!empty($request->ticket_status)){
                        $query->where('ticket_status',$request->ticket_status);
                    }
                    if(!empty($request->start_date) && !empty($request->end_date)){
                        $query->whereDate('created_at','>=',$request->start_date)
                        ->whereDate('created_at','<=',$request->end_date);
                    }
                })
                ->addColumn('name', function($row){
                    return $row->name;
                })
                ->addColumn('user_id', function($row){
                    return $row->user->name;
                })
                ->addColumn('video_link', function($row){
                    return Str::limit($row->video_link, 30) ?? 'N/A';
                })
                ->addColumn('subject_id', function($row){
                    return $row->subject->name;
                })

                ->addColumn('ticket_status', function ($row) {
                   return $row->ticket_status == 1 ? '<span class="badge bg-primary">Open</span>' : ($row->ticket_status == 2 ? '<span class="badge bg-warning">Process</span>' : '<span class="badge bg-danger">Close</span>');
                })

                ->addColumn('created_at', function($row){

                    return date('d-m-Y',strtotime($row->created_at ));
                })
                
                ->addColumn('action', function ($row) {

                    $actionBtn = '<a href="' . route("ticket.show", $row->id) .   '" class="btn btn-info btn-sm mr-2" data-toggle="tooltip" title="Show"><i class="fa-solid fa-eye"></i></a>';

                    if (Auth::user()->role_type == 'Admin') {
                        $actionBtn .= '<a href="' . route("ticket.feedback", $row->id) .   '" data-toggle="tooltip" title="Feedback" class="btn btn-primary btn-sm mr-2"><i class="fa fa-commenting-o"></i></a>';
                    }
                    

                    $actionBtn .= '<a href="' . route("ticket.edit", $row->id) .   '" class="btn btn-info btn-sm mr-2" data-toggle="tooltip" title="Edit" class="btn btn-primary btn-sm"><i class="fa-solid fa-edit"></i></a>';
                    $actionBtn .= '<button type="button"  class="btn btn-danger btn-sm delete_data mr-2" data-id="' . $row->id . '" data-name="' . $row->name .'" data-toggle="tooltip" title="Delete"><i class="fa-solid fa-trash"></i></button>';
                    
                    return $actionBtn;
                })

                ->rawColumns(['action','ticket_status'])
                ->make(true);
        }
        return view('backend.modules.ticket.index', compact('user', 'subject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::where('status', 1)->pluck('name', 'id');
        $subject = Subject::where('status', 1)->pluck('name', 'id');
        return view('backend.modules.ticket.create', compact('user', 'subject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTicketRequest $request)
    {
        if ($request->has('attach_file')) {
            $file = $request->file('attach_file');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $uniqueName = md5(rand() . time() . $filename) . '.' . $extension;
            $path = 'assets/img/ticket/';
            $file->move($path, $uniqueName);
            $image = $path.$uniqueName;
        }else{
            $image=null;
        }

        $ticket = Ticket::create([
            'subject_id' => $request->subject_id,
            'user_id' => Auth::id(),
            'description' => $request->description,
            'attach_file' => $image,
            'video_link' => $request->video_link,
            'ticket_status' => $request->ticket_status,
        ]);

        $ticket->save();
        $emails = User::where('role_type', 'Admin')->pluck('email');

        $cc = [
            'richard.costa@bikroy.com',
            'abdullah.tanvir@bikroy.com',
            'mohibul.alam@bikroy.com',
            'linkon@bikroy.com',
            'linkon@bikroy.com',
        ];
        Mail::to($emails)
        ->cc($cc)
        ->send(new SendTicketMail($ticket));
      
      
        session()->flash('cls', 'success');
        session()->flash('msg', 'Ticket created successfully');
        return redirect()->route('ticket.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        // $ticket->load('subject');
        $ticket = Ticket::find($id);
        return view('backend.modules.ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::find($id);
        $user = User::where('status', 1)->pluck('name', 'id');
        $subject = Subject::where('status', 1)->pluck('name', 'id');
        return view('backend.modules.ticket.edit', compact('ticket', 'user', 'subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, $id)
    {
        $ticket = Ticket::find($id);
        if ($request->has('attach_file')) {
            $file = $request->file('attach_file');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $uniqueName = md5(rand() . time() . $filename) . '.' . $extension;
            $path = 'assets/img/ticket/';
            $file->move($path, $uniqueName);
            $image = $path . $uniqueName;

            if (File::exists($ticket->attach_file)) {
                File::delete($ticket->attach_file);
            }
        } else {
            $image = $ticket->attach_file;
        }

        $ticket->update([
            'subject_id' => $request->subject_id,
            'user_id' => Auth::id(),
            'description' => $request->description,
            'attach_file' => $image,
            'video_link' => $request->video_link,
            'ticket_status' => $request->ticket_status,
        ]);
        
        $ticket->save();
        session()->flash('cls', 'success');
        session()->flash('msg', 'Ticket updated successfully');
        return redirect()->route('ticket.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $ticket = Ticket::find($request->id);
            if($ticket){
                $ticket->delete();
                $output = ['status'=>'success','message'=>'Ticket has been deleted successfull.'];
            }else{
                $output = ['status'=>'error','message'=>'Ticket not found!'];
            }

            return response()->json($output);
            
        }
        
    }
    public function feedback($id)
    {
        $ticket = Ticket::find($id);
        $user = User::where('status', 1)->pluck('name', 'id');
        return view('backend.modules.ticket.feedback', compact('ticket', 'user'));
    }

    public function feedback_store(Request $request)
    {
        $feedback = $request->validate([
            'ticket_id'    => 'required',
            'description'   => 'required'
        ]);
   
        $feedback = Feedback::create([
            'user_id' => Auth::id(),
            'description' => $request->description,
            'ticket_id' => $request->ticket_id,
        ]);
        $feedback->ticket->update([
            'ticket_status' => $request->ticket_status,
        ]);
        $user = User::find($feedback->ticket->user_id);
        $data = [
            'admin' => Auth::user()->name,
            'name' => $user->name,
            'description' => $feedback->description,
            'subject' => $feedback->ticket->subject->name,
            'ticket_id' => $feedback->ticket_id,
            'feedback_id' => $feedback->id,
            'created_at' => $feedback->created_at,
            'updated_at' => $feedback->updated_at,
        ];
        $user->notify(new TicketFeedbackNotification($data));
        // Mail::to('miahira2@gmail.com')
        // ->send(new SendTicketMail($feedback));
      
      
        session()->flash('cls', 'success');
        session()->flash('msg', 'Ticket created successfully');
        return redirect()->route('ticket.index');
    }

}

<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\Event;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DataTables;
use DB;

class EventController extends Controller
{
    protected $user;
 
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function getEvents(Event $events, Request $request)
    {
        if ($request->ajax()) {
            DB::statement(DB::raw('set @rownum=0'));
            $data = $data = $events->latest('updated_at')->first()->get(['events.*', 
            DB::raw('@rownum  := @rownum  + 1 AS rownum')]);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="/admin/edit-event/'.$row->id.'" class="edit btn btn-success btn-sm"><i class="fas fa-edit"></i></a> <a href="javascript:void(0)" class="btn-delete btn btn-danger btn-sm" onclick="deleteFunction('."'".$row->id."'".');"><i class="fa fa-trash"></i></a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return response()->json(['event' => $data]);
    }

    public function getEventById($id)
    {
        $events = new Event;
        $data = $events->find($id)->toArray();
        return response()->json($data);
    }

    public function createEvent(Request $request) {
        $credentials = $request->only('name', 'slug', 'start_date', 'end_date');
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'name' => 'required',
            'slug' => 'required',
            'start_date'=> 'required',
            'end_date'=>'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }        

        try {
            $uuid = Str::uuid()->toString();
            
            $event = Event::create([
                'id' => $uuid,
                'name' => $request->get('name'),
                'slug' => $request->get('slug'),
                'start_date' => $request->get('start_date') ? $request->get('start_date') : null,
                'end_date' => $request->get('end_date') ? $request->get('end_date') : null
            ]);
        } catch (\Exception $e) {
            return $e;
    
            return response()->json([
                'status'   => 'error',
                'messages' => trans('controllermessages.error-problem-processing-order'),
            ]);
        }    

        return response()->json([
            'success' => true,
            'message' => 'Event created successfully',
            'data' => $event
        ], Response::HTTP_OK);
    }

    public function EditEventById(Request $request, $id) {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
   
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        try {

            $event = Event::find($id);
            $event->name = $input['name'];
            $event->slug = $input['slug'];
            $event->start_date = $input['start_date'] ? $input['start_date'] : null;
            $event->end_date = $input['end_date'] ? $input['end_date'] : null;

            if($event->start_date == $input('start_date')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Start Date is Same',
                    'data' => $event
                ]);
            } elseif($event->end_date == $input('end_date')) {
                return response()->json([
                    'success' => false,
                    'message' => 'End Date is Same',
                    'data' => $event
                ]);
            }

            $event->save();

        } catch (\Exception $e) {
            return $e;
    
            return response()->json([
                'status'   => 'error',
                'messages' => trans('controllermessages.error-problem-processing-order'),
            ]);
        }    

        return response()->json([
            'success' => true,
            'message' => 'Event Updated successfully',
            'data' => $event
        ], Response::HTTP_OK);
    }

    public function deleteEventById($id)
    {
        try {

            $event = Event::find($id);
            $event->delete();

        } catch (\Exception $e) {
            return $e;
    
            return response()->json([
                'status'   => 'error',
                'messages' => trans('controllermessages.error-problem-processing-order'),
            ]);
        }    

        return response()->json([
            'success' => true,
            'message' => 'Event Deleted successfully'
        ], Response::HTTP_OK);
    }
}

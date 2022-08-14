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

class EventController extends Controller
{
    protected $user;
 
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function getEvents(Event $events)
    {
        $data = $events->get()->toArray();
        return response()->json(['event' => $data]);
    }

    public function getEventById($id)
    {
        $events = new Event;
        $data = $events->find($id)->toArray();
        return response()->json($data);
    }

    public function createEvent(Request $request) {
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
            $uuid = Str::uuid()->toString();
            
            $event = Event::create([
                'id' => $uuid,
                'name' => $request->get('name'),
                'slug' => $request->get('name'),
                'start_date' => $request->get('start_date') ? Carbon::createFromFormat('d-m-Y',
                $request->get('start_date')) : null,
                'end_date' => $request->get('end_date') ? Carbon::createFromFormat('d-m-Y',
                $request->get('end_date')) : null
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
            $event->slug = $input['name'];
            $event->start_date = $input['start_date'] ? Carbon::createFromFormat('d-m-Y',
            $input['start_date']) : null;
            $event->end_date = $input['end_date'] ? Carbon::createFromFormat('d-m-Y',
            $input['end_date']) : null;

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

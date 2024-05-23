<?php
namespace App\Repository;

use App\Interfaces\SubscriberInterface;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Hash;

class SubscriberRepository implements SubscriberInterface
{
    // public function dispalyAppointmentsByUser()
    // {

    //     $appointments = Appointment::select('user_id','doctor_id','status_id','appointment_date','start_time')->with(['user','doctor','status'])->where('user_id',auth('user')->user()->id)->get();

    //     return response()->json(['data'=> $appointments ]);

    // }
    // public function ViewAddPopup()
    // {
    //     return view('pages.popups.ViewAddPopup');
    // }
    // public function ViewEditPopup($popupId)
    // {
    //     $Popup = Popup::find($popupId);

    //     return view('pages.popups.ViewEditPopup')->with('Popup', $Popup);
    // }

    public function CreateSubscriber($request)
    {

        $subscriber = new Subscriber();
        $subscriber->name = $request->name;
        $subscriber->username = $request->username;
        $subscriber->password = Hash::make($request->password);
        $subscriber->status = $request->status;

        $subscriber->save();

        return response()->json([
            'status' => 200,
            'message' => 'created succesfully'
        ]);

    }
    public function UpdateSubscriber($request, $subscriber_id)
    {

        $subscriper = Subscriber::find($subscriber_id);

        $subscriper->name = $request->name;
        $subscriper->username = $request->username;
        $subscriper->password = Hash::make($request->password);
        $subscriper->status = $request->status;

        $subscriper->save();

        return response()->json([
            'status' => 200,
            'message' => 'updated succesfully'
        ]);

    }
    public function DeleteSubscriber($subscriber_id)
    {

        $subscriper = Subscriber::find($subscriber_id);

        if(isset($subscriper))
        {

            $subscriper->delete();
            return response()->json([
                'status' => 200,
                'message' => 'deleted succesfully'
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'not found'
            ]);
        }

    }
    public function SearchByNameSubcriber($request)
    {

        $subscripers = Subscriber::where("name","like","%$request->name%")->get();

        return response()->json([
            'status' => 200,
            'data' => $subscripers
        ]);

    }
    public function SearchAdvancedSubcriber($request)
    {
        $subscripers = [];

        if ($request->has('username')) {
            $subscripers = Subscriber::where("username","like","%$request->username%")->get();

        }

        elseif ($request->has('status')) {

            $subscripers = Subscriber::where("status","like","%$request->status%")->get();

        }

        return response()->json([
            'status' => 200,
            'data' => $subscripers
        ]);

    }
    // public function getPopupById($attribute)
    // {
    //     $popupId = $attribute->popupId;
    //     $popup = Popup::find($popupId);

    //     return response()->json([
    //         'statusCode' => 200,
    //         'data' => $popup
    //     ]);

    // }


    // public function update($attribute, $popupId)
    // {

    //     $popup = Popup::find($popupId);

    //     $popup->title = $attribute->title;
    //     $popup->text = $attribute->text;
    //     $popup->show_deny_button = isset($attribute->show_deny_button) ? 1: 0;
    //     $popup->show_cancel_button = isset($attribute->show_cancel_button) ? 1: 0;
    //     $popup->animated = isset($attribute->animated) ? 1: 0;

    //     $popup->icon = $attribute->icon;
    //     $popup->position = $attribute->position;
    //     $popup->user_id = auth('user')->user()->id;
    //     $popup->save();

    //     return redirect('popups/index')->with('message', 'updated succesfully!');

    // }
    // public function changeReserved($attribute,$id)
    // {

    //     $file = ModelsFile::find($id);

    //     if($file->state == 'reserved' && $file->user_id == auth('user')->user()->id)
    //               {
    //                 $file->state = 'free';
    //                 $file->reserved_id = null ;
    //                 $file->save();
    //                 return redirect('files/index')->with('message', 'changed succesfully!');

    //               }

    //               else if($file->state == 'free')
    //               {
    //                 $file->state = 'reserved';
    //                 $file->reserved_id = auth('user')->user()->id ;
    //                 $file->save();

    //                 return redirect('files/index')->with('message', 'changed succesfully!');

    //               }

    //               else{
    //                 return redirect('files/index')->with('message', 'can not changed!');

    //               }






    //         return response()->json(['file updated'], 200);

    // }
    // public function update($attribute,$id)
    // {

    //     $file = ModelsFile::query()->find($id);
    //     $user = auth()->guard('user-api')->user();

    //     if($file->state != $user->id)
    //               {
    //                 return response()->json([
    //                   'message' => 'File is un available!',
    //                 ], 401);
    //               }


    //     if(!$attribute->file('filename'))
    //     {
    //         return response()->json(['update file not found'], 400);
    //     }

    //     $allowedfileExtension=['txt','docx','pdf','jpg','png'];
    //     $files = $attribute->file('filename');

    //         $extension = $files->getClientOriginalExtension();

    //         $check = in_array($extension,$allowedfileExtension);

    //         if($check) {

    //           $path = $file->path ;
    //           Storage::disk('mystorage')->delete($path );

    //           $name = $attribute->filename->getClientOriginalName();
    //           $path = Storage::disk('mystorage')->put('', $attribute->filename);

    //           $file->path = $path;
    //           $file->name = $name;
    //           $file->save();

    //         }
    //         else {
    //             return response()->json(['invalid_file_format'], 422);
    //         }

    //         $date = Carbon::now();
    //         $report = new Report();
    //         $report->file_id = $file->id ;
    //         $report->operation_name = "Update" ;
    //         $report->operation_date =  $date ;
    //         $report->user_name =  $user->name  ;
    //         $report->save();

    //         return response()->json(['file updated'], 200);

    // }

    // public function delete($id)
    // {
    //     $file = ModelsFile::query()->find($id);
    //           if($file->state == "0")
    //               {
    //                 Storage::delete($file->path);
    //                 $searchlist = Group_file::query()->where('file_id',$id)->get() ;
    //                 foreach($searchlist as $deletefile)
    //                 {
    //                   $deletefile->delete();
    //                 }

    //                 $date = Carbon::now();
    //                 $user= auth()->guard('user-api')->user();

    //                 $report = new Report();
    //                 $report->file_id = $file->id ;
    //                 $report->operation_name = "Delete" ;
    //                 $report->operation_date =  $date ;
    //                 $report->user_name =  $user->name  ;
    //                 $report->save();

    //                 $path = $file->path ;
    //                 Storage::disk('mystorage')->delete($path );
    //                 $file->delete();


    //                 return response()->json([
    //                   'message' => 'Deleted successfuly!',
    //                 ], 200);
    //               }
    //               else
    //               {
    //                 return response()->json([
    //                   'message' => 'File is used!',
    //               ], 401);
    //               }

    // }

    // public function readfile($id)
    // {
    //     $user= auth()->guard('user-api')->user();

    //     $file = ModelsFile::query()->find($id) ;
    //     if(!(($file->state==0)||($file->state==$user->id)))
    //     {
    //         return response()->json(['You cant open this file because it is being used'], 401);
    //     }

    //     $path = $file->path ;
    //     $name = $file->name ;
    //     $type = substr($name , strpos($name,'.')+1,strlen($name)-1);
    //     $download  = Storage::disk('mystorage')->get($path);
    //     $response = FacadesResponse::make($download, 200);
    //     $response->header('Content-Type', "application/$type");
    //     return $response;

    // }

    // public function checkIn($id)
    // {

    //     $user= auth()->guard('user-api')->user();

    //     $file = ModelsFile::query()->find($id) ;
    //     if($file->state!=0)
    //     {
    //         return response()->json(['This file is already booked'], 401);
    //     }

    //     $file->state = $user->id ;
    //     $file->save();

    //     $date = Carbon::now();
    //     $report = new Report();
    //     $report->file_id = $file->id ;
    //     $report->operation_name = "Check in" ;
    //     $report->operation_date =  $date ;
    //     $report->user_name =  $user->name  ;
    //     $report->save();

    //     return response()->json([
    //         'The file is booked successfully!',
    //     ],200);
    // }

    // public function checkout($id)
    // {
    //         $user= auth()->guard('user-api')->user();
    //         $file = ModelsFile::query()->find($id) ;
    //         if($file->state!=$user->id)
    //         {
    //             return response()->json(['wrong operation'], 401);
    //         }

    //         $file->state = 0 ;

    //         $file->save();

    //         $date = Carbon::now();
    //         $report = new Report();
    //         $report->file_id = $file->id ;
    //         $report->operation_name = "Check out" ;
    //         $report->operation_date =  $date ;
    //         $report->user_name =  $user->name  ;
    //         $report->save();

    //         return response()->json([

    //             'The file is unbooked successfully!',

    //         ],200);
    // }

    // public function BulkcheckIn($attribute)
    // {

    //     $user= auth()->guard('user-api')->user();

    //     DB::beginTransaction();

    //     $booked = false ;
    //     foreach($attribute->ids as $id)
    //     {
    //         $file = ModelsFile::query()->find($id) ;

    //         if(!$file)
    //         return response()->json(['Invalid id'], 401);

    //         DB::table('files')
    //         ->where('id', $id)
    //         ->lockForUpdate()
    //         ->get();

    //         if($file->state!=0)
    //         {
    //             $booked = true ;
    //         }
    //     }

    //     foreach($attribute->ids as $id)
    //     {
    //        $file = ModelsFile::query()->find($id) ;
    //        $file->state = $user->id ;
    //        $file->save();
    //        $date = Carbon::now();
    //        $report = new Report();
    //        $report->file_id = $file->id ;
    //        $report->operation_name = "Check in" ;
    //        $report->operation_date =  $date ;
    //        $report->user_name =  $user->name  ;
    //        $report->save();

    //     }


    //     if($booked)
    //     {
    //         DB::rollBack();
    //         return response()->json([
    //             'Some files are booked !',
    //         ],401);
    //     }


    //     DB::commit();


    //     return response()->json([
    //         'All files are booked successfully!',
    //     ],200);
    // }

    // public function filestate($id)
    // {
    //     $file = ModelsFile::find($id)->get();
    //     if($file[0]->state==0)
    //     return "free";
    //     else
    //     {
    //         return response()->json([
    //             "Booked for user {$file[0]->state}"
    //         ],200);
    //     }
    // }

    // public function filereport($id)
    // {
    //     $reports = Report::where('file_id',$id)->get();
    //     $total_report = "" ;
    //     foreach($reports as $report)
    //     {
    //         $total_report .= "operation:$report[operation_name] , user:$report[user_name] , date:$report[operation_date]\n" ;
    //     }
    //     Storage::disk('mystorage')->put("/reports/file $id report.txt",$total_report );
    //     $download  = Storage::disk('mystorage')->get("/reports/file $id report.txt");
    //     $response = FacadesResponse::make($download, 200);
    //     $response->header('Content-Type', "application/txt");
    //     return $response;
    // }


}

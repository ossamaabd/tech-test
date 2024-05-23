<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subcriber\SubscriberRequest;
use App\Interfaces\SubscriberInterface;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    private $repo;

    public function  __construct(SubscriberInterface $subscriberRepository)
    {
        $this->repo = $subscriberRepository;
    }
    public function CreateSubscriber(SubscriberRequest $req)
    {
        try{
            return  $this->repo->CreateSubscriber($req);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function UpdateSubscriber(SubscriberRequest $req,$subscriber_id)
    {
        try{
            return $this->repo->UpdateSubscriber($req,$subscriber_id);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function DeleteSubscriber($subscriber_id)
    {
        try{
            return  $this->repo->DeleteSubscriber($subscriber_id);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function SearchByNameSubcriber(Request $request)
    {
        try{
            return $this->repo->SearchByNameSubcriber($request);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function SearchAdvancedSubcriber(Request $request)
    {
        try{
            return $this->repo->SearchAdvancedSubcriber($request);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\BlogRequest;
use App\Interfaces\BlogInterface;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private $repo;

    public function  __construct(BlogInterface $blogRepository)
    {
        $this->repo = $blogRepository;
    }
    public function CreateBlog(BlogRequest $req)
    {
        try{
          return  $this->repo->CreateBlog($req);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function UpdateBlog(Request $req,$blog_id)
    {
        try{
            return $this->repo->UpdateBlog($req,$blog_id);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function DeleteBlog($blog_id)
    {
        try{
            return $this->repo->DeleteBlog($blog_id);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function SearchByTitleBlog(Request $request)
    {
        try{
            return $this->repo->SearchByTitleBlog($request);
        }
        catch(\Exception $e)
        {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function SearchAdvancedBlog(Request $request)
    {
        try{
            return  $this->repo->SearchAdvancedBlog($request);
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

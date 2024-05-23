<?php
namespace App\Repository;

use App\Interfaces\BlogInterface;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class BlogRepository implements BlogInterface
{

    public function CreateBlog($request)
    {

        $blog = new Blog();

        if ($request->hasFile('image')) {

            $blog_image = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/blogs/images', $blog_image);

            $blog->image = $blog_image;
        }

        $blog->title = $request->title;
        $blog->publish_date = $request->publish_date;
        $blog->status = $request->status;
        $blog->subscriber_id = auth('subscriber')->user()->id;

        $blog->save();

        return response()->json([
            'status' => 200,
            'message' => 'created succesfully'
        ]);

    }
    public function UpdateBlog($request, $blog_id)
    {

        $blog = Blog::find($blog_id);

        if ($request->hasFile('image')) {
            if ($blog->image) {
                $image_path = public_path('/blogs/images/') . $blog->image;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            $blog_image = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/blogs/images', $blog_image);

            $blog->image = $blog_image;
        }

        $blog->title = $request->title;
        $blog->publish_date = $request->publish_date;
        $blog->status = $request->status;

        $blog->save();

        return response()->json([
            'status' => 200,
            'message' => 'updated succesfully'
        ]);

    }
    public function DeleteBlog($blog_id)
    {

        $blog = Blog::find($blog_id);
        if(isset($blog))
        {
        $blog->delete();

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
    public function SearchByTitleBlog($request)
    {

        $blogs = Blog::where("title","like","%$request->title%")->get();

        return response()->json([
            'status' => 200,
            'data' => $blogs
        ]);

    }
    public function SearchAdvancedBlog($request)
    {
        $blogs = [] ;

        if ($request->has('image')) {

            $blogs = Blog::where("image","like","%$request->image%")->get();

        }

        elseif ($request->has('username')) {
            $blogs = Blog::where("username","like","%$request->username%")->get();

        }
        elseif ($request->has('publish_date')) {
            $blogs = Blog::whereDate("publish_date","like","%$request->publish_date%")->get();

        }

        elseif ($request->has('status')) {
            $blogs = Blog::where("status","like","%$request->status%")->get();
        }

        return response()->json([
            'status' => 200,
            'data' => $blogs
        ]);

    }




}

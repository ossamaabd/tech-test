<?php

namespace App\Interfaces;

interface BlogInterface
{
    public function CreateBlog($request);
    public function UpdateBlog($request ,$subscriber_id);
    public function DeleteBlog($subscriber_id);
    public function SearchByTitleBlog($request);
    public function SearchAdvancedBlog($request);


}

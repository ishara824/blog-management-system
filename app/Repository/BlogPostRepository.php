<?php

namespace App\Repository;

use App\Iface\BlogPostRepositoryInterface;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Auth;

class BlogPostRepository implements BlogPostRepositoryInterface
{
    public function getAllBlogsByUser()
    {
        $blogs = BlogPost::query()->where('created_by', auth()->user()->id)->get();
        return $blogs;
    }

    public function getBlogById($id)
    {
        $blog = BlogPost::query()->find($id);
        return $blog;
    }

    public function getAllBlogs()
    {
        $blogs = BlogPost::query()->with('author')->get()->all();
        return $blogs;
    }
}

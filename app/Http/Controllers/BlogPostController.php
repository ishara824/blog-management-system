<?php

namespace App\Http\Controllers;

use App\Iface\BlogPostRepositoryInterface;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogPostController extends Controller
{
    private $blogRepositoryInterface;

    public function __construct(BlogPostRepositoryInterface $blogRepositoryInterface)
    {
        $this->blogRepositoryInterface = $blogRepositoryInterface;
    }

    public function getAllBlogsByUser()
    {
        $blogs = $this->blogRepositoryInterface->getAllBlogsByUser();
        return response()->json(['blogs' => $blogs]);
    }

    public function createBlog(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'blog_content' => 'required',
            'published_date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 400, 'errors' => $validator->errors()->toArray()]);
        }

        $blog = new BlogPost();
        $blog->title = $request->title;
        $blog->content = $request->blog_content;
        $blog->published_date = $request->published_date;
        $blog->created_by = auth()->user()->id;
        $blog->save();

        return response()->json(['code' => 200, 'message' => 'Blog Saved Successfully!']);

    }

    public function editBlog(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'blog_content' => 'required',
            'published_date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 400, 'errors' => $validator->errors()->toArray()]);
        }

        $blog = BlogPost::find($request->blog_id);
        if ($blog) {
            $blog->title = $request->title;
            $blog->content = $request->blog_content;
            $blog->published_date = $request->published_date;
            $blog->updated_by = auth()->user()->id;
            $blog->update();

            return response()->json(['code' => 200, 'data' => 'Blog Edited Successfully!']);
        }

    }

    public function deleteBlog(Request $request)
    {
        $blog = $this->blogRepositoryInterface->getBlogById($request->blog_id);
        if ($blog) {
            $blog->delete();
            return response()->json(['code' => 200, 'data' => 'Blog Deleted Successfully!']);
        }
    }

    public function getBlogById($blog_id)
    {
        $blog = $this->blogRepositoryInterface->getBlogById($blog_id);
        if ($blog) {
            return response()->json($blog);
        }
    }

    public function getAllBlogs()
    {
        $blogs = $this->blogRepositoryInterface->getAllBlogs();
        if ($blogs) {
            return response()->json($blogs);
        }
    }
}

<?php

namespace App\Iface;

interface BlogPostRepositoryInterface
{
    public function getAllBlogsByUser();

    public function getBlogById($id);

    public function getAllBlogs();
}

<?php

namespace Controllers;

use App\http\Request;
use App\http\Response;
use App\view\View;
use Model\Posts;
use Model\PostTags;

/**
 * Controller for blogs
 */
class BlogController
{
    public function __construct(
        public Posts $postsModel,
        public PostTags $postTagsModel,
        public Request $request
    ) {}

    public function saveNewBlog(): Response
    {
        $params = $this->request->post();
        
        $tags = $params['tags'];
        unset($params['tags']);

        if ($this->postsModel->create($params)) {
            $this->savePostTags($tags);

            return (new Response())
            ->setHeader("Location: /home");
        } else {
            return (new Response())
            ->setStatusCode(400);
        }
    }

    public function getAllBlogs(): Response
    {
        $blogs = $this->postsModel->readAll();
        return new Response(new View("homeview", [
            "blogs" => $blogs,
            "backButton" => false
        ]));
    }

    public function deleteBlog(): Response
    {
        $blogId = $this->request->get()["id"];
        if ($this->postsModel->deleteById($blogId)) {
            return (new Response())
            ->setHeader("Location: /home");
        } else {
            return (new Response())
            ->setStatusCode(400);
        }
    }

    /**
     * Save each tags for one post in third relational
     * table
     *
     * @param array $tags
     * @return void
     */
    private function savePostTags(array $tags): void
    {
        $postId = $this->postsModel->getLastId();

        foreach ($tags as $tagId) {
            $this->postTagsModel->create([
                "tag_id" => $tagId,
                "post_id" => $postId
            ]);
        }
    }

    /**
     * Search between blogs and returning response
     *
     * @return Response
     */
    public function search(): Response
    {
        $word = $this->request->get()['search'];

        $results = $this->postsModel->search($word, ["title", "content", "category"]);
        return new Response(new View("homeview", [
            "blogs" => $results,
            "backButton" => true
        ]));
    }

    /**
     * Edit specific post
     *
     * @return Response
     */
    public function edit(): Response
    {
        $data = $this->request->get();
        $id = $data['id'];
        unset($data['id']);
        $data["updated_at"] = date('Y-m-d H:i:s', Time());

        if ($this->postsModel->update($id, $data)) {
            return (new Response())
            ->setHeader("Location: /home");
        } else {
            return (new Response())
            ->setStatusCode(400);
        }
    }

    /**
     * Get detail of each blog based on id
     *
     * @return Response
     */
    public function getBlog(): Response
    {
        $id = $this->request->get()['id'];
        $blog = $this->postsModel->readById($id);

        return (new Response(
            new View("editview", [
                "post" => $blog[0]
            ])
        ));
    }
}
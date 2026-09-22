<?php

namespace Controllers;

use App\http\Request;
use App\http\Response;
use App\view\View;
use Model\Tags;

class TagsController
{
    public function __construct(
        public Tags $tagModel,
        public Request $request
    ) {}

    public function getAllTags(): Response
    {
        $allTags = $this->tagModel->readAll();
        return new Response(
            new View("addview", ["tags" => $allTags])
        );
    }

    public function addTag(): Response
    {
        $tagName = $this->request->post()['newtag'];

        if ($this->tagModel->create([
            "name" => $tagName
        ])) {
            return (new Response())
            ->setHeader("Location: /add");
        } else {
            return (new Response())
            ->setStatusCode(400);
        }
    }
}
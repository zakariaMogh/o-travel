<?php


namespace App\Repositories;


use App\Contracts\CommentContract;
use App\Models\Comment;

class CommentRepository extends BaseRepositories implements CommentContract
{

    /**
     * @param Comment $model
     * @param array $filters
     */
    public function __construct(Comment $model, array $filters = [])
    {
        parent::__construct($model, $filters);
    }

    public function new(array $data)
    {
        return $this->model::create($data);
    }

    public function update($id, array $data)
    {
        $comment = $this->findOneById($id);

        $comment->update($data);

        return $comment;
    }

    public function destroy($id)
    {
        $comment = $this->findOneById($id);

        return $comment->delete();
    }
}

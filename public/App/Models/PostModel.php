<?php

namespace app\Models;
use app\BaseController;
use app\Models\DatabaseModel;

class PostModel
{

    /**
     * Get all posts from the database.
     *
     * @return array An array of all posts as associative arrays.
     */
    public static function getAllPosts(): array
    {
        $conn = DatabaseModel::getConn();
        $query = "SELECT * FROM Posts";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Get the most recent posts from the database.
     *
     * @param int $limit The maximum number of recent posts to retrieve (default is 3).
     * @return array|null An array of recent posts as associative arrays or null if no posts are found.
     */
    public static function getMostRecentPosts(int $limit = 3): ?array
    {
        $conn = DatabaseModel::getConn();
        $query = "SELECT * FROM Posts ORDER BY date_publication DESC LIMIT :limit";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    /**
     * Get a post by its ID from the database.
     *
     * @param int $postId The ID of the post to retrieve.
     * @return array|null An associative array representing the post or null if not found.
     */
    public static function getPostById(int $postId)
    {
        $conn = DatabaseModel::getConn();
        $query = "SELECT * FROM Posts WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $postId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Create a new post in the database.
     *
     * @param array $postData An associative array containing post data (title and content).
     * @return bool True if the post is created successfully, false otherwise.
     */
    public static function createPost(array $postData): bool
    {
        $conn = DatabaseModel::getConn();
        $query = "INSERT INTO Posts (title, content) VALUES (:title, :content)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':title', $postData['title'], \PDO::PARAM_STR);
        $stmt->bindParam(':content', $postData['content'], \PDO::PARAM_STR);
        return $stmt->execute();
    }

    /**
     * Update an existing post in the database.
     *
     * @param int $postId The ID of the post to update.
     * @param array $postData An associative array containing updated post data (title and content).
     * @return bool True if the post is updated successfully, false otherwise.
     */
    public static function updatePost(int $postId, array $postData): bool
    {
        $conn = DatabaseModel::getConn();
        $query = "UPDATE Posts SET title = :title, content = :content WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $postId, \PDO::PARAM_INT);
        $stmt->bindParam(':title', $postData['title'], \PDO::PARAM_STR);
        $stmt->bindParam(':content', $postData['content'], \PDO::PARAM_STR);
        return $stmt->execute();
    }

    /**
     * Delete a post from the database by its ID.
     *
     * @param int $postId The ID of the post to delete.
     * @return bool True if the post is deleted successfully, false otherwise.
     */
    public static function deletePost(int $postId): bool
    {
        $conn = DatabaseModel::getConn();
        $query = "DELETE FROM Posts WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $postId, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}

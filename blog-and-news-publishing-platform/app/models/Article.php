<?php
require_once(__DIR__ . "/../../config/database.php");

class Article
{
    public function getPublishedArticles()
    {
        global $conn;

        $sql = "SELECT articles.*, users.name AS author_name
        FROM articles
        JOIN users
        ON articles.author_id = users.id
        WHERE status = 'published'
        AND published_at IS NOT NULL
        ORDER BY published_at DESC";

        $result = $conn->query($sql);

        return $result;
    }

    public function getArticleById($id)
    {
        global $conn;

        $sql = "SELECT articles.*, users.name AS author_name FROM articles JOIN users ON articles.author_id = users.id WHERE articles.id = ? LIMIT 1";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function increaseViewCount($id)
    {
        global $conn;

        $sql = "UPDATE articles SET view_count = view_count + 1 WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function addComment($article_id, $user_id, $body)
    {
        global $conn;

        $sql = "INSERT INTO comments (article_id, user_id, `body`) VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "iis",
            $article_id,
            $user_id,
            $body
        );

        return $stmt->execute();
    }

    public function getComments($article_id)
    {
        global $conn;

        $sql = "SELECT comments.*, users.name FROM comments JOIN users ON comments.user_id = users.id WHERE article_id = ? ORDER BY created_at DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $article_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function likeArticle($article_id, $user_id)
    {
        global $conn;

        $checkSql = "SELECT * FROM likes WHERE article_id = ? AND user_id = ?";

        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param(
            "ii",
            $article_id,
            $user_id
        );

        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if($checkResult->num_rows > 0)
        {
            return false;
        }

        $sql = "INSERT INTO likes (article_id, user_id) VALUES (?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ii",
            $article_id,
            $user_id
        );
        return $stmt->execute();
    }

    public function getLikeCount($article_id)
    {
        global $conn;

        $sql = "SELECT COUNT(*) AS total_likes FROM likes WHERE article_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $article_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function saveReadingHistory($article_id, $user_id)
    {
        global $conn;

        $checkSql = "SELECT * FROM reading_history
        WHERE article_id = ?
        AND user_id = ?";

        $checkStmt = $conn->prepare($checkSql);

        $checkStmt->bind_param(
            "ii",
            $article_id,
            $user_id
        );

        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        if($checkResult->num_rows > 0)
        {
            return false;
        }

        $sql = "INSERT INTO reading_history
        (user_id, article_id)
        VALUES (?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "ii",
            $user_id,
            $article_id
        );
        return $stmt->execute();
    }

    public function saveArticle($article_id, $user_id)
    {
        global $conn;

        $checkSql = "SELECT * FROM reading_lists
        WHERE article_id = ?
        AND user_id = ?";

        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param(
            "ii",
            $article_id,
            $user_id
        );

        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if($checkResult->num_rows > 0)
        {
            return false;
        }

        $sql = "INSERT INTO reading_lists
        (user_id, article_id)
        VALUES (?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ii",
            $user_id,
            $article_id
        );

        return $stmt->execute();
    }

    public function getSavedArticles($user_id)
    {
        global $conn;

        $sql = "SELECT articles.* FROM reading_lists JOIN articles ON reading_lists.article_id = articles.id WHERE reading_lists.user_id = ? ORDER BY reading_lists.saved_at DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function getPopularArticles()
    {
        global $conn;

        $sql = "SELECT *
        FROM articles
        WHERE status = 'published'
        AND published_at IS NOT NULL
        ORDER BY view_count DESC
        LIMIT 5";

        $result = $conn->query($sql);
        return $result;
    }

    public function getCategories()
    {
        global $conn;

        $sql = "SELECT * FROM categories
        ORDER BY name ASC";

        $result = $conn->query($sql);

        return $result;
    }

        public function createArticle($author_id, $category_id, $title, $body, $excerpt, $status)
        {
            global $conn;

            $slug = strtolower(
            str_replace(
                " ",
                "-",
                $title
            )
            );
            $slug = $slug . "-" . time();

            $sql = "INSERT INTO articles
            (
                author_id,
                category_id,
                title,
                slug,
                body,
                excerpt,
                status,
                published_at
            )

            VALUES
            (
                ?, ?, ?, ?, ?, ?, ?, IF(?='published',NOW(),NULL)
            )";


            $stmt = $conn->prepare($sql);

            $stmt->bind_param(
                "iissssss",
                $author_id,
                $category_id,
                $title,
                $slug,
                $body,
                $excerpt,
                $status,
                $status
            );

            return $stmt->execute();
        }

    public function getAuthorOwnArticles($author_id)
    {
        global $conn;

        $sql = "SELECT *
        FROM articles
        WHERE author_id = ?
        ORDER BY created_at DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $author_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function deleteArticle($id, $author_id)
    {
        global $conn;

        $sql = "DELETE FROM articles
        WHERE id = ?
        AND author_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ii",
            $id,
            $author_id
        );
        return $stmt->execute();
    }

    public function getDraftArticles($author_id)
    {
        global $conn;

        $sql = "SELECT *
        FROM articles
        WHERE author_id = ?
        AND status = 'draft'
        ORDER BY created_at DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "i",
            $author_id
        );
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function getAuthorAnalytics($author_id)
    {
        global $conn;

        $sql = "SELECT
        COUNT(DISTINCT articles.id)
        AS total_articles,
        SUM(articles.view_count)
        AS total_views,
        COUNT(DISTINCT likes.id)
        AS total_likes,
        COUNT(DISTINCT comments.id)
        AS total_comments
        FROM articles
        LEFT JOIN likes
        ON articles.id = likes.article_id
        LEFT JOIN comments
        ON articles.id = comments.article_id
        WHERE articles.author_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "i",
            $author_id
        );
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }


    public function updateArticle($id, $author_id, $category_id, $title, $body, $excerpt, $status)
    {
        global $conn;

        $slug = strtolower(
        str_replace(
            " ",
            "-",
            $title
        )
        );
        $slug = $slug . "-" . time();

        $sql = "UPDATE articles
        SET
        category_id = ?,
        title = ?,
        slug = ?,
        body = ?,
        excerpt = ?,
        status = ?
        WHERE id = ?
        AND author_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "isssssii",
            $category_id,
            $title,
            $slug,
            $body,
            $excerpt,
            $status,
            $id,
            $author_id
        );
        return $stmt->execute();
    }


    public function submitForReview($id, $author_id)
    {
        global $conn;
        
        $sql = "UPDATE articles
        SET status = 'pending'
        WHERE id = ?
        AND author_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
        "ii",
        $id,
        $author_id
        );
        return $stmt->execute();
    }

    public function removeSavedArticle($article_id, $user_id)
    {
        global $conn;

        $sql="DELETE FROM reading_lists
        WHERE article_id=?
        AND user_id=?";

        $stmt=$conn->prepare($sql);
        $stmt->bind_param(
            "ii",
            $article_id,
            $user_id
        );
        return $stmt->execute();
    }

    public function updateArticleStatus($id, $status)
    {
        global $conn;

        $sql="UPDATE articles
        SET
        status=?,
        published_at=
        IF(?='published',NOW(),published_at)
        WHERE id=?";

        $stmt=$conn->prepare($sql);
        $stmt->bind_param(
            "ssi",
            $status,
            $status,
            $id
        );
        return $stmt->execute();
    }

    public function editorUpdateArticle($id, $title, $body, $excerpt)
    {
        global $conn;

        $sql="UPDATE articles
        SET
        title=?,
        body=?,
        excerpt=?
        WHERE id=?";

        $stmt=$conn->prepare($sql);
        $stmt->bind_param(
            "sssi",
            $title,
            $body,
            $excerpt,
            $id
        );
        return $stmt->execute();
    }
}
?>
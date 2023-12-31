<div class="container-center">
    <div class="container">
        <h2>Edit Post</h2>
        <form action="/edit-post?id=<?= $post['id'] ?>" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?= $post['title'] ?>" required>

            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="15" required><?= $post['content'] ?></textarea>

            <button type="submit">Save Changes</button>
        </form>
    </div>
</div>




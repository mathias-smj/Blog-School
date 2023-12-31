<div class="container-center">
    <div class="container">
     <h2>Create Post</h2>
     <form action="/post/create" method="POST">
         <label for="title">Title:</label>
         <input type="text" id="title" name="title" required>

         <label for="content">Content:</label>
         <textarea id="content" name="content" rows="15" required ></textarea>

         <button type="submit">Create</button>
     </form>
    </div>
 </div>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add Posts
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>                    
                @endif
                <form action="{{ route('post-upload') }}" method="post" id="postForm" enctype="multipart/form-data">
                    @csrf

                    <label for="category">Choose A Category:</label>
                    <select name="category_id" id="category" class="form-select" aria-label="Select a category">
                        <option value="mobile">Mobiles</option>
                        <option value="post">Posts</option>
                        <option value="electronic">Electronic</option>
                        <option value="car">Cars</option>
                    </select>
                    
                    <div class="mb-3">
                        <label for="post" class="form-label">Add a posts</label>
                        <input type="file" name="post" class="form-control" id="post" placeholder="enter your post">
                        <span style="color: red" id="post-error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Add a title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="enter your title">
                        <span style="color: red" id="title-error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">write content</label>
                        <textarea name="content" class="form-control" id="content" rows="3"></textarea>
                        <span style="color: red" id="content-error"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button id="postBtn" type="submit" class="btn btn-primary">upload now</button>
                    </div>
                </form>
                <script>
                    $(document).ready(function (){
                        $("#postBtn").click(function(e){
                            e.preventDefault();

                            let post = $("#post").val();
                            let title = $("#title").val();
                            let cotent = $("#content").val();
                            let category_id = $("#category").val();
                            let token = $('input[name="_token"]').val();
                            $.ajax({
                                url:"{{ route('post-upload') }}",
                                type:"POST",
                                data:{
                                    _token:token,
                                    post:post,
                                    title:title,
                                    content:content,
                                    category_id:category_id
                                },
                                success:function(response){
                                    alert("posts are uploaded")
                                    
                                },
                                error:function(xhr){
                                    console.log(xhr.responseJSON.errors);
                                    alert("error of uploading posts");
                                }
                            })
                        })
                    })
                </script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // Function to validate the form fields
                        function validateForm() {
                            let post = document.getElementById('post').value;
                            let title = document.getElementById('title').value;
                            let content = document.getElementById('content').value;
                
                            let postError = document.getElementById('post-error');
                            let titleError = document.getElementById('title-error');
                            let contentError = document.getElementById('content-error');

                            // Check if all fields are filled
                            if (!post) {
                                postError.textContent = 'Please upload a post file.';
                                focusOnError(postError, post);
                            }
                            if (!title) {
                                titleError.textContent = 'Please enter a title.';
                                focusOnError(titleError, title);
                            }
                            if (!content) {
                                contentError.textContent = 'Please enter content.';
                                focusOnError(contentError, content);
                            }
                
                            // If all fields are valid, return true
                            return true;
                        }
                
                        // Attach an event listener to the submit button
                        document.getElementById('postBtn').addEventListener('click', function (e) {
                            e.preventDefault(); // Prevent form submission
                
                            if (validateForm()) {
                                // If validation passes, submit the form
                                document.getElementById('postForm').submit();
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

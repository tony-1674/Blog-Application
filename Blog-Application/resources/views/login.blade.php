<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2 class="text-center mb-4">Login</h2>
    @if ($errors->has('message'))
      <div class="alert alert-danger">
        {{ $errors->first('message') }}
      </div>
    @endif
    <form action="{{ route('login-post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ old('email') }}">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" value="{{ old('password')  }}">
        </div>
        <button type="submit" id="loginBtn" class="btn btn-primary w-100">Login</button>
        <div class="text-center mt-3">
            <a href="{{ route('/') }}">register</a>
        </div>
    </form>
    <script>
        $(document).ready(function(){
            $("#loginBtn").click(function(e){
                e.preventDefault();

                let email = $("#email").val();
                let password = $("#password").val();
                let token = $('input[name="_token"]').val();

                $.ajax({
                    url:"{{ route('login-post') }}",
                    type:"POST",
                    data:{_token:token, email:email, password:password},
                    success:function(response){ 
                        window.location.href = "{{ route('home') }}"
                    },
                    error:function(xhr){
                        console.log(xhr.responseJSON.errors);
                        alert("error of login");
                    }
                });
            })
        });
    </script>
</div>

<!-- Bootstrap JS (optional for form validation) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

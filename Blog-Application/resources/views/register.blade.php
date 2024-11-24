<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h2 class="text-center mb-4">Register</h2>
            <form id="registerForm" method="post" action="{{ route('register') }}">
                @csrf
              <!-- Full Name -->
              <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" id="fullName" placeholder="Enter your full name" >
              </div>

              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" >
              </div>

              <!-- Password -->
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" >
              </div>

              <!-- Submit Button -->
              <div class="d-grid">
                <button type="submit" id="registerBtn" class="btn btn-primary">Register</button>
              </div>
            </form>
            <script>
                $(document).ready(function(){
                    $("#registerBtn").click(function(e){
                        e.preventDefault();

                        let name = $("#fullName").val();
                        let email = $("#email").val();
                        let password = $("#password").val();
                        let token = $('input[name="_token"]').val();

                        $.ajax({
                            url:"{{ route('register') }}",
                            type:"POST",
                            data:{_token:token, name:name, email:email, password:password },
                            success:function(response){
                                alert('Registration succesfully')
                                window.location.href = "{{ route('login') }}"
                            },
                            error:function(xhr){
                                console.log(xhr.responseJSON.errors);
                                alert("error of ahdfkahsdk");
                            }
                        })
                    })
                })
            </script>
            <!-- Login Link -->
            <div class="text-center mt-3">
              <p>Already have an account? <a href="{{ route('login') }}">Login here</a>.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Login</h2>

        <form id="loginForm" action="#" method="POST">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <input type="email" id="email" name="email"
                    class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600"
                    placeholder="Enter your email" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600"
                    placeholder="Enter your password" required>
            </div>

            <button type="submit"
                class="w-full py-3 px-4 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-200">Login</button>
        </form>

        <div class="mt-4 text-center">
            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800">Forgot your password?</a>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            e.preventDefault();
            
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;

            axios.post('/api/login', {
                email: email,
                password: password
            })
            .then(function (response) {
                // Show success message
                Swal.fire({
                    title: 'Success!',
                    text: 'Login successful!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = "{{ route('welcome') }}";
                });
            })
            .catch(function (error) {
                // Show error message
                Swal.fire({
                    title: 'Error!',
                    text: 'Invalid login details',
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                });
            });
        });

    </script>
</body>

</html>

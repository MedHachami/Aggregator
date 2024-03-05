<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>

<body>
    {{--  login --}}





    <div class="flex items-center min-h-screen p-4 bg-gray-100 lg:justify-center">
        <div
            class="flex flex-col overflow-hidden bg-white rounded-md shadow-lg max md:flex-row md:flex-1 lg:max-w-screen-md">
            <div
                class="p-4 py-6 text-white bg-blue-500 md:w-80 md:flex-shrink-0 md:flex md:flex-col md:items-center md:justify-evenly">
                <div class="my-3 text-4xl font-bold tracking-wider text-center">
                    <a href="#">K-WD</a>
                </div>
                <p class="mt-6 font-normal text-center text-gray-300 md:mt-0">With the power of K-WD, you can now focus
                    only on functionaries for your digital products, while leaving UI design on </p>
                <p class="flex flex-col items-center justify-center mt-10 text-center"><span>Don't have an
                        account?</span><a href={{ route('register') }} class="underline">Get Started!</a></p>
            </div>
            <div class="p-5 bg-white md:flex-1">
                <h3 class="my-4 text-2xl font-semibold text-gray-700">Account Login</h3>
                <form id="loginForm" class="flex flex-col space-y-5">
                    <div class="flex flex-col space-y-1">
                        <label for="email" class="text-sm font-semibold text-gray-500">Email address</label>
                        <input type="email" id="email" name='email' autofocus
                            class="px-4 py-2 transition duration-300 border border-gray-300 rounded focus:border-transparent focus:outline-none focus:ring-4 focus:ring-blue-200" />
                    </div>
                    <div class="flex flex-col space-y-1">
                        <div class="flex items-center justify-between">
                            <label for="password" class="text-sm font-semibold text-gray-500">Password</label>
                            <a href={{ route('forget') }}
                                class="text-sm text-blue-600 hover:underline focus:text-blue-800">Forgot Password?</a>
                        </div>
                        <input type="password" id="password" name="password"
                            class="px-4 py-2 transition duration-300 border border-gray-300 rounded focus:border-transparent focus:outline-none focus:ring-4 focus:ring-blue-200" />
                    </div>
                    {{-- <div class="flex items-center space-x-2">
                    <input type="checkbox" id="remember" class="w-4 h-4 transition duration-300 rounded focus:ring-2 focus:ring-offset-0 focus:outline-none focus:ring-blue-200"/>
                    <label for="remember" class="text-sm font-semibold text-gray-500">Remember me</label>
                </div> --}}
                    <div>
                        <button onclick="login(event)"
                            class="w-full px-4 py-2 text-lg font-semibold text-white transition-colors duration-300 bg-blue-500 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-blue-200 focus:ring-4">Log
                            in</button>
                    </div>
                    <div id="errorContainer" class="text-red-500 mt-2"></div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script>
        function login(event) {
            event.preventDefault();
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');

            const email = emailInput.value;
            const password = passwordInput.value;

            const data = new FormData();
            data.append('email', email);
            data.append('password', password);



            axios.post('http://127.0.0.1:8000/api/login', data)
                .then((response) => {
                    const data = response.data;
                    console.log(data.token);
                    localStorage.setItem('token', data.token);

                    axios.get('api/get-user', {
                        headers: {
                            'Authorization': 'Bearer ' + data.token,
                        }
                    })
                        .then(response => {
                            var role = response.data.user.roles;
                            if (role == 'admin') {
                                window.location.href = '/dashboard';
                            } else {
                                window.location.href = '/';
                            }
                        })
                        .catch(error => {
                            localStorage.clear();
                            location.reload();
                        });

                })
                .catch((error) => {
                    var errors = error.response.data.error;

                    document.getElementById('errorContainer').innerHTML = errors;
                });

        }
    </script>

</body>

</html>

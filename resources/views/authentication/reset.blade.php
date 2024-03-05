<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password </title>
    @vite('resources/css/app.css')

</head>
<body>
<div class="flex items-center min-h-screen p-4 bg-gray-100 lg:justify-center">
    <div class="flex flex-col overflow-hidden bg-white rounded-md shadow-lg max md:flex-row md:flex-1 lg:max-w-screen-md">

        <div class="p-5 bg-white md:flex-1">
            <h3 class="my-4 text-2xl font-semibold text-gray-700 text-center">Reset Password</h3>
            <form action="{{route('reset_password')}}" method="POST" class="flex flex-col space-y-5">
                @csrf

                <input type="text" name="token_email" class=" hidden" value="{{$token}}">
                <input type="text" name="email" class=" hidden" value="{{$email}}">

                <div class="flex flex-col space-y-1">
                    <div class="flex items-center justify-between">
                        <label for="password" class="text-sm font-semibold text-gray-500">New Password </label>
                    </div>
                    <input type="password" id="password" name="password" class="px-4 py-2 transition duration-300 border border-gray-300 rounded focus:border-transparent focus:outline-none focus:ring-4 focus:ring-blue-200"/>
                </div>
                <div class="flex flex-col space-y-1">
                    <div class="flex items-center justify-between">
                        <label for="confirm-password" class="text-sm font-semibold text-gray-500">Confirm Password</label>

                    </div>
                    <input
                        type="confirm-password"
                        id="confirm-password"
                        name="confirm-password"
                        class="px-4 py-2 transition duration-300 border border-gray-300 rounded focus:border-transparent focus:outline-none focus:ring-4 focus:ring-blue-200"
                    />
                </div>

                <div>
                    <button type="submit" class="w-full px-4 py-2 text-lg font-semibold text-white transition-colors duration-300 bg-blue-500 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-blue-200 focus:ring-4">Update Password</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
</body>
</html>

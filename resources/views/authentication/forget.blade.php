<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget Password</title>
    @vite('resources/css/app.css')

</head>
<body>
<div class="flex items-center min-h-screen p-4 bg-gray-100 lg:justify-center">
    <div class="flex flex-col overflow-hidden bg-white rounded-md shadow-lg max md:flex-row md:flex-1 lg:max-w-screen-md">
        <div class="p-4 py-6 text-white bg-blue-500 md:w-80 md:flex-shrink-0 md:flex md:flex-col md:items-center md:justify-evenly" >
            <div class="my-3 text-4xl font-bold tracking-wider text-center">
                <a href="#">K-WD</a>
            </div>
            <p class="mt-6 font-normal text-center text-gray-300 md:mt-0">With the power of K-WD, you can now focus only on functionaries for your digital products, while leaving UI design on </p>
            <p class="flex flex-col items-center justify-center mt-10 text-center"><span>Don't have an account?</span><a href={{route('register')}} class="underline">Get Started!</a></p>
        </div>
        <div class="p-5 bg-white md:flex-1">
                        <h3 class="my-4 text-2xl text-center font-semibold text-gray-700">Réinitialisation du mot de passe</h3>
                        <form action="{{route('send_email')}}" method="POST" class="flex flex-col space-y-5">
                            @csrf
                            <div class="flex flex-col space-y-1">
                                <label for="email" class="text-sm font-semibold text-gray-500">Email address</label>
                                <input
                                    name="email"
                                    type="email"
                                    id="email"
                                    autofocus
                                    class="px-4 py-2 transition duration-300 border border-gray-300 rounded focus:border-transparent focus:outline-none focus:ring-4 focus:ring-blue-200"
                                />
                            </div>



                            <div>
                                <button
                                    type="submit"
                                    class="w-full px-4 py-2 mt-12 text-lg font-semibold text-white transition-colors duration-300 bg-blue-500 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-blue-200 focus:ring-4"
                                >
                                   Reset Password</button>
                            </div>
                    </div>
                    </form>
                </div>
    </div>
</div>
</div>
</body>
</html>

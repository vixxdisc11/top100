<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="/resources/css/app.css" rel="stylesheet">

    <title>Document</title>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

  <div class="w-full max-w-md bg-white shadow-sm rounded-xl p-8">
    <!-- Logo -->
    <div class="flex justify-center ">
      <img src="{{ asset('img/cryptologo2.png') }}" alt="Cryptocurrency Top 100 logo" class="w-40 h-40">
    </div>

    <!-- Title -->
    <h2 class="text-center text-2xl font-semibold text-gray-800 mb-2">
      Sign in to your account
    </h2>
    <p class="text-center text-sm text-gray-500 mb-6">
      Or <a href="#" class="text-indigo-600 hover:underline font-medium">create a new account</a>
    </p>

    <!-- Form -->
    <form class="space-y-4">
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
        <input type="email" id="email" name="email"
               class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
               required>
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password"
               class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
               required>
      </div>

      <div class="flex items-center justify-between">
        <label class="flex items-center text-sm text-gray-600">
          <input type="checkbox" class="mr-2 rounded border-gray-300 focus:ring-indigo-500"> Remember
        </label>
        <a href="#" class="text-sm text-indigo-600 hover:underline">Forgot your password?</a>
      </div>

      <button type="submit"
              class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Sign in
      </button>
    </form>
  </div>

</body>
</html>

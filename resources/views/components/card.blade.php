
@props(['id','name','age','date','gender','email','address','phone','image'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Card</title>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 text-white p-6">
    <div class="max-w-xl w-full bg-gray-800 bg-opacity-80 backdrop-blur-md rounded-2xl p-10 shadow-lg hover:shdow-blue-500/100 hover:border  hover:border-blue-400 relative transform transition-transform hover:-translate-y-1">
        <!-- Avatar -->
        <div class="relative w-28 h-28 mx-auto mb-6">
            <div class="w-full h-full rounded-full bg-gradient-to-r from-blue-400 to-purple-400 opacity-80">
                <img src={{$image}} class="rounded-full" alt="">
            </div>
            {{--  <div class="absolute inset-0 rounded-full border-4 border-transparent bg-gradient-to-r from-blue-400 to-purple-400"></div>  --}}
        </div>
        
        <!-- Profile Info -->
        <div class="text-center">
            <h2 class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">{{$name}}</h2>
            <p class="text-gray-400 text-sm mb-4">{{$email}}</p>
        </div>
        
        <!-- Stats -->
        <div class="flex justify-around border-t border-b border-gray-700 py-4 mb-4">
            <div class="text-center">
                <span class="block text-lg font-semibold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">{{$gender}}</span>
                <span class="text-gray-400 text-sm">gender</span>
            </div>
            <div class="text-center">
                <span class="block text-lg font-semibold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">{{$date}}</span>
                <span class="text-gray-400 text-sm">date of birth</span>
            </div>
            <div class="text-center">
                <span class="block text-lg font-semibold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">{{$phone}}</span>
                <span class="text-gray-400 text-sm">phone number</span>
            </div>
        </div>
        
        <!-- Bio -->
        <p class="text-gray-400 text-center mb-4">{{$address}}</p>
        
        
        <!-- Actions -->
        <div class="flex gap-4">
            <button class="flex-1 py-2 rounded-lg border border-gray-600 bg-gradient-to-r from-blue-400 to-purple-400 text-white transition-transform hover:scale-105"><a href="{{url('/students')}}">go back</a> </button>
        </div>
    </div>
</body>
</html>

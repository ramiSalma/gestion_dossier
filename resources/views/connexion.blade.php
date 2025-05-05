<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>نظام تدبير الملفات</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Cairo', sans-serif;
      background-color: #f0f0f0;
      overflow: hidden;
      unicode-bidi:bidi-override;
  direction:rtl;
    }

    #pdf {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .pages {
      position: relative;
      height: 600px;
      perspective: 2000px;
      direction: rtl;
    }

    .page {
      width: 500px;
      height: 600px;
      background: grey;
      position: absolute;
      transition: all 6s;
      transform-origin: right center;
      animation-duration: 1s;
      animation-fill-mode: forwards;
    }

    .page:nth-child(2) {
      background: green;
      animation-name: openRight;
      background-size: cover;
    }

    .page:nth-child(3) {
      animation-name: openRight2;
      animation-delay: 0.15s;
      background: #F7B316;
    }

    .page:nth-child(4) {
      animation-name: openRight3;
      animation-delay: 0.3s;
      
    }

  @keyframes openRight {
    0% {
      transform: rotateY(2deg);
      z-index: 3;
    }
    100% {
      transform: rotateY(180deg);
      z-index: 1;
    }
  }

  @keyframes openRight2 {
    0% {
      transform: rotateY(1deg);
      z-index: 2;
    }
    100% {
      transform: rotateY(179deg);
      z-index: 2;
    }
  }

  @keyframes openRight3 {
    0% {
      transform: rotateY(0deg);
      z-index: 1;
    }
    100% {
      transform: rotateY(178deg);
      z-index: 3;
    }
  }  
    .mozakhraf {
        font-family: 'Cairo', sans-serif; /* Apply Cairo font for Arabic text */
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5); /* Text shadow for a more decorative look */
        letter-spacing: 1px; /* Optional for better spacing */
      }
   
    
  </style>
</head>
<body>
  <div id="pdf">
    <div class="pages">
        <!-- Right Cover -->
        <div class="page p-6 bg-blue-950 shadow-lg rounded-lg">
            <form method="post" id="loginForm" action="{{ route('login.login') }}" class="mt-[120px]">
                @csrf
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                    {{ session('error') }}
                    </div>
                @endif
                <h3 class="text-2xl md:text-3xl font-bold mt-[70px]  mb-4 text-gray-800 mozakhraf">تسجيل الدخول</h3>
                <p class="text-gray-600 mb-6 text-sm md:text-base mozakhraf">يرجى إدخال بياناتك لتسجيل الدخول إلى حسابك.</p>

                <div class="mb-4">
                <label class="block text-sm mb-2 font-medium text-gray-700">اسم المستخدم</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                </div>

                <div class="mb-4">
                <label class="block text-sm mb-2 font-medium text-gray-700">كلمة المرور</label>
                <input type="password" name="password"
                    class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                </div>

                @error('name')
                <p class="text-red-500 text-xl mt-1">{{ $message }}</p>
                @enderror
            
                <button type="submit" onclick="hello()"
                class="w-full bg-blue-950 hover:bg-blue-900 text-white font-semibold py-2 rounded text-sm md:text-base">
                تسجيل الدخول
                </button>
        </div>

      <div class="page shadow-lg rounded-lg"></div>
      <div class="page shadow-lg rounded-lg"></div>

      <!-- Left Page (login form) -->
      
      <div class="page shadow-lg rounded-lg bg-purple-950 flex flex-col items-center justify-center p-6">
        <img src="https://www.maroc.ma/sites/default/files/2024-11/Armoiries%20du%20Maroc.svg" class="w-[100px]" alt="">
        <h2 class="text-white  text-3xl md:text-4xl font-bold text-center z-10 mozakhraf scale-x-[-1]">نظام تدبير الملفات</h2>
      </div>
    </div>
  </div>

</body>
</html>

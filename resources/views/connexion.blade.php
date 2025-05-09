<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>نظام تدبير الملفات</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Cairo', sans-serif;
      background-color: #f0f0f0;
      overflow: hidden;
      unicode-bidi: bidi-override;
      direction: rtl;
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
      background: #fff;
      position: absolute;
      transition: all 1.5s ease-in-out;
      transform-origin: right center; /* Changed to right for Arabic book */
      animation-duration: 1.5s;
      animation-fill-mode: forwards;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      border-radius: 5px;
    }

    /* Animation for the blue page */
    @keyframes openBlue {
      0% {
        transform: rotateY(0deg);
      }
      100% {
        transform: rotateY(170deg); /* Changed to positive value */
      }
    }

    /* Blue page is first */
    .page:nth-child(1) {
      background: linear-gradient(to left, #1e3a8a, #1e40af); /* Blue gradient */
      z-index: 4; /* Highest z-index to be on top initially */
      transform-origin: right center; /* Right for Arabic book */
      backface-visibility: hidden; /* Hide backface during rotation */
    }
    
    /* Add a back side to the blue page */
    .page:nth-child(1)::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: #021570;
      transform: rotateY(180deg);
      backface-visibility: hidden;
      border-radius: 5px;
    }
    
    /* Make sure content stays visible correctly */
    .page-content {
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 2rem;
      box-sizing: border-box;
      backface-visibility: hidden; /* Hide when rotated */
    }

    /* Middle pages */
    .page:nth-child(2) {
      background: #021570;
      animation-name: openRight;
      animation-delay: 0.2s;
      z-index: 3;
    }
    
    /* Reverse text for second page */
    .reverse-text {
      direction: rtl;
      unicode-bidi: bidi-override;
      text-align: center;
    }

    .page:nth-child(3) {
      background: linear-gradient(to left, #f0f9ff, white);
      animation-name: openRight2;
      animation-delay: 0.4s;
      z-index: 2;
    }

    /* Login form page */
    .page:nth-child(4) {
      background: #fff;
      z-index: 1; /* Removed animation for the login form page */
    }

    /* Animations for page turning */
    @keyframes openRight {
      0% {
        transform: rotateY(0deg);
      }
      100% {
        transform: rotateY(160deg);
      }
    }

    @keyframes openRight2 {
      0% {
        transform: rotateY(0deg);
      }
      100% {
        transform: rotateY(150deg);
      }
    }

    /* Add animation for the first (blue) page */
    .page:nth-child(1).animate {
      animation-name: openRight0;
      z-index: 4;
    }

    @keyframes openRight0 {
      0% {
        transform: rotateY(0deg);
      }
      100% {
        transform: rotateY(170deg);
      }
    }

    .mozakhraf {
      font-family: 'Cairo', sans-serif;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
      letter-spacing: 0.5px;
    }

    .login-form {
      background-color: rgba(255, 255, 255, 0.95);
      border-radius: 10px;
      padding: 2rem;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 400px;
      margin: 0 auto;
      border: 1px solid #d4af37;
    }

    .form-input {
      transition: all 0.3s ease;
    }

    .form-input:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
    }

    .login-button {
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .login-button:after {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: rgba(35, 34, 34, 0.2);
      transition: all 0.4s ease;
    }

    .login-button:hover:after {
      left: 100%;
    }

    .emblem {
      width: 80px;
      height: 80px;
      margin: 0 auto 1rem;
      display: block;
    }

    .page-content {
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 2rem;
      box-sizing: border-box;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100">
  <div id="pdf">
    <div class="pages">
      <!-- Blue Title Page -->
      <div class="page shadow-lg rounded-lg flex flex-col items-center justify-center p-6">
        <div class="page-content text-center">
          <img src="https://www.maroc.ma/sites/default/files/2024-11/Armoiries%20du%20Maroc.svg" class="w-[120px] mb-6" alt="شعار المملكة المغربية">
          <h2 class="text-white text-3xl md:text-4xl font-bold mb-4 mozakhraf">المملكة المغربية</h2>
          <h3 class="text-white text-2xl md:text-3xl font-bold mb-8 mozakhraf">وزارة العدل</h3>
          <div class="w-24 h-1 bg-yellow-400 mx-auto mb-8"></div>
          <h1 class="text-white text-3xl md:text-4xl font-bold mozakhraf">نظام تدبير الملفات</h1>
        </div>
      </div>

      <!-- Middle Pages -->
      <div class="page shadow-lg rounded-lg">
        <div class="page-content">
          <img src="https://www.maroc.ma/sites/default/files/2024-11/Armoiries%20du%20Maroc.svg" class="w-[100px] mb-6" alt="شعار المملكة المغربية">
          <div class="w-20 h-1 bg-blue-600 mx-auto mb-6"></div>
          
        </div>
      </div>
      <div class="page shadow-lg rounded-lg"></div>

      <!-- Login Form -->
      <div class="page p-6 bg-white shadow-lg rounded-lg">
        <div class="page-content">
          <img src="https://www.maroc.ma/sites/default/files/2024-11/Armoiries%20du%20Maroc.svg" class="emblem" alt="شعار المملكة المغربية">
          
          <div class="login-form">
            <form method="post" id="loginForm" action="{{ route('login.login') }}">
              @csrf
              
              <h3 class="text-2xl md:text-3xl font-bold mb-4 text-blue-900 mozakhraf text-center">تسجيل الدخول</h3>
              <p class="text-gray-600 mb-6 text-sm md:text-base mozakhraf text-center">يرجى إدخال بياناتك للوصول إلى النظام</p>
              
              @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                  {{ session('error') }}
                </div>
              @endif

              <div class="mb-5">
                <label class="block text-sm mb-2 font-medium text-gray-700">اسم المستخدم</label>
                <input type="text" name="name" value="{{ old('name') }}"
                  class="form-input w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
              </div>

              <div class="mb-6">
                <label class="block text-sm mb-2 font-medium text-gray-700">كلمة المرور</label>
                <input type="password" name="password"
                  class="form-input w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
              </div>

              @error('name')
                <p class="text-red-500 text-sm mt-1 mb-3">بيانات غير صحيحة</p>
              @enderror
          
              <button type="submit"
                class="login-button w-full bg-blue-900 hover:bg-blue-800 text-white font-semibold py-3 px-4 rounded-lg text-sm md:text-base transition-all duration-300 ease-in-out">
                تسجيل الدخول
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Add a slight delay before starting animations
      setTimeout(function() {
        // Add animation class to the first page
        document.querySelector('.page:nth-child(1)').classList.add('animate');
        
        // Focus on username field after animation completes
        setTimeout(function() {
          document.querySelector('input[name="name"]').focus();
        }, 1500);
      }, 500);
    });
  </script>
</body>
</html>

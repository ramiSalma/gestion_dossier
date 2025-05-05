<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>داشبورد</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body class="bg-gray-100 text-gray-900">

  <!-- Top Navbar -->
  <div class="w-full bg-white shadow fixed top-0 z-50">
    <div class="flex justify-between items-center px-4 py-2">
      <div class="flex items-center gap-3">
        <!-- Sidebar Toggle -->
        <button id="toggleSidebar" class="lg:hidden text-xl">&#9776;</button>
        <span class="text-lg font-bold">مدیر</span>
      </div>
      <div class="flex items-center gap-4">
        <div class="relative">
          <button class="text-gray-600 hover:text-black relative">
            🔔
            <span class="absolute -top-1 -left-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">1</span>
          </button>
        </div>
        <img src="{{ asset('img/avatars/6.jpg') }}" class="w-8 h-8 rounded-full" alt="avatar">
      </div>
    </div>

    <!-- Secondary Navbar -->
    <div class="bg-white border-t border-gray-200 px-4 py-2 flex justify-between items-center text-sm text-gray-600">
      <div class="flex gap-3">
        <a href="#" class="hover:text-black">خانه</a>
        <span>/</span>
        <a href="#" class="hover:text-black">مدیریت</a>
        <span>/</span>
        <span class="text-blue-500">داشبورد</span>
      </div>
      <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">جدید</button>
    </div>
  </div>

  <!-- Sidebar -->
  <aside id="sidebar" class="fixed top-[88px] right-0 w-64 h-[calc(100%-88px)] bg-gray-800 text-white transform translate-x-full lg:translate-x-0 transition duration-300 z-40">
    <ul class="p-4 space-y-2 text-sm">
      <li class="text-gray-400 font-bold">مدیریت کاربران</li>
      <li><a href="#" class="block py-2 px-3 hover:bg-gray-700">ثبت کاربر</a></li>
      <li><a href="#" class="block py-2 px-3 hover:bg-gray-700">لیست کاربران</a></li>
      <li><a href="#" class="block py-2 px-3 hover:bg-gray-700">دسترسی کاربران</a></li>

      <li class="text-gray-400 font-bold mt-4">مدیریت فایل ها</li>
      <li><a href="#" class="block py-2 px-3 hover:bg-gray-700">لیست فایل ها</a></li>

      <li class="text-gray-400 font-bold mt-4">گزارش گیری</li>
      <li><a href="#" class="block py-2 px-3 hover:bg-gray-700">کاربران</a></li>
      <li><a href="#" class="block py-2 px-3 hover:bg-gray-700">فایل ها</a></li>
    </ul>
  </aside>

  <!-- Main Content -->
  <main class="pt-[120px] pr-4 pl-4 lg:pr-72 transition-all duration-300">
    @yield('content')
  </main>



  <script>
    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('toggleSidebar');

    toggle.addEventListener('click', () => {
      sidebar.classList.toggle('translate-x-full');
    });
  </script>

</body>
</html>




<style>
    .midtext{  
        font-family: "Dancing Script", cursive;
        font-optical-sizing: auto;
        font-weight: <weight>;
        font-style: normal;
  }
    
</style>
    
    <nav class="bg-indigo-950 z-10 p- flex justify-between items-center absolute left-0 w-[100%]">
        <!-- Left Section: Logo and Search Bar -->
        <!-- Header -->
        
        <!-- Right Section: Notifications and Admin Info -->
        <div class="flex items-center space-x-6">
            <!-- Notifications Icon -->
            <div class="text-white cursor-pointer">
                <i class="fas fa-bell text-xl"></i>
            </div>
            <!-- Admin Info -->
            <div class="flex items-center space-x-3">
                <!-- Admin Picture -->
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTEytaU1okXcPwqLgAzwfDimvvYST7la-GGYw&s"  class="h-10 w-10 rounded-full">
                <!-- Admin Name -->
                <span class="text-white text-lg">سميرة العلمي</span>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <!-- Logo -->
                <h1 class="text-white text-2xl ">  </h1>
            
        </div>
    </nav>
    <div class="w-full bg-white shadow fixed top-0 z-50">

        <div class="relative">
            <div class="bg-[white] text-indigo-950 px-5 flex items-center justify-between">
                <h1 class="text-xl font-bold"></h1>
                <img src="https://cdn.le-guide.ma/wp-content/uploads/2023/10/D985D8A8D8A7D8B1D8A7D8A9-D8AAD988D8B8D98AD981-D988D8B2D8A7D8B1D8A9-D8A7D984D8B9D8AFD984.webp"
                alt="Logo" class="w-[100px]">
                <h1 class="text-xl midtext font-bold"><span class="text-[orange]">تدبير</span>قضايا الملفات </h1>
            </div>
        </div>

    
        <!-- Secondary Navbar -->
        <div class="bg-blue-950 pr-[200px] text-white border-t border-gray-200 px-4 py-6 flex justify-between items-center text-sm text-gray-600">
            <div class="flex items-center space-x-3">
                <!-- Sidebar Toggle -->
                <button id="toggleSidebar" class="lg:hidden text-xl">&#9776;</button>
                <a href="{{Route('admin.logout')}}">تسجيل الخروج</a>
                <i class="fa-solid fa-right-from-bracket"></i>
                <!-- Admin Name -->
                <span class="text-white "> Admin      </span>
                <!-- Admin Picture -->
                <i class="fa-solid fa-circle-user"></i>
            </div>
          {{--  <div class="flex gap-3">
            <a href="#" class="hover:text-black">خانه</a>
            <span>/</span>
            <a href="#" class="hover:text-black">مدیریت</a>
            <span>/</span>
            <span class="text-blue-500">داشبورد</span>
          </div>  --}}
        </div>
      </div>
    
      
<!-- Sidebar -->
<aside id="sidebar" class="fixed top-[120px] right-0 w-64 h-[calc(100%-88px)] bg-blue-950 text-white transform translate-x-full lg:translate-x-0 transition duration-300 z-40">
  <ul class="p-4 space-y-2 text-sm">

    <a href="{{ url('/') }}" class="group flex items-center justify-end py-2.5 px-4 rounded-full transition-all duration-300 hover:bg-white">
      <span class="text-white group-hover:text-blue-900 font-medium">الرئيسية</span>
      <i class="fa-solid fa-house ml-3 text-white group-hover:text-orange-600"></i>
    </a>

    <a href="{{ url('/dossiers/create') }}" class="group flex items-center justify-end py-2.5 px-4 rounded-full transition-all duration-300 hover:bg-white">
      <span class="text-white group-hover:text-blue-900 font-medium">اضافة ملف</span>
      <i class="fa-solid fa-users-line ml-3 text-white group-hover:text-orange-600"></i>
    </a>

    <a href="{{ url('/listes/create') }}" class="group flex items-center justify-end py-2.5 px-4 rounded-full transition-all duration-300 hover:bg-white">
      <span class="text-white group-hover:text-blue-900 font-medium">اضافة قائمة</span>
      <i class="fa-solid fa-users ml-3 text-white group-hover:text-orange-600"></i>
    </a>

    <a href="{{ url('/dossiers') }}" class="group flex items-center justify-end py-2.5 px-4 rounded-full transition-all duration-300 hover:bg-white">
      <span class="text-white group-hover:text-blue-900 font-medium">تدبير ملف</span>
      <i class="fa-solid fa-gears ml-3 text-white group-hover:text-orange-600"></i>
    </a>

    <a href="{{ url('/listes') }}" class="group flex items-center justify-end py-2.5 px-4 rounded-full transition-all duration-300 hover:bg-white">
      <span class="text-white group-hover:text-blue-900 font-medium">تدبير قائمة</span>
      <i class="fa-solid fa-gears ml-3 text-white group-hover:text-orange-600"></i>
    </a>

  </ul>
</aside>

<!-- Sidebar -->
<aside id="sidebar" class="fixed top-[120px] right-0 w-64 h-[calc(100%-120px)] bg-blue-950 text-white transform translate-x-full lg:translate-x-0 transition duration-300 z-40 shadow-xl overflow-y-auto">
  <div class="p-5">
    <div class="mb-6 border-b border-blue-800/50 pb-4">
      <h2 class="text-lg font-bold text-center text-orange-300 mb-2">القائمة الرئيسية</h2>
    </div>
    
    <ul class="space-y-1">
      <li>
        <a href="{{ url('/') }}" class="group flex items-center justify-end py-2.5 px-4 rounded-lg transition-all duration-300 hover:bg-white/10">
          <span class="text-white group-hover:text-orange-300 font-medium">الرئيسية</span>
          <i class="fa-solid fa-house ml-3 text-orange-300 group-hover:text-orange-400"></i>
        </a>
      </li>
      
      <li>
        <a href="{{ url('/dossiers/create') }}" class="group flex items-center justify-end py-2.5 px-4 rounded-lg transition-all duration-300 hover:bg-white/10">
          <span class="text-white group-hover:text-orange-300 font-medium">اضافة ملف</span>
          <i class="fa-solid fa-folder-plus ml-3 text-orange-300 group-hover:text-orange-400"></i>
        </a>
      </li>
      

      
      <li>
        <a href="{{ url('/dossiers') }}" class="group flex items-center justify-end py-2.5 px-4 rounded-lg transition-all duration-300 hover:bg-white/10">
          <span class="text-white group-hover:text-orange-300 font-medium">تدبير ملف</span>
          <i class="fa-solid fa-folder-open ml-3 text-orange-300 group-hover:text-orange-400"></i>
        </a>
      </li>
      
      <li>
        <a href="{{ url('/listes') }}" class="group flex items-center justify-end py-2.5 px-4 rounded-lg transition-all duration-300 hover:bg-white/10">
          <span class="text-white group-hover:text-orange-300 font-medium">تدبير قائمة</span>
          <i class="fa-solid fa-list-check ml-3 text-orange-300 group-hover:text-orange-400"></i>
        </a>
      </li>
    </ul>
    
   
  </div>
  
  <div class="absolute bottom-0 left-0 right-0 p-4 bg-blue-950 border-t border-blue-800/50">
    <div class="text-center text-xs text-gray-300">
      <p>© 2025 وزارة العدل</p>
      <p class="mt-1">جميع الحقوق محفوظة</p>
    </div>
  </div>
</aside>



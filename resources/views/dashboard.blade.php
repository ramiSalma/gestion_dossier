@extends('welcome')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <!-- Welcome Banner -->
    <div class="bg-blue-950 text-white p-6 rounded-lg mb-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold mb-2">مرحبًا بك في نظام تدبير الملفات</h1>
                <p class="text-blue-200">لوحة التحكم الرئيسية لإدارة ملفات القضايا والقوائم</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ url('/dossiers/create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300 inline-flex items-center">
                    <i class="fas fa-plus ml-2"></i>
                    إضافة ملف جديد
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Files Card -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-lg p-6 text-white shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-blue-100 text-sm">إجمالي الملفات</p>
                    <h3 class="text-3xl font-bold mt-1">{{ \App\Models\Dossier::count() }}</h3>
                </div>
                <div class="bg-blue-400/30 p-3 rounded-lg">
                    <i class="fas fa-folder text-2xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ url('/dossiers') }}" class="text-sm text-blue-100 hover:text-white flex items-center">
                    عرض التفاصيل
                    <i class="fas fa-arrow-left mr-1 text-xs"></i>
                </a>
            </div>
        </div>

        <!-- Lists Card -->
        <div class="bg-gradient-to-br from-green-500 to-green-700 rounded-lg p-6 text-white shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-green-100 text-sm">القوائم النشطة</p>
                    <h3 class="text-3xl font-bold mt-1">{{ \App\Models\Liste::count() }}</h3>
                </div>
                <div class="bg-green-400/30 p-3 rounded-lg">
                    <i class="fas fa-list-check text-2xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ url('/listes') }}" class="text-sm text-green-100 hover:text-white flex items-center">
                    عرض التفاصيل
                    <i class="fas fa-arrow-left mr-1 text-xs"></i>
                </a>
            </div>
        </div>

        <!-- Parties Card -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-700 rounded-lg p-6 text-white shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-purple-100 text-sm">الأطراف المسجلة</p>
                    <h3 class="text-3xl font-bold mt-1">{{ \App\Models\Partie::count() }}</h3>
                </div>
                <div class="bg-purple-400/30 p-3 rounded-lg">
                    <i class="fas fa-users text-2xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="#" class="text-sm text-purple-100 hover:text-white flex items-center">
                    عرض التفاصيل
                    <i class="fas fa-arrow-left mr-1 text-xs"></i>
                </a>
            </div>
        </div>

        <!-- Archived Files Card -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-700 rounded-lg p-6 text-white shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-orange-100 text-sm">الملفات المؤرشفة</p>
                    <h3 class="text-3xl font-bold mt-1">{{ \App\Models\Dossier::whereNotNull('date_archivage')->count() }}</h3>
                </div>
                <div class="bg-orange-400/30 p-3 rounded-lg">
                    <i class="fas fa-archive text-2xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ url('/dossiers?archived=1') }}" class="text-sm text-orange-100 hover:text-white flex items-center">
                    عرض التفاصيل
                    <i class="fas fa-arrow-left mr-1 text-xs"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Files and Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Files -->
        <div class="lg:col-span-2 bg-white border border-gray-200 rounded-lg shadow-md">
            <div class="border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">أحدث الملفات</h2>
                <a href="{{ url('/dossiers') }}" class="text-blue-600 hover:text-blue-800 text-sm">عرض الكل</a>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">رقم الملف</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">رقم القضية</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">السنة</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach(\App\Models\Dossier::latest()->take(5)->get() as $dossier)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $dossier->num }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $dossier->code }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $dossier->annee }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('dossiers.show', $dossier->id) }}" class="text-blue-600 hover:text-blue-900 mx-1">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('dossiers.edit', $dossier->id) }}" class="text-yellow-600 hover:text-yellow-900 mx-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-md">
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="text-xl font-bold text-gray-800">إجراءات سريعة</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <a href="{{ url('/dossiers/create') }}" class="flex items-center justify-between p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-3 rounded-lg">
                                <i class="fas fa-folder-plus text-blue-600"></i>
                            </div>
                            <span class="mr-3 font-medium text-gray-800">إضافة ملف جديد</span>
                        </div>
                        <i class="fas fa-chevron-left text-gray-400"></i>
                    </a>
                    
                    <a href="#" onclick="event.preventDefault(); openModal();" class="flex items-center justify-between p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="bg-green-100 p-3 rounded-lg">
                                <i class="fas fa-list-plus text-green-600"></i>
                            </div>
                            <span class="mr-3 font-medium text-gray-800">إنشاء قائمة جديدة</span>
                        </div>
                        <i class="fas fa-chevron-left text-gray-400"></i>
                    </a>
                    
                    <a href="{{ url('/listes') }}" class="flex items-center justify-between p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="bg-purple-100 p-3 rounded-lg">
                                <i class="fas fa-print text-purple-600"></i>
                            </div>
                            <span class="mr-3 font-medium text-gray-800">طباعة قائمة</span>
                        </div>
                        <i class="fas fa-chevron-left text-gray-400"></i>
                    </a>
                    
                    <a href="{{ url('/dossiers') }}" class="flex items-center justify-between p-4 bg-orange-50 hover:bg-orange-100 rounded-lg transition-colors duration-200">
                        <div class="flex items-center">
                            <div class="bg-orange-100 p-3 rounded-lg">
                                <i class="fas fa-search text-orange-600"></i>
                            </div>
                            <span class="mr-3 font-medium text-gray-800">البحث عن ملف</span>
                        </div>
                        <i class="fas fa-chevron-left text-gray-400"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
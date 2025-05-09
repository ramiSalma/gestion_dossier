@extends('welcome')

@section('content')
<div class="container mx-auto pt-16 pb-12 px-4" dir="rtl">
    <div class="bg-white rounded-lg shadow-lg border border-gray-100 overflow-hidden">
        <!-- Header Section with background -->
        <div class="bg-blue-950 text-white p-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl md:text-3xl font-bold">تفاصيل البطاقة #{{ $liste->id }}</h1>
                <span class="bg-blue-800 text-white text-sm py-1 px-3 rounded-full">
                    {{ $dossiers->total() }} ملف
                </span>
            </div>
            <p class="mt-2 text-blue-100">{{ $liste->title ?? 'بطاقة بدون عنوان' }}</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6">
            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-950 bg-opacity-10 text-blue-950">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="mr-4">
                        <p class="text-gray-500 text-sm">إجمالي الملفات</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="mr-4">
                        <p class="text-gray-500 text-sm">ملفات مؤرشفة</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $stats['archived'] }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="mr-4">
                        <p class="text-gray-500 text-sm">ملفات غير مؤرشفة</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $stats['not_archived'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="px-6 pb-4 flex flex-wrap gap-3">
            @if(!$liste->date_envoi)
                <a href="{{ route('listes.addFile', $liste->id) }}" class="bg-blue-950 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    إضافة ملفات
                </a>
            @endif
            
            @if(!$liste->date_envoi)
                <form action="{{ route('listes.send', $liste->id) }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" onclick="return confirm('هل أنت متأكد من إرسال هذه البطاقة؟ لن تتمكن من تعديلها بعد الإرسال.')" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        إرسال البطاقة
                    </button>
                </form>
            @else
                <span class="bg-gray-200 text-gray-700 font-bold py-2 px-4 rounded-lg inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    تم إرسال البطاقة بتاريخ {{ \Carbon\Carbon::parse($liste->date_envoi)->format('d/m/Y') }}
                </span>
            @endif
            
            <a href="{{ route('listes.print', $liste->id) }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                طباعة البطاقة
            </a>
            
            <a href="{{ route('listes.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                العودة للقائمة
            </a>
        </div>

        <!-- Search & Filter Row -->
        <div class="mb-6 px-6 flex flex-col md:flex-row gap-4">
            <form action="{{ route('listes.show', $liste->id) }}" method="GET" class="w-full">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="relative flex-grow">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="البحث عن ملف..." class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-3 top-2.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    
                    <div class="flex gap-2">
                        <div>
                            <select name="sort" class="px-4 py-2 border border-gray-300 rounded-lg" onchange="this.form.submit()">
                                <option value="id" {{ $sort == 'id' ? 'selected' : '' }}>الافتراضي</option>
                                <option value="num_asc" {{ $sort == 'num_asc' ? 'selected' : '' }}>رقم الملف (تصاعدي)</option>
                                <option value="num_desc" {{ $sort == 'num_desc' ? 'selected' : '' }}>رقم الملف (تنازلي)</option>
                                <option value="code_asc" {{ $sort == 'code_asc' ? 'selected' : '' }}>رمز القضية (تصاعدي)</option>
                                <option value="code_desc" {{ $sort == 'code_desc' ? 'selected' : '' }}>رمز القضية (تنازلي)</option>
                                <option value="annee_asc" {{ $sort == 'annee_asc' ? 'selected' : '' }}>السنة (تصاعدي)</option>
                                <option value="annee_desc" {{ $sort == 'annee_desc' ? 'selected' : '' }}>السنة (تنازلي)</option>
                                <option value="date_asc" {{ $sort == 'date_asc' ? 'selected' : '' }}>تاريخ الأرشفة (تصاعدي)</option>
                                <option value="date_desc" {{ $sort == 'date_desc' ? 'selected' : '' }}>تاريخ الأرشفة (تنازلي)</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="px-4 py-2 bg-blue-950 text-white rounded-lg hover:bg-blue-800 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            بحث
                        </button>
                    </div>
                </div>
            </form>
        </div>

            <!-- Table with hover effects -->
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                رقم الملف
                                <a href="{{ route('listes.show', ['liste' => $liste->id, 'sort' => $sort == 'num_asc' ? 'num_desc' : 'num_asc'] + request()->except(['sort', 'page'])) }}" class="text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-sort"></i>
                                </a>
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                رقم القضية
                                <a href="{{ route('listes.show', ['liste' => $liste->id, 'sort' => $sort == 'code_asc' ? 'code_desc' : 'code_asc'] + request()->except(['sort', 'page'])) }}" class="text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-sort"></i>
                                </a>
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                السنة
                                <a href="{{ route('listes.show', ['liste' => $liste->id, 'sort' => $sort == 'annee_asc' ? 'annee_desc' : 'annee_asc'] + request()->except(['sort', 'page'])) }}" class="text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-sort"></i>
                                </a>
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                تاريخ الأرشفة
                                <a href="{{ route('listes.show', ['liste' => $liste->id, 'sort' => $sort == 'date_asc' ? 'date_desc' : 'date_asc'] + request()->except(['sort', 'page'])) }}" class="text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-sort"></i>
                                </a>
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($dossiers as $dossier)
                            <tr class="hover:bg-blue-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $dossier->num }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $dossier->code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $dossier->annee }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    @if($dossier->date_archivage)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ \Carbon\Carbon::parse($dossier->date_archivage)->format('d/m/Y') }}
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            غير محدد
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-3 rtl:space-x-reverse">
                                        <a href="{{ route('dossiers.show', $dossier->id) }}" class="text-blue-600 hover:text-blue-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        
                                        @if(!$liste->date_envoi)
                                            <form action="{{ route('listes.dossiers.remove', ['liste' => $liste->id, 'dossier' => $dossier->id]) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('هل أنت متأكد من إزالة هذا الملف من القائمة؟')" class="text-red-600 hover:text-red-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        
                        @if($dossiers->isEmpty())
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                    لا توجد ملفات في هذه القائمة.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Add JavaScript for toggle filters -->
            <script>
                function toggleFilters() {
                    const filtersDiv = document.getElementById('advancedFilters');
                    if (filtersDiv.style.display === 'none') {
                        filtersDiv.style.display = 'grid';
                    } else {
                        filtersDiv.style.display = 'none';
                    }
                }
            </script>

            <!-- Pagination with better styling -->
            <div class="mt-6">
                {{ $dossiers->links() }}
            </div>
        </div>

        <!-- Summary Footer -->
        <div class="bg-gray-50 border-t border-gray-200 px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    عدد الملفات: <span class="font-semibold text-blue-600">{{ $dossiers->total() }}</span>
                </div>
                <div class="text-sm text-gray-500">
                    تاريخ الإنشاء: <span class="font-semibold">{{ $liste->date_creation ? $liste->date_creation->format('d/m/Y') : 'غير محدد' }}</span>
                </div>
                <div class="text-sm text-gray-500">
                    @if($liste->date_envoi)
                        <span class="text-green-600 font-semibold">تم الإرسال: {{ $liste->date_envoi->format('d/m/Y') }}</span>
                    @else
                        <span class="text-red-600 font-semibold">لم يتم الإرسال بعد</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

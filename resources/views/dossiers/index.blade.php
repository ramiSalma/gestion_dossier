@extends('welcome')

@section('content')
<div class="container mt-5 p-10 bg-white rounded-lg shadow rtl text-right" dir="rtl">

    <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">قائمة الملفات</h1>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <!-- Search bar and Add Button -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <form action="{{ route('dossiers.index') }}" method="GET" class="w-full md:w-auto">
            <div class="flex flex-col md:flex-row gap-2">
                <input type="text" name="num" value="{{ request('num') }}" placeholder="رقم الملف" 
                    class="border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <input type="text" name="code" value="{{ request('code') }}" placeholder="رمز القضية" 
                    class="border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <input type="text" name="annee" value="{{ request('annee') }}" placeholder="السنة" 
                    class="border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <button type="submit" class="bg-blue-950 text-white rounded-lg px-4 py-2 hover:bg-blue-800 transition">
                    <i class="fas fa-search ml-1"></i> بحث
                </button>
            </div>
        </form>
        
        <a href="{{ route('dossiers.create') }}" class="bg-blue-950 text-white rounded-lg px-6 py-2 hover:bg-blue-800 transition flex items-center">
            <i class="fas fa-folder-plus ml-2"></i> اضافة ملف
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <table class="w-full divide-y divide-gray-200 rounded-lg">
            <thead class="bg-blue-950 text-white">
                <tr>
                    <!-- Num -->
                    <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">
                        الرقم
                        <a href="{{ route('dossiers.index', array_merge(request()->all(), ['sort' => request('sort') == 'num_asc' ? 'num_desc' : 'num_asc'])) }}" class="text-white hover:text-blue-200">
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>

                    <!-- Code -->
                    <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">
                        الرمز
                        <a href="{{ route('dossiers.index', array_merge(request()->all(), ['sort' => request('sort') == 'code_asc' ? 'code_desc' : 'code_asc'])) }}" class="text-white hover:text-blue-200">
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>

                    <!-- Annee -->
                    <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">
                        السنة
                        <a href="{{ route('dossiers.index', array_merge(request()->all(), ['sort' => request('sort') == 'annee_asc' ? 'annee_desc' : 'annee_asc'])) }}" class="text-white hover:text-blue-200">
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>

                    <!-- Date Archivage -->
                    <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">
                        تاريخ الأرشفة
                        <a href="{{ route('dossiers.index', array_merge(request()->all(), ['sort' => request('sort') == 'date_asc' ? 'date_desc' : 'date_asc'])) }}" class="text-white hover:text-blue-200">
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>

                    <!-- Actions -->
                    <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">
                        الإجراءات
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($dossiers as $dossier)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="px-6 py-4 text-center text-sm text-gray-900">{{ $dossier->num }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-900">{{ $dossier->code }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-900">{{ $dossier->annee }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-900">
                            {{ $dossier->date_archivage ? \Carbon\Carbon::parse($dossier->date_archivage)->format('d/m/Y') : 'غير متوفر' }}
                        </td>
                        <td class="px-6 py-4 text-center text-sm">
                            <div class="flex justify-center space-x-2 space-x-reverse">
                                <a href="{{ route('dossiers.show', ['dossier' => $dossier->id] + request()->query()) }}" 
                                   class="text-blue-600 hover:text-blue-800 transition" title="عرض">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <a href="{{ route('dossiers.edit', ['dossier' => $dossier->id] + request()->query()) }}" 
                                   class="text-yellow-600 hover:text-yellow-800 transition mx-3" title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form action="{{ route('dossiers.destroy', $dossier->id) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا الملف؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition" title="حذف">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-folder-open text-4xl text-gray-400 mb-3"></i>
                                <p>لا توجد ملفات حال<|im_start|>.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="px-6 py-4">
            {{ $dossiers->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection

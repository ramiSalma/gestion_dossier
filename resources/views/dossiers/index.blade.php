@extends('welcome')

@section('content')
<div class="container mt-30 p-10 bg-white rounded-lg shadow rtl text-right" dir="rtl">

    <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">قائمة الملفات</h1>

    <!-- Search bar and Add Button -->
    <div class="flex justify-between items-center mb-6">
        <form action="{{ route('dossiers.index') }}" method="GET" class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
            <input type="text" name="num" value="{{ request('num') }}" placeholder="رقم الملف" class="border rounded-lg p-2">
            <input type="text" name="code" value="{{ request('code') }}" placeholder="رمز القضية" class="border rounded-lg p-2">
            <input type="text" name="annee" value="{{ request('annee') }}" placeholder="السنة" class="border rounded-lg p-2">
            <button type="submit" class="bg-blue-950 text-white rounded-lg px-4 py-2 hover:bg-blue-800">بحث</button>
        </form>
        

        <a href="{{ route('dossiers.create') }}" class="btn bg-blue-950 rounded-2xl text-white p-4">
            اضافة ملف
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
                        <a href="{{ route('dossiers.index', array_merge(request()->all(), ['sort' => request('sort') == 'num_asc' ? 'num_desc' : 'num_asc'])) }}">
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>

                    <!-- Code -->
                    <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">
                        الرمز
                        <a href="{{ route('dossiers.index', array_merge(request()->all(), ['sort' => request('sort') == 'code_asc' ? 'code_desc' : 'code_asc'])) }}">
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>

                    <!-- Annee -->
                    <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">
                        السنة
                        <a href="{{ route('dossiers.index', array_merge(request()->all(), ['sort' => request('sort') == 'annee_asc' ? 'annee_desc' : 'annee_asc'])) }}">
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>

                    <!-- Date Archivage -->
                    <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">
                        تاريخ الأرشفة
                        <a href="{{ route('dossiers.index', array_merge(request()->all(), ['sort' => request('sort') == 'date_asc' ? 'date_desc' : 'date_asc'])) }}">
                            <i class="fas fa-sort ml-1"></i>
                        </a>
                    </th>

                    <!-- Actions -->
                    <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">الإجراءات</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($dossiers as $dossier)
                    <tr class="hover:bg-gray-300 transition duration-200">
                        <td class="px-6 py-4 text-center text-sm text-gray-900">{{ $dossier->num }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-900">{{ $dossier->code }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-900">{{ $dossier->annee }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-900">
                            {{ $dossier->date_archivage ? \Carbon\Carbon::parse($dossier->date_archivage)->format('d/m/Y') : 'غير متوفر' }}
                        </td>
                        <td class="px-6 py-4 text-center text-sm">
                            <a href="{{ route('dossiers.show', ['dossier' => $dossier->id] + request()->query()) }}" class="text-blue-950 mx-2 hover:text-blue-900">
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            <a href="{{ route('dossiers.edit', ['dossier' => $dossier->id] + request()->query()) }}" class="text-blue-950 mx-2 hover:text-orange-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <form action="{{ route('dossiers.destroy', $dossier->id) }}" method="POST" class="inline-block mx-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا الملف؟')" class="text-red-700 hover:text-red-900"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500">لا توجد ملفات حالياً.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="px-6 py-4 text-center">
            {{--  {{ $dossiers->withQueryString()->links() }}  --}}
            {{ $dossiers->appends(request()->query())->links() }}

        </div>
    </div>
</div>
@endsection

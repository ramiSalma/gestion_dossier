@extends('welcome')

@section('content')
<div class="container mt-[100px] mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg text-right" dir="rtl">
    <h1 class="text-3xl font-bold text-center text-blue-950 mb-6">إضافة ملف إلى البطاقة</h1>

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('listes.show', $liste->id) }}" class="bg-blue-950 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-2xl">
            العودة إلى تفاصيل البطاقة
        </a>
    </div>

    <!-- Search and Filter Dossiers -->
    <form action="{{ route('listes.addFile', $liste->id) }}" method="GET">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div>
                <label for="num" class="block text-right text-lg font-medium text-gray-600">رقم الملف</label>
                <input type="text" name="num" id="num" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" value="{{ request('num') }}" placeholder="رقم الملف">
            </div>

            <div>
                <label for="code" class="block text-right text-lg font-medium text-gray-600">رقم القضية</label>
                <input type="text" name="code" id="code" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" value="{{ request('code') }}" placeholder="رقم القضية">
            </div>

            <div>
                <label for="annee" class="block text-right text-lg font-medium text-gray-600">السنة</label>
                <input type="text" name="annee" id="annee" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500" value="{{ request('annee') }}" placeholder="السنة">
            </div>
        </div>

        <div class="text-center mb-6">
            <button type="submit" class="bg-blue-950 text-white font-bold py-2 px-6 rounded-2xl hover:bg-blue-800">
                بحث
            </button>
        </div>
    </form>

    <!-- Display the Dossiers to Add -->
    <form action="{{ route('listes.storeFile', $liste->id) }}" method="POST">
        @csrf
        <div class="overflow-x-auto mb-6">
            <table class="min-w-full table-auto border-collapse border border-gray-200 rounded-lg">
                <thead class="bg-blue-950 text-white">
                    <tr>
                        <th class="px-4 py-2 text-right">رقم الملف</th>
                        <th class="px-4 py-2 text-right">رقم القضية</th>
                        <th class="px-4 py-2 text-right">السنة</th>
                        <th class="px-4 py-2 text-right">إضافة إلى البطاقة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dossiers as $dossier)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border border-gray-200">{{ $dossier->num }}</td>
                            <td class="px-4 py-2 border border-gray-200">{{ $dossier->code }}</td>
                            <td class="px-4 py-2 border border-gray-200">{{ $dossier->annee }}</td>
                            <td class="px-4 py-2 border border-gray-200">
                                <input type="checkbox" name="dossiers[]" value="{{ $dossier->id }}" class="w-5 h-5 text-blue-950 focus:ring-blue-500">
                            </td>
                        </tr>
                    @endforeach
                    
                    @if($dossiers->isEmpty())
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500 border border-gray-200">
                                لا توجد ملفات متاحة للإضافة.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Add File Button -->
        <div class="text-center">
            <button type="submit" class="bg-green-600 text-white font-bold py-2 px-6 rounded-2xl hover:bg-green-700" {{ $dossiers->isEmpty() ? 'disabled' : '' }}>
                إضافة الملفات المحددة
            </button>
        </div>
    </form>
</div>
@endsection

@extends('welcome')

@section('content')
<div class="container mt-[100px] mx-auto mt-10 p-6 bg-white rounded-lg shadow text-right" dir="rtl">
    <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">إضافة ملف إلى البطاقة</h1>

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('listes.show', $liste->id) }}" class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-6 rounded-2xl">
            العودة إلى تفاصيل البطاقة
        </a>
    </div>

    <!-- Search and Filter Dossiers -->
    <form action="{{ route('listes.addFile', $liste->id) }}" method="GET">
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div>
                <label for="num" class="block text-right text-lg font-medium text-gray-600">رقم الملف</label>
                <input type="text" name="num" id="num" class="w-full p-2 border rounded" value="{{ request('num') }}" placeholder="رقم الملف">
            </div>

            <div>
                <label for="code" class="block text-right text-lg font-medium text-gray-600">رقم القضية</label>
                <input type="text" name="code" id="code" class="w-full p-2 border rounded" value="{{ request('code') }}" placeholder="رقم القضية">
            </div>

            <div>
                <label for="annee" class="block text-right text-lg font-medium text-gray-600">السنة</label>
                <input type="text" name="annee" id="annee" class="w-full p-2 border rounded" value="{{ request('annee') }}" placeholder="السنة">
            </div>
        </div>

        <div class="text-center mb-6">
            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-6 rounded-2xl hover:bg-blue-800">
                بحث
            </button>
        </div>
    </form>

    <!-- Display the Dossiers to Add -->
    <form action="{{ route('listes.storeFile', $liste->id) }}" method="POST">
        @csrf
        <div class="overflow-x-auto mb-6">
            <table class="min-w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-right">رقم الملف</th>
                        <th class="px-4 py-2 text-right">رقم القضية</th>
                        <th class="px-4 py-2 text-right">السنة</th>
                        <th class="px-4 py-2 text-right">إضافة إلى البطاقة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dossiers as $dossier)
                        <tr>
                            <td class="px-4 py-2">{{ $dossier->num }}</td>
                            <td class="px-4 py-2">{{ $dossier->code }}</td>
                            <td class="px-4 py-2">{{ $dossier->annee }}</td>
                            <td class="px-4 py-2">
                                <input type="checkbox" name="dossiers[]" value="{{ $dossier->id }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Add File Button -->
        <div class="text-center">
            <button type="submit" class="bg-green-600 text-white font-bold py-2 px-6 rounded-2xl hover:bg-green-800">
                إضافة الملف
            </button>
        </div>
    </form>
</div>
@endsection

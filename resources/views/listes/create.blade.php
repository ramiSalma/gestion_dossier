@extends('welcome')

@section('content')
<div class="container mt-[100px] mx-auto mt-10 p-6 bg-white rounded-lg shadow text-right" dir="rtl">
    <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">إضافة بطاقة جديدة</h1>

    <!-- Form to create a new Liste -->
    <form action="{{ route('listes.store') }}" method="POST">
        @csrf

        <div class="mb-6">
            <label for="date_creation" class="block text-right text-lg font-medium text-gray-600">تاريخ الإنشاء</label>
            <input type="date" name="date_creation" id="date_creation" class="w-[200px] p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ now()->toDateString() }}" >

            <button type="submit" class="bg-blue-700 text-white font-bold py-2 px-6 rounded-2xl hover:bg-blue-900">
                إضافة بطاقة
            </button>
        </div>
    </form>
</div>
@endsection

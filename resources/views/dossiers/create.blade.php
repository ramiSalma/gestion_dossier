@extends('welcome')

@section('content')
<div dir="rtl" class="container mt-30 p-10 bg-white rounded-lg shadow">

    <h1 class="text-3xl font-bold text-center text-blue-950 mb-6">إضافة ملف جديد</h1>
    @if($errors->has('duplicate'))
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4 text-center font-semibold">
        {{ $errors->first('duplicate') }}
    </div>
    @endif
    <form action="{{ route('dossiers.store') }}" method="POST">
        @csrf

        <div class="mb-4 flex ">
            <div class="ml-3">
                <label for="num" class="block mb-1 text-sm font-medium text-gray-700">رقم الملف</label>
                <input type="text" name="num" id="num" class="w-[200px] p-2 border rounded" value="{{ old('num') }}" required>
            </div>
            <div class="ml-3">
                <label for="code" class="block mb-1 text-sm font-medium text-gray-700">رقم القضية</label>
                <input type="text" name="code" id="code" class="w-[200px] p-2 border rounded" value="{{ old('code') }}" required>
            </div>
            <div class="ml-3">
                <label for="annee" class="block mb-1 text-sm font-medium text-gray-700">السنة</label>
                <input type="text" name="annee" id="annee" class="w-[200px] p-2 border rounded" value="{{ old('annee') }}" required>
            </div>
        </div>

        <!-- Parties Section -->
        <div id="parties" class="mb-4">
            <h2 class="text-lg font-medium text-gray-700">الأطراف</h2>
            <div id="party_fields">
                <div class="party">
                    <input type="text" name="parties[0][full_name]" class="w-[200px] p-2 border rounded mb-2" placeholder="الاسم الكامل للطرف" required>
                    <select name="parties[0][type]" class="w-[200px] p-2 border rounded mb-2" required>
                        <option value="متهم" {{ old('parties.0.type') == 'متهم' ? 'selected' : '' }}>متهم</option>
                        <option value="ضحية" {{ old('parties.0.type') == 'ضحية' ? 'selected' : '' }}>ضحية</option>
                    </select>
                </div>
            </div>
            <button type="button" id="add_party" class="bg-blue-950 text-white p-2 rounded mt-2">إضافة طرف</button>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-blue-950 text-white px-8 py-3 rounded">
                حفظ الملف
            </button>
            <a href="{{url('/dossiers')}}" class="bg-blue-950 text-white px-8 py-3 rounded">
                الغاء
            </a>
        </div>
    </form>

</div>

<script>
    document.getElementById('add_party').addEventListener('click', function() {
        let partyCount = document.querySelectorAll('.party').length;
        let newPartyHTML = `
            <div class="party">
                <input type="text" name="parties[${partyCount}][full_name]" class="w-[200px] p-2 border rounded mb-2" placeholder="الاسم الكامل للطرف" required>
                <select name="parties[${partyCount}][type]" class="w-[200px] p-2 border rounded mb-2" required>
                    <option value="متهم">متهم</option>
                    <option value="ضحية">ضحية</option>
                </select>
            </div>
        `;
        document.getElementById('party_fields').insertAdjacentHTML('beforeend', newPartyHTML);
    });
</script>
@endsection

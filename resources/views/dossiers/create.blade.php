@extends('welcome')

@section('content')
<div dir="rtl" class="container mt-5 p-10 bg-white rounded-lg shadow">

    <h1 class="text-3xl font-bold text-center text-blue-950 mb-6">إضافة ملف جديد</h1>
    @if($errors->has('duplicate'))
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4 text-center font-semibold">
        {{ $errors->first('duplicate') }}
    </div>
    @endif
    <form action="{{ route('dossiers.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <label for="num" class="block text-gray-700 font-medium mb-2">رقم الملف</label>
                <input type="number" id="num" name="num" value="{{ old('num') }}" required
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('num')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="code" class="block text-gray-700 font-medium mb-2">رمز القضية</label>
                <input type="number" id="code" name="code" value="{{ old('code') }}" required
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('code')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="annee" class="block text-gray-700 font-medium mb-2">السنة</label>
                <input type="text" id="annee" name="annee" value="{{ old('annee') }}" required maxlength="4"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('annee')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Parties Section -->
        <div id="parties" class="mb-4">
            <h2 class="text-lg font-medium text-gray-700 mb-3">الأطراف</h2>
            <div id="party_fields" class="space-y-3">
                <div class="party bg-gray-50 p-4 rounded-lg">
                    <div class="flex flex-wrap gap-4">
                        <div class="flex-1">
                            <label class="block text-gray-700 text-sm font-medium mb-1">الاسم الكامل</label>
                            <input type="text" name="parties[0][full_name]" class="w-full p-2 border rounded" placeholder="الاسم الكامل للطرف" required>
                        </div>
                        <div class="w-40">
                            <label class="block text-gray-700 text-sm font-medium mb-1">النوع</label>
                            <select name="parties[0][type]" class="w-full p-2 border rounded" required>
                                <option value="متهم" {{ old('parties.0.type') == 'متهم' ? 'selected' : '' }}>متهم</option>
                                <option value="ضحية" {{ old('parties.0.type') == 'ضحية' ? 'selected' : '' }}>ضحية</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add_party" class="mt-3 bg-blue-950 text-white py-2 px-4 rounded hover:bg-blue-800 transition">
                <i class="fas fa-plus ml-1"></i> إضافة طرف
            </button>
        </div>

        <div class="text-center mt-8">
            <button type="submit" class="bg-blue-950 text-white px-8 py-3 rounded hover:bg-blue-800 transition">
                <i class="fas fa-save ml-1"></i> حفظ الملف
            </button>
            <a href="{{url('/dossiers')}}" class="mr-2 bg-gray-500 text-white px-8 py-3 rounded hover:bg-gray-600 transition">
                <i class="fas fa-times ml-1"></i> الغاء
            </a>
        </div>
    </form>

</div>

<script>
    document.getElementById('add_party').addEventListener('click', function() {
        let partyCount = document.querySelectorAll('.party').length;
        let newPartyHTML = `
            <div class="party bg-gray-50 p-4 rounded-lg">
                <div class="flex flex-wrap gap-4">
                    <div class="flex-1">
                        <label class="block text-gray-700 text-sm font-medium mb-1">الاسم الكامل</label>
                        <input type="text" name="parties[${partyCount}][full_name]" class="w-full p-2 border rounded" placeholder="الاسم الكامل للطرف" required>
                    </div>
                    <div class="w-40">
                        <label class="block text-gray-700 text-sm font-medium mb-1">النوع</label>
                        <select name="parties[${partyCount}][type]" class="w-full p-2 border rounded" required>
                            <option value="متهم">متهم</option>
                            <option value="ضحية">ضحية</option>
                        </select>
                    </div>
                    <button type="button" class="remove-party text-red-500 hover:text-red-700" onclick="this.closest('.party').remove();">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
        document.getElementById('party_fields').insertAdjacentHTML('beforeend', newPartyHTML);
    });
</script>
@endsection

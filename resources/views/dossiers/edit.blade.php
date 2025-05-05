@extends('welcome')

@section('content')
<div dir="rtl" class="min-h-screen mt-[60px] text-white py-10 px-6 flex items-center justify-center">
    <div class="bg-white text-gray-800 w-full max-w-6xl rounded-lg shadow-lg p-10">
        <h2 class="text-3xl font-bold text-center text-blue-950 mb-10">تعديل معلومات الملف رقم {{ $dossier->num }}</h2>

        <form action="{{ route('dossiers.update', $dossier->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- رقم الملف -->
                <div>
                    <label for="num" class="block mb-1 text-sm font-medium text-blue-950">رقم الملف</label>
                    <input type="text" name="num" id="num" class="w-full p-1 border rounded focus:outline-none focus:ring-2 focus:ring-yellow-500" value="{{ $dossier->num }}" required>
                </div>

                <!-- رقم القضية -->
                <div>
                    <label for="code" class="block mb-1 text-sm font-medium text-blue-950">رقم القضية</label>
                    <input type="text" name="code" id="code" class="w-full p-1 border rounded focus:outline-none focus:ring-2 focus:ring-yellow-500" value="{{ $dossier->code }}" required>
                </div>

                <!-- السنة -->
                <div>
                    <label for="annee" class="block mb-1 text-sm font-medium text-blue-950">السنة</label>
                    <input type="text" name="annee" id="annee" class="w-full p-1 border rounded focus:outline-none focus:ring-2 focus:ring-yellow-500" value="{{ $dossier->annee }}" required>
                </div>

                {{--  <!-- تاريخ الأرشفة -->
                <div>
                    <label for="date_archivage" class="block mb-1 text-sm font-medium text-blue-950">تاريخ الأرشفة</label>
                    <input type="date" name="date_archivage" id="date_archivage" class="w-full p-1 border rounded focus:outline-none focus:ring-2 focus:ring-yellow-500" value="{{ $dossier->date_archivage ? \Carbon\Carbon::parse($dossier->date_archivage)->format('Y-m-d') : '' }}">
                </div>

                <!-- القائمة -->
                <div>
                    <label for="liste_id" class="block mb-1 text-sm font-medium text-blue-950">القائمة (رابط الملف)</label>
                    <select name="liste_id" id="liste_id" class="w-full p-1 border rounded focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                        <option value="">-- اختر القائمة --</option>
                        @foreach($listes as $liste)
                            <option value="{{ $liste->id }}" {{ $dossier->liste_id == $liste->id ? 'selected' : '' }}>
                                {{ $liste->date_creation }}
                            </option>
                        @endforeach
                    </select>
                </div>  --}}
            </div>

            <!-- أطراف الملف -->
            <div class="mt-10">
                <h3 class="text-xl font-bold text-blue-950 mb-4">أطراف الملف</h3>
                <div class="space-y-4">
                    @foreach($dossier->parties as $index => $party)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-100 p-4 rounded">
                            <input type="hidden" name="parties[{{ $index }}][id]" value="{{ $party->id }}">
                            <div>
                                <label class="block mb-1 text-sm font-medium text-blue-950">الإسم الكامل</label>
                                <input type="text" name="parties[{{ $index }}][full_name]" class="w-full p-1 border rounded focus:outline-none focus:ring-2 focus:ring-yellow-500" value="{{ $party->full_name }}" required>
                            </div>
                            <div>
                                <label class="block mb-1 text-sm font-medium text-blue-950">الصفة</label>
                                <select name="parties[{{ $index }}][type]" class="w-full p-1 border rounded focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                                    <option value="متهم" {{ $party->type === 'متهم' ? 'selected' : '' }}>متهم</option>
                                    <option value="ضحية" {{ $party->type === 'ضحية' ? 'selected' : '' }}>ضحية</option>
                                </select>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="text-center pt-10">
                <button type="submit" class="bg-blue-950 text-white px-8 py-3 rounded font-bold hover:bg-yellow-600 transition">
                    تحديث الملف
                </button>
                <a href="{{url("/dossiers")}}" class="bg-blue-950 text-white px-8 py-3 rounded font-bold hover:bg-yellow-600 transition">
                   الغاء
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

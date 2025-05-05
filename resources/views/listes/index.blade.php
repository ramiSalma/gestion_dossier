@extends('welcome')

@section('content')
<div class="container  mx-auto mt-30 p-6 bg-white rounded-lg shadow text-right" dir="rtl">
    <h1 class="text-3xl font-bold text-center text-blue-950 mb-6">قائمة الملفات</h1>

    <!-- Add new liste button -->
    <div class="flex justify-end mb-6">
        <a href="{{ route('listes.create') }}" class="bg-blue-950 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-2xl">
            إضافة بطاقة جديدة
        </a>
    </div>

    <!-- Display the list cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($listes as $liste)
            <div class="bg-gray-100 shadow-lg rounded-xl p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-bold text-blue-900 mb-2">{{ $liste->title }}</h2>
                    <p class="text-gray-700 mb-4">{{ $liste->description }}</p>
                    <p class="text-sm text-gray-600 mb-4">رقم: {{ $liste->id }} - تاريخ الإضافة: {{ $liste->date_creation->format('d/m/Y') }}</p>
                    <p class="text-sm text-gray-600 mb-4">عدد الملفات: {{ $liste->dossier()->count() }}</p>
                    
                    <!-- Display date_envoi if it exists -->
                    @if ($liste->date_envoi)
                        <p class="text-sm text-green-600 mb-4">تاريخ الإرسال: {{ $liste->date_envoi->format('d/m/Y') }}</p>
                    @else
                        <p class="text-sm text-red-600 mb-4">تاريخ الإرسال: غير مرسل بعد</p>
                    @endif


                </div>

                <div class="flex gap-4 mt-4">
                    <!-- Add file button -->
                    
                    @if (!$liste->date_envoi)
                        <a href="{{ route('listes.addFile', $liste->id) }}" class="bg-blue-950 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded w-full">
                            إضافة ملف
                        </a>
                    @else
                        <button class="bg-gray-400 text-white font-bold py-2 px-4 rounded w-full cursor-not-allowed" disabled>
                            إضافة ملف
                        </button>
                    @endif
                    

                    <!-- See files button -->
                    <a href="{{ route('listes.show', $liste->id) }}" class="bg-blue-950 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded w-full text-center flex items-center justify-center">
                        عرض الملفات
                    </a>
                </div>

                <!-- Send button (if there are dossiers to be sent) -->
                @if ($liste->dossier()->exists())
                    <form action="{{ route('listes.send', $liste->id) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit"
                            class="font-bold py-2 px-6 rounded w-full 
                                {{ $liste->date_envoi ? 'bg-gray-400 text-white cursor-not-allowed' : 'bg-green-950 hover:bg-green-800 text-white' }}"
                            @if ($liste->date_envoi) disabled @endif>
                            إرسال القائمة
                        </button>
                    </form>
                @endif

            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-10 text-center">
        {{ $listes->links() }}
    </div>
</div>
@endsection

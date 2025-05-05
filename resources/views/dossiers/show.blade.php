@extends('welcome')

@section('content')
<div class="flex mt-[200px] justify-center items-center mt-20">
    <div class="w-full max-w-md p-8 bg-blue-950 text-white rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-2xl" dir="rtl">
        <h1 class="text-2xl font-bold text-center text-blue-300 mb-6">تفاصيل الملف رقم {{ $dossier->num }}</h1>

        <div class="mb-4">
            <strong class="text-blue-200">رقم الملف: </strong>{{ $dossier->num }}
        </div>
        <div class="mb-4">
            <strong class="text-blue-200">رقم القضية: </strong>{{ $dossier->code }}
        </div>
        <div class="mb-4">
            <strong class="text-blue-200">السنة: </strong>{{ $dossier->annee }}
        </div>
        <div class="mb-4">
            <strong class="text-blue-200">تاريخ الأرشفة: </strong>
            {{ $dossier->date_archivage ? \Carbon\Carbon::parse($dossier->date_archivage)->format('d/m/Y') : 'غير متوفر' }}
        </div>
        <div class="mb-6">
            <strong class="text-blue-200">القائمة المرتبطة: </strong>
            {{ $dossier->liste ? $dossier->liste->date_creation : 'غير مرتبط بعد' }}
        </div>
        
        <div class="mb-6">
            <strong class="text-blue-200">الأطراف:</strong>
            @if($dossier->parties->isEmpty())
                <p class="text-gray-300 mt-2">لا توجد أطراف مرتبطة بهذا الملف.</p>
            @else
                <ul class="list-disc pl-5 mt-2 text-white">
                    @foreach($dossier->parties as $partie)
                        <li>
                            <span class="font-semibold text-blue-100">{{ $partie->full_name }}</span>
                            <span class="text-sm text-gray-300">({{ $partie->type }})</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        
        <div class="text-center">
            <a href="{{ route('dossiers.index', request()->query()) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-300">
                العودة إلى القائمة
            </a>
            
        </div>
    </div>
</div>
@endsection

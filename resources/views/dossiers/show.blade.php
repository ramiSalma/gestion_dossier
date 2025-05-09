@extends('welcome')

@section('content')
<div class="container mx-auto px-4 py-8 " dir="rtl">
    <div class="max-w-4xl mx-auto">
        <!-- Card Header -->
        <div class="bg-blue-950 rounded-t-lg p-6 text-center">
            <h1 class="text-3xl font-bold text-white">تفاصيل الملف</h1>
            <div class="mt-2 inline-block bg-blue-800 text-white px-4 py-1 rounded-full text-sm">
                رقم {{ $dossier->num }}
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="bg-white rounded-b-lg shadow-lg p-8">
            <!-- Main Info -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-semibold text-gray-500 mb-1">رقم الملف</h3>
                    <p class="text-xl font-bold text-blue-950">{{ $dossier->num }}</p>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-semibold text-gray-500 mb-1">رقم القضية</h3>
                    <p class="text-xl font-bold text-blue-950">{{ $dossier->code }}</p>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-semibold text-gray-500 mb-1">السنة</h3>
                    <p class="text-xl font-bold text-blue-950">{{ $dossier->annee }}</p>
                </div>
            </div>
            
            <!-- Additional Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-semibold text-gray-500 mb-1">تاريخ الأرشفة</h3>
                    <p class="text-lg font-medium text-blue-950">
                        {{ $dossier->date_archivage ? \Carbon\Carbon::parse($dossier->date_archivage)->format('d/m/Y') : 'غير متوفر' }}
                    </p>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-semibold text-gray-500 mb-1">القائمة المرتبطة</h3>
                    <p class="text-lg font-medium text-blue-950">
                        {{ $dossier->liste ? $dossier->liste->date_creation : 'غير مرتبط بعد' }}
                    </p>
                </div>
            </div>
            
            <!-- Parties Section -->
            <div class="mb-8">
                <h2 class="text-xl font-bold text-blue-950 mb-4 flex items-center">
                    <i class="fas fa-users ml-2 text-blue-600"></i>
                    الأطراف
                </h2>
                
                @if($dossier->parties->isEmpty())
                    <div class="bg-blue-50 text-blue-800 p-4 rounded-lg text-center">
                        <i class="fas fa-info-circle ml-2"></i>
                        لا توجد أطراف مرتبطة بهذا الملف
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($dossier->parties as $partie)
                            <div class="bg-gray-50 p-4 rounded-lg border-r-4 {{ $partie->type == 'متهم' ? 'border-red-500' : 'border-green-500' }}">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-medium text-blue-950">{{ $partie->full_name }}</span>
                                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $partie->type == 'متهم' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $partie->type }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <a href="{{ route('dossiers.edit', $dossier->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300 flex items-center">
                    <i class="fas fa-edit ml-2"></i>
                    تعديل الملف
                </a>
                
                <a href="{{ route('dossiers.index', request()->query()) }}" class="bg-blue-950 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-lg transition duration-300 flex items-center">
                    <i class="fas fa-arrow-right ml-2"></i>
                    العودة إلى القائمة
                </a>
                
                <form action="{{ route('dossiers.destroy', $dossier->id) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا الملف؟')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300 flex items-center">
                        <i class="fas fa-trash-alt ml-2"></i>
                        حذف الملف
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

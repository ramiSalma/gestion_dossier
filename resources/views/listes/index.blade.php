@extends('welcome')

@section('content')
<div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg" dir="rtl">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-center text-blue-950">قائمة البطاقات</h1>
        <p class="text-center text-gray-600 mt-2">إدارة وعرض بطاقات الملفات</p>
    </div>

    <!-- Stats Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-r from-blue-950 to-blue-800 rounded-lg shadow-md p-6 text-white">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm opacity-80">إجمالي البطاقات</p>
                    <h3 class="text-3xl font-bold">{{ $listes->total() }}</h3>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-green-600 to-green-500 rounded-lg shadow-md p-6 text-white">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm opacity-80">البطاقات المرسلة</p>
                    <h3 class="text-3xl font-bold">{{ $listes->where('date_envoi', '!=', null)->count() }}</h3>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="bg-gradient-to-r from-yellow-600 to-yellow-500 rounded-lg shadow-md p-6 text-white">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm opacity-80">البطاقات قيد الإعداد</p>
                    <h3 class="text-3xl font-bold">{{ $listes->where('date_envoi', null)->count() }}</h3>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Add new liste button -->
    <div class="flex justify-end mb-6">
        <button type="button" onclick="document.getElementById('addListeModal').classList.remove('hidden'); document.getElementById('addListeModal').classList.add('flex'); document.body.style.overflow = 'hidden';" class="bg-blue-950 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            إضافة بطاقة جديدة
        </button>
    </div>

    <!-- Display the list cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($listes as $liste)
            <div class="bg-white border border-gray-200 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                <!-- Card Header -->
                <div class="bg-blue-950 text-white p-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold">بطاقة #{{ $liste->id }}</h2>
                        <span class="bg-blue-800 text-white text-xs py-1 px-2 rounded-full">
                            {{ $liste->dossier()->count() }} ملف
                        </span>
                    </div>
                </div>
                
                <!-- Card Body -->
                <div class="p-5">
                    <div class="mb-4">
                        <p class="text-sm text-gray-600">تاريخ الإنشاء: <span class="font-semibold text-gray-800">{{ $liste->date_creation->format('d/m/Y') }}</span></p>
                        
                        <!-- Display date_envoi if it exists -->
                        @if ($liste->date_envoi)
                            <p class="text-sm text-green-600 mt-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                تم الإرسال: {{ $liste->date_envoi->format('d/m/Y') }}
                            </p>
                        @else
                            <p class="text-sm text-yellow-600 mt-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                قيد الإعداد - لم يتم الإرسال بعد
                            </p>
                        @endif
                    </div>

                    <!-- Card Actions -->
                    <div class="grid grid-cols-2 gap-3 mt-4">
                        <!-- Add file button -->
                        @if (!$liste->date_envoi)
                            <a href="{{ route('listes.addFile', $liste->id) }}" class="bg-blue-950 hover:bg-blue-800 text-white text-center font-medium py-2 px-4 rounded-lg transition duration-200">
                                إضافة ملف
                            </a>
                        @else
                            <button class="bg-gray-300 text-gray-600 font-medium py-2 px-4 rounded-lg cursor-not-allowed" disabled>
                                إضافة ملف
                            </button>
                        @endif

                        <!-- See files button -->
                        <a href="{{ route('listes.show', $liste->id) }}" class="bg-blue-950 hover:bg-blue-800 text-white text-center font-medium py-2 px-4 rounded-lg transition duration-200">
                            عرض الملفات
                        </a>
                    </div>

                    <!-- Send button (if there are dossiers to be sent) -->
                    @if ($liste->dossier()->exists())
                        <form action="{{ route('listes.send', $liste->id) }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" 
                                onclick="return confirm('هل أنت متأكد من إرسال هذه البطاقة؟ لن تتمكن من تعديلها بعد الإرسال.')"
                                class="w-full font-medium py-2 px-4 rounded-lg transition duration-200
                                    {{ $liste->date_envoi ? 'bg-gray-300 text-gray-600 cursor-not-allowed' : 'bg-green-600 hover:bg-green-700 text-white' }}"
                                @if ($liste->date_envoi) disabled @endif>
                                {{ $liste->date_envoi ? 'تم الإرسال' : 'إرسال البطاقة' }}
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Empty state -->
    @if($listes->isEmpty())
        <div class="text-center py-12 bg-gray-50 rounded-lg border border-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="mt-4 text-xl font-medium text-gray-600">لا توجد بطاقات</h3>
            <p class="mt-2 text-gray-500">قم بإضافة بطاقة جديدة للبدء</p>
        </div>
    @endif

    <!-- Pagination -->
    <div class="mt-10">
        {{ $listes->links() }}
    </div>
</div>
@endsection

<!-- Modal for adding a new liste -->
<div id="addListeModal" class="fixed inset-0 backdrop-blur-sm bg-gray-900/50 hidden items-center justify-center z-50 transition-all duration-300">
    <div class="bg-white/95 rounded-lg shadow-xl w-full max-w-md mx-4 overflow-hidden border border-gray-200">
        <!-- Modal Header -->
        <div class="bg-blue-950 text-white px-6 py-4">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold">إضافة بطاقة جديدة</h3>
                <button type="button" onclick="document.getElementById('addListeModal').classList.add('hidden'); document.getElementById('addListeModal').classList.remove('flex'); document.body.style.overflow = 'auto';" class="text-white hover:text-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Modal Body -->
        <div class="p-6">
            <form action="{{ route('listes.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="date_creation" class="block text-right text-lg font-medium text-gray-700">تاريخ الإنشاء</label>
                    <input type="date" name="date_creation" id="date_creation" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/80" value="{{ now()->toDateString() }}">
                </div>
                
                <div class="mb-4">
                    <label for="title" class="block text-right text-lg font-medium text-gray-700">عنوان البطاقة (اختياري)</label>
                    <input type="text" name="title" id="title" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/80" placeholder="أدخل عنوانًا للبطاقة">
                </div>
                
                <div class="flex justify-end mt-6">
                    <button type="button" onclick="document.getElementById('addListeModal').classList.add('hidden'); document.getElementById('addListeModal').classList.remove('flex'); document.body.style.overflow = 'auto';" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg ml-3 transition-colors">
                        إلغاء
                    </button>
                    <button type="submit" class="bg-blue-950 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                        إضافة البطاقة
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Make sure the script runs after the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Check if the modal exists
        const modal = document.getElementById('addListeModal');
        if (!modal) {
            console.error('Modal element not found!');
            return;
        }
        
        // Add click event to close when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
                this.classList.remove('flex');
                document.body.style.overflow = 'auto';
            }
        });
        
        // Debug log
        console.log('Modal script initialized');
    });
</script>

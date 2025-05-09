@extends('welcome')

@section('content')
<div dir="rtl" class="min-h-screen mt-5 py-10 px-6 flex items-center justify-center">
    <div class="bg-white w-full max-w-6xl rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-blue-950 text-white p-6">
            <h2 class="text-2xl font-bold text-center">تعديل معلومات الملف <span class="bg-yellow-500 text-blue-950 px-3 py-1 rounded-full text-lg">{{ $dossier->num }}</span></h2>
        </div>

        <form action="{{ route('dossiers.update', $dossier->id) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')
            
            @if(session('error'))
            <div class="bg-red-100 border-r-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <p class="font-medium">{{ session('error') }}</p>
            </div>
            @endif

            <!-- Main Information Section -->
            <div class="mb-8">
                <h3 class="text-lg font-bold text-blue-950 mb-4 border-r-4 border-yellow-500 pr-3">المعلومات الأساسية</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- رقم الملف -->
                    <div>
                        <label for="num" class="block mb-2 text-sm font-medium text-gray-700">رقم الملف</label>
                        <input type="text" name="num" id="num" 
                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent" 
                            value="{{ $dossier->num }}" required>
                        @error('num')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- رقم القضية -->
                    <div>
                        <label for="code" class="block mb-2 text-sm font-medium text-gray-700">رقم القضية</label>
                        <input type="text" name="code" id="code" 
                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent" 
                            value="{{ $dossier->code }}" required>
                        @error('code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- السنة -->
                    <div>
                        <label for="annee" class="block mb-2 text-sm font-medium text-gray-700">السنة</label>
                        <input type="text" name="annee" id="annee" 
                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent" 
                            value="{{ $dossier->annee }}" required maxlength="4">
                        @error('annee')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- أطراف الملف -->
            <div class="mb-8">
                <h3 class="text-lg font-bold text-blue-950 mb-4 border-r-4 border-yellow-500 pr-3 flex items-center">
                    <i class="fas fa-users ml-2"></i>أطراف الملف
                </h3>
                
                <div id="parties_container" class="space-y-4">
                    @foreach($dossier->parties as $index => $party)
                        <div class="party bg-gray-50 p-4 rounded-lg border border-gray-200 hover:border-yellow-500 transition-colors">
                            <input type="hidden" name="parties[{{ $index }}][id]" value="{{ $party->id }}">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700">الإسم الكامل</label>
                                    <input type="text" name="parties[{{ $index }}][full_name]" 
                                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent" 
                                        value="{{ $party->full_name }}" required>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700">الصفة</label>
                                    <select name="parties[{{ $index }}][type]" 
                                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent" required>
                                        <option value="متهم" {{ $party->type === 'متهم' ? 'selected' : '' }}>متهم</option>
                                        <option value="ضحية" {{ $party->type === 'ضحية' ? 'selected' : '' }}>ضحية</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <button type="button" id="add_party" class="mt-4 bg-blue-950 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition-colors flex items-center">
                    <i class="fas fa-plus ml-2"></i> إضافة طرف جديد
                </button>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap justify-center gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="bg-yellow-500 text-white px-8 py-3 rounded-lg font-bold hover:bg-yellow-600 transition-colors flex items-center">
                    <i class="fas fa-save ml-2"></i> تحديث الملف
                </button>
                
                <a href="{{ route('dossiers.show', $dossier->id) }}" class="bg-blue-950 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-800 transition-colors flex items-center">
                    <i class="fas fa-eye ml-2"></i> عرض الملف
                </a>
                
                <a href="{{ url('/dossiers') }}" class="bg-gray-500 text-white px-8 py-3 rounded-lg font-bold hover:bg-gray-600 transition-colors flex items-center">
                    <i class="fas fa-times ml-2"></i> إلغاء
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add new party functionality
        document.getElementById('add_party').addEventListener('click', function() {
            const partiesContainer = document.getElementById('parties_container');
            const partyCount = document.querySelectorAll('.party').length;
            
            const newPartyHTML = `
                <div class="party bg-gray-50 p-4 rounded-lg border border-gray-200 hover:border-yellow-500 transition-colors">
                    <div class="flex justify-between items-center mb-3">
                        <h4 class="font-medium text-blue-950">طرف جديد</h4>
                        <button type="button" class="text-red-500 hover:text-red-700 transition-colors" onclick="this.closest('.party').remove()">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">الإسم الكامل</label>
                            <input type="text" name="new_parties[${partyCount}][full_name]" 
                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent" 
                                required>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">الصفة</label>
                            <select name="new_parties[${partyCount}][type]" 
                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent" required>
                                <option value="متهم">متهم</option>
                                <option value="ضحية">ضحية</option>
                            </select>
                        </div>
                    </div>
                </div>
            `;
            
            partiesContainer.insertAdjacentHTML('beforeend', newPartyHTML);
        });
    });
</script>
@endsection

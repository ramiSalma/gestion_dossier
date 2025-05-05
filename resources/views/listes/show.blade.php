@extends('welcome')

@section('content')
<div class="container mt-[100px] mx-auto mt-10 p-6 bg-white rounded-lg shadow text-right" dir="rtl">
    <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">تفاصيل البطاقة</h1>

    <!-- Button Row: Back and Add File buttons on the same line -->
    <div class="mb-6 flex justify-between items-center">
        <!-- Add File Button -->
        <a href="{{ route('listes.addFile', $liste->id) }}" class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-6 rounded-2xl">
            إضافة ملف
        </a>
        <!-- Back Button -->
        <a href="{{ route('listes.index') }}" class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-6 rounded-2xl">
            العودة إلى القائمة
        </a>
        <!-- Print PDF Button -->
        <a href="{{ route('listes.print', $liste->id) }}" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-6 rounded-2xl">
            طباعة PDF
        </a>

    </div>

    <!-- Display the Dossiers related to the Liste -->
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-right">رقم الملف</th>
                    <th class="px-4 py-2 text-right">رقم القضية</th>
                    <th class="px-4 py-2 text-right">السنة</th>
                    <th class="px-4 py-2 text-right">تاريخ الأرشفة</th>
                    {{--  <th class="px-4 py-2 text-right">الإجراءات</th>  --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($dossiers as $dossier)
                    <tr>
                        <td class="px-4 py-2">{{ $dossier->num }}</td>
                        <td class="px-4 py-2">{{ $dossier->code }}</td>
                        <td class="px-4 py-2">{{ $dossier->annee }}</td>
                        <td class="px-4 py-2">{{ $dossier->date_archivage ? $dossier->date_archivage->format('d/m/Y') : 'غير محدد' }}</td>
                        {{--  <td class="px-4 py-2 flex items-center space-x-4">
                            <!-- Delete Button with Icon -->
                            <form action="{{ route('listes.dossiers.remove', [$liste->id, $dossier->id]) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من إزالة هذا الملف من القائمة؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white px-4 py-2 rounded">
                                    <i class="fas fa-trash text-red-800"></i> 
                                </button>
                            </form>
                            
                        </td>  --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 text-center">
        {{ $dossiers->links() }}  <!-- Pagination links will be displayed here -->
    </div>
</div>
@endsection

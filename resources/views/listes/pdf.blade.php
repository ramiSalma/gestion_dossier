{{--  <!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>بطاقة رقم {{ $liste->id }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 8px; text-align: right; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">بطاقة رقم {{ $liste->id }}</h2>
    <p><strong>العنوان: المحكمة الابتدائية بسلا </strong> {{ $liste->title }}</p>
    <p><strong>تاريخ الإرسال:</strong> {{ $liste->date_envoi ? \Carbon\Carbon::parse($liste->date_envoi)->format('d/m/Y') : 'غير مرسل' }}</p>

    <table>
        <thead>
            <tr>
                <th>رقم الملف</th>
                <th>رقم القضية</th>
                <th>السنة</th>
                <th>تاريخ الأرشفة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dossiers as $dossier)
                <tr>
                    <td>{{ $dossier->num }}</td>
                    <td>{{ $dossier->code }}</td>
                    <td>{{ $dossier->annee }}</td>
                    <td>{{ $dossier->date_archivage ? \Carbon\Carbon::parse($dossier->date_archivage)->format('d/m/Y') : 'غير محدد' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>  --}}

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Liste N° {{ $liste->id }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; direction: ltr; text-align: left; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Liste N° {{ $liste->id }}</h2>
    <p><strong>Tribunal :</strong> Tribunal de première instance de Salé</p>
    <p><strong>Titre :</strong> {{ $liste->title }}</p>
    <p><strong>Date d'envoi :</strong> {{ $liste->date_envoi ? \Carbon\Carbon::parse($liste->date_envoi)->format('d/m/Y') : 'Non envoyée' }}</p>

    <table>
        <thead>
            <tr>
                <th>Numéro du dossier</th>
                <th>Numéro de l'affaire</th>
                <th>Année</th>
                <th>Date d'archivage</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dossiers as $dossier)
                <tr>
                    <td>{{ $dossier->num }}</td>
                    <td>{{ $dossier->code }}</td>
                    <td>{{ $dossier->annee }}</td>
                    <td>{{ $dossier->date_archivage ? \Carbon\Carbon::parse($dossier->date_archivage)->format('d/m/Y') : 'Non définie' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

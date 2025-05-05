<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Dancing+Script:wght@400..700&family=Reem+Kufi:wght@400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-200">
    @include('components.seachBar')
    <div class="flex justify-center  h-screen">
        
        <div class=" p-10 mr-60 w-[1300px] bg-gray-200 "> 
            @yield('content')
            {{--  @if (!View::hasSection('content'))

            <!-- Services Section -->
            
            @endif  --}}
        </div>
        <x-side-bar></x-side-bar>

</div>
{{--  @include('footer')  --}}

<script>
    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('toggleSidebar');

    toggle.addEventListener('click', () => {
      sidebar.classList.toggle('translate-x-full');
    });
  </script>
</body>
</html>
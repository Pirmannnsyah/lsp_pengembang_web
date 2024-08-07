<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="text-2xl m-4 font-semibold tracking-wide text-center">PENGUMUMAN</div>
    @foreach ($pengumuman as $p)
    <div class="m-4 border border-slate-200 rounded-2xl max-w-6xl mx-auto shadow-md p-4">
        <form action="">
            <p class="text-center mx-auto text-lg font-medium">{{ $p->judul_pengumuman }}</p>
            <div class="border-2 border-slate-300 rounded my-1"></div>
            <p>{{ $p->deskripsi_pengumuman }}</p>
            <p>{{ $p->gambar_pengumuman }}</p>
            <a href="/pengumuman/{{$p->id}}/edit">Edit</a>  
            <form action="/pengumuman/{{ $p->id }}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit">Delete</button>
            </form>
        </form>
    </div>
     
    @endforeach
</body>
</html>
      



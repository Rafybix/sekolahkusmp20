@extends('frontend.template.app')
@section('content')
{{-- INDEX BERITA --}}
<section class="col-span-6 space-y-6">
    <div class="bg-white p-6 rounded-xl shadow h-full min-h-[500px] flex flex-col justify-start">
        <div class="flex items-center mb-4">
            <i class="fa-solid fa-book-open text-blue-600 text-2xl mr-3"></i>
            <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-500 pl-3">
                Moto SMP Negeri 20 Kendari
            </h2>
        </div>

        <div class="mt-4 text-gray-700 leading-relaxed text-center">
            <p class="text-lg italic text-gray-800 font-semibold">
                “Berkarakter, Berprestasi, dan Peduli Lingkungan”
            </p>

            <p class="mt-4 text-sm text-gray-600">
                Moto ini mencerminkan semangat SMP Negeri 20 Kendari dalam membentuk peserta didik 
                yang tidak hanya unggul dalam akademik, tetapi juga memiliki moral, kepedulian sosial, 
                dan rasa tanggung jawab terhadap lingkungan sekitar.
            </p>
        </div>
    </div>
</section>
@endsection

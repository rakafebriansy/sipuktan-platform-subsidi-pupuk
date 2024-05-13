@extends('dashboard.pemerintah.partials.body')
@section('wrapper')
<div class="p-4 sm:ml-64">
   <div class="p-4 rounded-lg">
      <h1 class="text-3xl font-bold">Selamat datang di SIPUKTAN</h1>
      <div class="w-full mt-4 p-3 box-border rounded-md shadow-md">
         <p>SIPUKTAN Solusi terdepan untuk meningkatkan kesejahteraan petani dan mendukung pertanian yang berkelanjutan! Dengan sistem ini, petani dapat dengan mudah mengakses subsidi pupuk yang dibutuhkan, memastikan produksi yang lebih baik dan keberlanjutan lingkungan dengan dukungan pemerintah yang efektif.</p>
      </div>
      <div class="w-full mt-4 md:grid md:grid-cols-4 md:gap-4 text-sm">
         <div class="col-span-1 md:-full mb-4 md:mb-0">
            <div class="p-3 box-border rounded-md shadow-md mb-4">
               <h2 class="mb-3 text-lg font-bold">Pupuk Urea</h2>
               <p>Pupuk urea biasanya diterapkan secara langsung ke tanah atau dicampur dengan air untuk disemprotkan ke tanaman sebagai larutan pupuk. Ini memberikan akses yang cepat dan efisien bagi tanaman untuk menyerap nutrisi.</p>
            </div>
            <div class="p-3 box-border rounded-md shadow-md mb-4">
               <h2 class="mb-3 text-lg font-bold">Pupuk Ponshka</h2>
               <p>Pupuk Phonska dapat membantu meningkatkan kesuburan tanah, memperbaiki struktur tanah, dan memberikan nutrisi penting bagi pertumbuhan tanaman.</p>
            </div>
            <div class="p-3 box-border rounded-md shadow-md">
               <h2 class="mb-3 text-lg font-bold">Pupuk SP-36</h2>
               <p>Pupuk SP-36 membantu dalam pembentukan akar yang kuat, perkembangan bunga dan buah, serta proses metabolisme energi dalam tanaman. pupuk SP-36 sangat berguna untuk meningkatkan kesuburan tanah dan meningkatkan produksi tanaman.</p>
            </div>
         </div>
         <div class="col-span-3 h-full box-border md:flex md:flex-col md:gap-4">
            <div class="md:grid-cols-2 md:grid md:gap-4 md:h-[40%] mb-4 md:mb-0">
               <div class="p-3 box-border rounded-md shadow-md mb-4 md:mb-0">
                  <div class="md:h-[10%] w-full">
                     <h2 class="mb-2 text-center text-md font-bold">Langkah-Langkah Pembayaran Non-Tunai</h2>
                  </div>
                  <div class="md:h-[90%] w-full flex items-center">
                     <img src="../images/Langkah non Tunai.png" alt="">
                  </div>
               </div>
               <div class="p-3 box-border rounded-md shadow-md">
                  <div class="md:h-[10%] w-full">
                     <h2 class="mb-2 text-center text-md font-bold">Langkah-Langkah Pembayaran Tunai</h2>
                  </div>
                  <div class="md:h-[90%] w-full flex justify-center items-center">
                     <img class="" src="../images/Langkah Tunai.png" alt="">
                  </div>
               </div>
            </div>
            <div class="p-3 box-border rounded-md shadow-md md:h-[60%]">
               <div class="mb-4 w-full">
                  <h2 class="mb-2 text-center text-md font-bold">Penyaluran Pupuk Subsidi Per 10 Tahun</h2>
               </div>
               <div class="w-full flex justify-center items-center">
                  <img class="w-[70%]" src="../images/Subsidi 10 Tahun.png" alt="">
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
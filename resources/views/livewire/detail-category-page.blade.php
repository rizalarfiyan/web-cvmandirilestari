<main class="bg-white min-h-[calc(100dvh_-_228px)] w-full">
  <section class="relative flex h-full w-full items-center justify-center bg-slate-100 text-center pt-20 pb-60">
    <div aria-hidden="true" class="-space-x-52 absolute inset-0 grid grid-cols-2 opacity-40 dark:opacity-20">
      <div class="h-56 bg-gradient-to-br from-primary-500 to-primary-100 blur-[106px] dark:from-slate-100"></div>
      <div class="h-32 bg-gradient-to-r from-primary-100 to-primary-500 blur-[106px] dark:to-slate-100"></div>
    </div>
    <div class="container flex items-center justify-center gap-10">
      <div class="my-20 space-y-14 md:space-y-20">
        <div class="mx-auto max-w-2xl">
          <div class="mx-auto mb-6 flex flex-col items-center gap-2">
            <p class="scroll-m-20 font-semibold text-xl tracking-tight text-primary-600 dark:text-primary-50">
              Category</p>
            <div class="h-1 w-10 rounded bg-primary-500"></div>
          </div>
          <h1 class="scroll-m-20 font-extrabold tracking-tight text-slate-900 dark:text-slate-50 text-4xl leading-normal lg:text-5xl">
            "{{ $category->name }}"
          </h1>
          <div class="mt-8 mb-6 inline-block h-1 w-10 rounded bg-primary-500"></div>
          <div class="prose max-w-full">
            {!! $category->description !!}
          </div>
        </div>
      </div>
      <div class="relative w-full max-w-lg mt-20 flex items-center justify-center">
        <div class="size-72 z-10">
          <img class="object-cover w-full h-auto" src="{{ asset('/storage/'.$category->image) }}" alt="{{ $category->name }}">
        </div>
        <div class="size-72 bg-slate-100 rounded-full absolute top-10 bg-gradient-to-tr from-primary-500/20 to-slate-50/10"></div>
      </div>
    </div>
    <div class="absolute bottom-0 w-full overflow-hidden leading-[0]">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="h-28 w-[calc(100%_+_1.3px)] text-white">
        <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" fill="currentColor"></path>
      </svg>
    </div>
  </section>
  <section class="container">
    <div class="max-w-[85rem] px-4 pt-10 sm:px-6 lg:px-8 pb-28 mx-auto">
      <x-heading-title title="Produk" description="Anda dapat memilih produk yang sesuai dengan kategori ini."/>
      @if(!empty($products) && count($products) > 0)
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
          <div class="mb-16 grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($products as $product)
              <x-card-product wire:key="{{ $product->id }}" :product="$product"/>
            @endforeach
          </div>
          @if($products->hasPages())
            <div class="w-full text-center">
              <a wire:navigate href="/products?category[0]={{ $category->id }}" class="rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-medium text-slate-900 hover:bg-slate-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-slate-100 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-white dark:focus:ring-slate-700">
                Lebih lanjut
              </a>
            </div>
          @endif
        </div>
      @else
        <x-empty-state message="Belum ada produk yang tersedia."/>
      @endif
    </div>
  </section>
</main>

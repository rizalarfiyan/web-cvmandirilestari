<main class="bg-white">
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
      <div class="mx-auto max-w-lg space-y-2 text-center mb-16">
        <h2 class="font-semibold text-4xl tracking-tight text-slate-900 dark:text-slate-50">
          Product
        </h2>
        <p class="leading-tight text-slate-600">
          Anda dapat memilih produk yang sesuai dengan kategori ini.
        </p>
      </div>

      @if(!empty($products) && count($products) > 0)
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
          <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($products as $product)
              <div wire:key="{{ $product['id'] }}" class="group rounded-lg border border-slate-200 bg-white p-4 dark:border-slate-700 dark:bg-slate-800 shadow-sm">
                <div class="relative h-56 w-full overflow-hidden rounded-md">
                  <a href="/products/{{ $product['slug'] }}" class="bg-slate-200 block">
                    @if(count($product['images']) > 0)
                      <img src="{{ asset('/storage/'.$product['images'][0]) }}" alt="" class="object-cover w-full h-56 mx-auto group-hover:scale-110 transition-transform duration-300">
                    @endif
                    <div class="absolute inset-0 flex items-center justify-center w-full h-full bg-primary-700/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                      <svg class="size-12 text-slate-800" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19,7H16V6A4,4,0,0,0,8,6V7H5A1,1,0,0,0,4,8V19a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V8A1,1,0,0,0,19,7ZM10,6a2,2,0,0,1,4,0V7H10Zm8,13a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V9H8v1a1,1,0,0,0,2,0V9h4v1a1,1,0,0,0,2,0V9h2Z"></path>
                      </svg>
                    </div>
                  </a>
                </div>
                <div class="pt-3">
                  <a href="/products/{{ $product['slug'] }}" class="text-lg font-semibold leading-tight text-slate-900 hover:underline dark:text-white line-clamp-2">
                    {{ $product['name'] }}
                  </a>
                  <p class="text-2xl font-extrabold leading-tight text-slate-900 dark:text-white mt-2 mb-3">
                    {{ Number::currency($product['price'], 'IDR', 'id')  }}
                  </p>
                  <button type="button" class="inline-flex items-center justify-center w-full rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"/>
                    </svg>
                    Add
                  </button>
                </div>
              </div>
            @endforeach
          </div>
          <div class="w-full text-center">
            <button type="button" class="rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-medium text-slate-900 hover:bg-slate-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-slate-100 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-white dark:focus:ring-slate-700">
              Show more
            </button>
          </div>
        </div>
      @else
        <div class="min-h-60 flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-slate-700 dark:shadow-slate-700/70">
          <div class="flex flex-auto flex-col justify-center items-center p-4 md:p-5">
            <svg class="size-12 text-slate-400 dark:text-slate-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"></path>
            </svg>
            <p class="mt-2 text-slate-600 dark:text-slate-200">
              Belum ada produk yang tersedia.
            </p>
          </div>
        </div>
      @endif

    </div>
  </section>
</main>

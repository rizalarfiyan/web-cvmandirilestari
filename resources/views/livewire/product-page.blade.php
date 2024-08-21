<main class="w-full min-h-[calc(100dvh_-_228px)]">
  <section class="max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <x-heading-title title="Products" description="Anda dapat melihat seluruh produk yang tersedia. Gunakan filter untuk memaksimalkan pencarian anda."/>
      <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        @if(!empty($products) && count($products) > 0)
          <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($products as $product)
              <div wire:key="{{ $product['id'] }}" class="group rounded-lg border border-slate-200 bg-white p-4 dark:border-slate-700 dark:bg-slate-800 shadow-sm">
                <div class="relative h-56 w-full overflow-hidden rounded-md">
                  <a href="/products/{{ $product->slug }}" class="bg-slate-200 block">
                    @if(count($product->images) > 0)
                      <img src="{{ asset('/storage/'.$product->images[0]) }}" alt="" class="object-cover w-full h-56 mx-auto group-hover:scale-110 transition-transform duration-300">
                    @endif
                    <div class="absolute inset-0 flex items-center justify-center w-full h-full bg-primary-700/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                      <svg class="size-12 text-slate-800" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19,7H16V6A4,4,0,0,0,8,6V7H5A1,1,0,0,0,4,8V19a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V8A1,1,0,0,0,19,7ZM10,6a2,2,0,0,1,4,0V7H10Zm8,13a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V9H8v1a1,1,0,0,0,2,0V9h4v1a1,1,0,0,0,2,0V9h2Z"></path>
                      </svg>
                    </div>
                  </a>
                </div>
                <div class="pt-3">
                  <a href="/products/{{ $product->slug }}" class="text-lg font-semibold leading-tight text-slate-900 hover:underline dark:text-white line-clamp-2">
                    {{ $product->name }}
                  </a>
                  <p class="text-2xl font-extrabold leading-tight text-slate-900 dark:text-white mt-2 mb-3">
                    {{ Number::currency($product->price, 'IDR', 'id')  }}
                  </p>
                  <button type="button" wire:click.prevent="addToCart({{ $product->id }})" class="inline-flex items-center justify-center w-full rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"/>
                    </svg>
                    <span wire:loading.remove wire:target="addToCart({{ $product->id }})">Add</span>
                    <span wire:loading wire:target="addToCart({{ $product->id }})">Adding</span>
                  </button>
                </div>
              </div>
            @endforeach
          </div>
          <div class="max-w-48 mx-auto">
            {{ $products->links() }}
          </div>
        @else
          <x-empty-state message="Belum ada produk yang tersedia."/>
        @endif
      </div>
    </div>
  </section>
</main>

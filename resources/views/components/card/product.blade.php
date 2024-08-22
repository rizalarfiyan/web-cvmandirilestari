@props(['product'])

<div wire:key="{{ $product->id }}" class="group rounded-lg border border-slate-200 bg-white p-4 dark:border-slate-700 dark:bg-slate-800 shadow-sm">
  <div class="relative h-56 w-full overflow-hidden rounded-md">
    <a href="/products/{{ $product->slug }}" class="bg-slate-200 block">
      @if(count($product->images) > 0)
        <img src="{{ asset('/storage/'.$product->images[0]) }}" alt="" class="object-cover w-full h-56 mx-auto group-hover:scale-110 transition-transform duration-300">
      @endif
      <div class="absolute inset-0 flex items-center justify-center w-full h-full bg-primary-500/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        <svg class="size-12 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
          <path d="M19,7H16V6A4,4,0,0,0,8,6V7H5A1,1,0,0,0,4,8V19a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V8A1,1,0,0,0,19,7ZM10,6a2,2,0,0,1,4,0V7H10Zm8,13a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V9H8v1a1,1,0,0,0,2,0V9h4v1a1,1,0,0,0,2,0V9h2Z"></path>
        </svg>
      </div>
      <div class="absolute top-2 left-2">
        @if($product->is_featured)
          <span class="bg-primary-100 text-primary-800 text-xs font-medium me-1 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-primary-400 border border-primary-400">Unggulan</span>
        @endif
        @if($product->on_sale)
          <span class="bg-emerald-100 text-emerald-800 text-xs font-medium me-1 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-emerald-400 border border-emerald-400">Diskon</span>
        @endif
        @if(!$product->in_stock)
          <span class="bg-red-100 text-red-800 text-xs font-medium me-1 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">Habis</span>
        @endif
      </div>
    </a>
  </div>
  <div class="pt-3 flex items-center justify-center gap-4">
    <div class="w-full">
      <a href="/products/{{ $product->slug }}" class="text-lg font-semibold leading-tight text-slate-900 dark:text-white line-clamp-2">
        {{ $product->name }}
      </a>
      <p class="text-2xl font-extrabold leading-tight text-slate-900 dark:text-white mt-1">
        {{ Number::currency($product->price, 'IDR', 'id')  }}
      </p>
    </div>
    @if($product->in_stock)
      <button type="button" wire:click.prevent="addToCart({{ $product->id }})" class="p-2 text-sm flex items-center justify-center font-medium text-slate-900 focus:outline-none bg-white rounded-lg border border-slate-200 hover:bg-slate-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-slate-100 dark:focus:ring-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:border-slate-600 dark:hover:text-white dark:hover:bg-slate-700 transition-colors duration-300">
        <svg wire:loading.remove wire:target="addToCart({{ $product->id }})" class="size-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"/>
        </svg>
        <span wire:loading wire:target="addToCart({{ $product->id }})" class="animate-spin inline-block size-5 border-2 border-current border-t-transparent text-primary-600 rounded-full" role="status" aria-label="loading">
        <span class="sr-only">Loading...</span>
      </span>
      </button>
    @endif
  </div>
</div>

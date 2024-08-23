<header class="flex z-50 sticky top-0 flex-wrap md:justify-start md:flex-nowrap w-full bg-white text-sm py-3 md:py-0 dark:bg-slate-800 shadow-smooth">
  <nav class="max-w-[85rem] w-full mx-auto px-4 md:px-6 lg:px-8" aria-label="Global">
    <div class="relative md:flex md:items-center md:justify-between">
      <div class="flex items-center justify-between w-full max-w-full md:max-w-40">
        <a wire:navigate class="flex items-center gap-2 text-xl leading-tight font-semibold dark:text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-slate-600" href="/" aria-label="{{ config('app.name') }}">
          <img src="{{ asset('assets/logo_sm.png') }}" alt="{{ config('app.name') }} Logo" class="text-base flex-shrink-0 size-12">
          <div>{{ config('app.name') }}</div>
        </a>
        <div class="md:hidden">
          <button type="button" class="hs-collapse-toggle flex justify-center items-center w-9 h-9 text-sm font-semibold rounded-lg border border-slate-200 text-slate-800 hover:bg-slate-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-slate-700 dark:hover:bg-slate-700 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-slate-600" data-hs-collapse="#responsive-navbar" aria-controls="responsive-navbar" aria-label="Toggle navigation">
            <svg class="hs-collapse-open:hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="3" x2="21" y1="6" y2="6"/>
              <line x1="3" x2="21" y1="12" y2="12"/>
              <line x1="3" x2="21" y1="18" y2="18"/>
            </svg>
            <svg class="hs-collapse-open:block hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 6 6 18"/>
              <path d="m6 6 12 12"/>
            </svg>
          </button>
        </div>
      </div>

      <div id="responsive-navbar" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block">
        <div class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-slate-100 [&::-webkit-scrollbar-thumb]:bg-slate-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500">
          <div class="flex flex-col gap-x-0 mt-5 divide-y divide-dashed divide-slate-200 md:flex-row md:items-center md:justify-end md:gap-x-7 md:mt-0 md:ps-7 md:divide-y-0 md:divide-solid dark:divide-slate-700">

            <a wire:navigate class="font-medium py-3 md:py-6 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-slate-600 {{ request()->is('/') ? 'text-primary-600 dark:text-primary-500' : 'text-slate-500 hover:text-slate-400 dark:text-slate-400 dark:hover:text-slate-500' }}" href="/" aria-current="page">Beranda</a>
            <a wire:navigate class="font-medium py-3 md:py-6 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-slate-600 {{ str_starts_with(request()->path(), 'categories') ? 'text-primary-600 dark:text-primary-500' : 'text-slate-500 hover:text-slate-400 dark:text-slate-400 dark:hover:text-slate-500' }}" href="/categories">Kategori</a>
            <a wire:navigate class="font-medium py-3 md:py-6 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-slate-600 {{ str_starts_with(request()->path(), 'products') ? 'text-primary-600 dark:text-primary-500' : 'text-slate-500 hover:text-slate-400 dark:text-slate-400 dark:hover:text-slate-500' }}" href="/products">Produk</a>

            <a wire:navigate class="transition-colors duration-300 font-medium flex items-center py-3 md:py-6 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-slate-600 {{ request()->is('cart') ? 'text-primary-600 dark:text-primary-500' : 'text-slate-500 hover:text-slate-400 dark:text-slate-400 dark:hover:text-slate-500' }}" href="/cart">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="flex-shrink-0 w-5 h-5 mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
              </svg>
              <span class="mr-1">Keranjang</span>
              <span class="py-0.5 px-1.5 rounded-full text-xs font-medium bg-primary-50 border border-primary-200 text-primary-600">
                {{ $totalCount }}
              </span>
            </a>
          </div>
        </div>
      </div>

      <div class="pt-3 pl-5 md:pt-0 flex">
        @if(Auth::check())
          <div x-data="{ isOpen: false, openedWithKeyboard: false }" class="relative shrink-0" @keydown.esc.window="isOpen = false, openedWithKeyboard = false">
            <button aria-label="User menu" type="button" class="shrink-0" @click="isOpen = ! isOpen" aria-haspopup="true" @keydown.space.prevent="openedWithKeyboard = true" @keydown.enter.prevent="openedWithKeyboard = true" @keydown.down.prevent="openedWithKeyboard = true" :aria-expanded="isOpen || openedWithKeyboard">
              <img class="object-cover object-center fi-circular rounded-full h-8 w-8 fi-user-avatar" src="https://ui-avatars.com/api/?name=A&amp;color=FFFFFF&amp;background=09090b" alt="Avatar of Admin">
            </button>
            @php
              $urls = [
                  'Keluar' => 'logout',
              ];
              if (auth()->user()->can('admin')) {
                $urls = [
                  'Dashboard' => 'dashboard',
                  ...$urls
                ];
              }

              if (auth()->user()->can('customer')) {
                $urls = [
                  'Histori' => 'history',
                  ...$urls
                ];
              }
            @endphp
            <div x-cloak x-show="isOpen || openedWithKeyboard" x-transition x-trap="openedWithKeyboard" @click.outside="isOpen = false, openedWithKeyboard = false" @keydown.down.prevent="$focus.wrap().next()" @keydown.up.prevent="$focus.wrap().previous()" class="absolute top-11 left-0 flex w-full min-w-[12rem] flex-col overflow-hidden rounded-md border border-slate-300 bg-slate-50 py-1.5 dark:border-slate-700 dark:bg-slate-900" role="menu">
              @foreach($urls as $name => $url)
                <a href="{{ $url }}" class="bg-slate-50 px-4 py-2 text-sm text-slate-600 hover:bg-slate-900/5 hover:text-slate-900 focus-visible:bg-slate-900/10 focus-visible:text-slate-900 focus-visible:outline-none dark:bg-slate-900 dark:text-slate-300 dark:hover:bg-slate-50/5 dark:hover:text-white dark:focus-visible:bg-slate-50/10 dark:focus-visible:text-white" role="menuitem">
                  {{ $name }}
                </a>
              @endforeach
            </div>
          </div>
        @else
          <a href="/login" class="transition-colors duration-300 py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-slate-600">
            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
            Masuk
          </a>
        @endif
      </div>
    </div>
  </nav>
</header>

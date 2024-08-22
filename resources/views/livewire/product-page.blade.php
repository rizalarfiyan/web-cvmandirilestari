<main class="w-full min-h-[calc(100dvh_-_228px)]">
  <section class="max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <x-heading-title title="Produk" description="Anda dapat melihat seluruh produk yang tersedia. Gunakan filter untuk memaksimalkan pencarian anda."/>

      <div class="mb-4 items-center justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
        <div class="flex items-center justify-center gap-2">

          <div x-data="{modalIsOpen: false}">
            <button @click="modalIsOpen = true" type="button" class="transition-colors duration-300 flex w-full items-center justify-center rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-900 hover:bg-slate-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-slate-100 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-white dark:focus:ring-slate-700 sm:w-auto">
              <svg class="-ms-0.5 me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                <path d="M7.5,6A1.5,1.5,0,1,0,9,7.5,1.5,1.5,0,0,0,7.5,6Zm13.62,4.71L12.71,2.29A1,1,0,0,0,12,2H3A1,1,0,0,0,2,3v9a1,1,0,0,0,.29.71l8.42,8.41a3,3,0,0,0,4.24,0L21.12,15a3,3,0,0,0,0-4.24Zm-1.41,2.82h0l-6.18,6.17a1,1,0,0,1-1.41,0L4,11.59V4h7.59l8.12,8.12a1,1,0,0,1,.29.71A1,1,0,0,1,19.71,13.53Z"></path>
              </svg>
              Kategori
              <svg class="-me-0.5 ms-2 size-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
              </svg>
            </button>

            <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen" @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false" class="fixed inset-0 z-[100] flex items-end justify-center bg-black/20 p-4 pb-8 sm:items-center lg:p-8" role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
              <div x-show="modalIsOpen" x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity" x-transition:enter-start="opacity-0 -translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-md border border-slate-300 bg-white text-slate-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300">
                <div class="flex justify-between items-center py-3 px-4 border-b dark:border-slate-700">
                  <h3 class="font-bold text-slate-800 dark:text-white">
                    Filter berdasarkan Kategori
                  </h3>
                  <button type="button" @click="modalIsOpen = false" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-slate-100 text-slate-800 hover:bg-slate-200 focus:outline-none focus:bg-slate-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-700 dark:hover:bg-slate-600 dark:text-slate-400 dark:focus:bg-slate-600" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M18 6 6 18"></path>
                      <path d="m6 6 12 12"></path>
                    </svg>
                  </button>
                </div>
                <div class="p-4 overflow-y-auto">
                  <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                    @foreach($groupCategories as $key => $categories)
                      <div class="space-y-2" wire:key="{{ $key }}">
                        <h5 class="text-lg font-medium uppercase text-black dark:text-white">{{ $key }}</h5>
                        @foreach($categories as $item)
                          @php
                            $idx = "{$item['id']}-{$item['slug']}"
                          @endphp
                          <label class="flex cursor-pointer" for="{{ $idx }}" wire:key="{{ $item['id'] }}">
                            <input id="{{ $idx }}" type="checkbox" wire:model.live="category" value="{{ $item['id'] }}" class="shrink-0 mt-0.5 border-slate-200 rounded text-primary-600 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-800 dark:border-slate-700 dark:checked:bg-primary-500 dark:checked:border-primary-500 dark:focus:ring-offset-slate-800">
                            <div class="text-sm text-slate-500 ms-3 dark:text-slate-400">{{ $item['name'] }}</div>
                          </label>
                        @endforeach
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div x-data="{ isOpen: false, openedWithKeyboard: false }" class="relative" @keydown.esc.window="isOpen = false, openedWithKeyboard = false">
            <button type="button" @click="isOpen = ! isOpen" class="transition-colors duration-300 flex w-full items-center justify-center rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-900 hover:bg-slate-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-slate-100 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-white dark:focus:ring-slate-700 sm:w-auto" aria-haspopup="true" @keydown.space.prevent="openedWithKeyboard = true" @keydown.enter.prevent="openedWithKeyboard = true" @keydown.down.prevent="openedWithKeyboard = true" :class="isOpen || openedWithKeyboard ? 'text-slate-900 dark:text-white' : 'text-slate-600 dark:text-slate-300'" :aria-expanded="isOpen || openedWithKeyboard">
              <svg class="-ms-0.5 me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"/>
              </svg>
              Status
              <svg class="-me-0.5 ms-2 size-4" x-bind:class="{ 'rotate-180': isOpen }" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m6 9 6 6 6-6"/>
              </svg>
            </button>

            <div x-cloak x-show="isOpen || openedWithKeyboard" x-transition x-trap="openedWithKeyboard" @click.outside="isOpen = false, openedWithKeyboard = false" @keydown.down.prevent="$focus.wrap().next()" @keydown.up.prevent="$focus.wrap().previous()" class="absolute z-40 top-11 left-0 flex min-w-[12rem] flex-col overflow-hidden rounded-md border border-slate-300 bg-slate-50 p-1 dark:border-slate-700 dark:bg-slate-900" role="menu">
              @foreach($statusFilters as $status)
                <label wire:key="{{ $status['id'] }}" for="{{ $status['id'] }}" class="relative cursor-pointer flex items-start py-2 px-3 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                  <div class="flex items-center h-5 mt-1">
                    <input id="{{ $status['id'] }}" wire:model.live="{{ $status['model'] }}" type="checkbox" class="shrink-0 border-slate-200 rounded text-primary-600 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-800 dark:border-slate-700 dark:checked:bg-primary-500 dark:checked:border-primary-500 dark:focus:ring-offset-slate-800" aria-describedby="{{ $status['id'] }}-description">
                  </div>
                  <div class="ms-3.5">
                    <span class="block text-sm font-semibold text-slate-800 dark:text-slate-300">{{ $status['name'] }}</span>
                    <span id="{{ $status['id'] }}-description" class="block text-sm text-slate-600 dark:text-slate-500">{{ $status['description'] }}</span>
                  </div>
                </label>
              @endforeach
            </div>
          </div>
        </div>

        <div x-data="{ isOpen: false, openedWithKeyboard: false }" class="relative" @keydown.esc.window="isOpen = false, openedWithKeyboard = false">
          <button type="button" @click="isOpen = ! isOpen" class="transition-colors duration-300 flex w-full items-center justify-center rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-900 hover:bg-slate-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-slate-100 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-white dark:focus:ring-slate-700 sm:w-auto" aria-haspopup="true" @keydown.space.prevent="openedWithKeyboard = true" @keydown.enter.prevent="openedWithKeyboard = true" @keydown.down.prevent="openedWithKeyboard = true" :class="isOpen || openedWithKeyboard ? 'text-slate-900 dark:text-white' : 'text-slate-600 dark:text-slate-300'" :aria-expanded="isOpen || openedWithKeyboard">
            <svg class="-ms-0.5 me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M7 4l3 3M7 4 4 7m9-3h6l-6 6h6m-6.5 10 3.5-7 3.5 7M14 18h4"/>
            </svg>
            Urutkan
            <svg class="-me-0.5 ms-2 size-4" x-bind:class="{ 'rotate-180': isOpen }" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m6 9 6 6 6-6"/>
            </svg>
          </button>

          <div x-cloak x-show="isOpen || openedWithKeyboard" x-transition x-trap="openedWithKeyboard" @click.outside="isOpen = false, openedWithKeyboard = false" @keydown.down.prevent="$focus.wrap().next()" @keydown.up.prevent="$focus.wrap().previous()" class="absolute z-40 top-11 left-0 flex min-w-[12rem] flex-col overflow-hidden rounded-md border border-slate-300 bg-slate-50 p-1 dark:border-slate-700 dark:bg-slate-900" role="menu">
            @foreach($sortOrders as $order)
              <label wire:key="{{ $order['id'] }}" class="relative cursor-pointer flex items-center py-2 px-3 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                <div class="flex items-center h-5">
                  <input id="{{ $order['id'] }}" name="sort-order" wire:model.live="sortOrder" value="{{ $order['id'] }}" type="radio" class="shrink-0 border-slate-200 rounded-full text-primary-600 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-800 dark:border-slate-700 dark:checked:bg-primary-500 dark:checked:border-primary-500 dark:focus:ring-offset-slate-800" aria-describedby="{{ $order['id'] }}">
                </div>
                <div class="ms-3.5">
                  <span class="block text-sm font-semibold text-slate-800 dark:text-slate-300 cursor-pointer">{{ $order['name'] }}</span>
                </div>
              </label>
            @endforeach
          </div>
        </div>
      </div>

      <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        @if(!empty($products) && count($products) > 0)
          <div class="mb-16 grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($products as $product)
              <x-card-product wire:key="{{ $product->id }}" :product="$product" />
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



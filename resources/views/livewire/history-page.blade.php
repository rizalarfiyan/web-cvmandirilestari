<main class="w-full min-h-[calc(100dvh_-_228px)]">
  <section class="py-8 md:py-16">
    <x-heading-title title="Riwayat" description="Riwayat pesanan yang anda telah beli."/>
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <div class="mb-4 items-center justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
        <div class="flex items-center justify-center gap-2">
          <div x-data="{ isOpen: false, openedWithKeyboard: false }" class="relative" @keydown.esc.window="isOpen = false, openedWithKeyboard = false">
            <button type="button" @click="isOpen = ! isOpen" class="transition-colors duration-300 flex w-full items-center justify-center rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-900 hover:bg-slate-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-slate-100 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-white dark:focus:ring-slate-700 sm:w-auto" aria-haspopup="true" @keydown.space.prevent="openedWithKeyboard = true" @keydown.enter.prevent="openedWithKeyboard = true" @keydown.down.prevent="openedWithKeyboard = true" :class="isOpen || openedWithKeyboard ? 'text-slate-900 dark:text-white' : 'text-slate-600 dark:text-slate-300'" :aria-expanded="isOpen || openedWithKeyboard">
              <svg class="-ms-0.5 me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M7 4l3 3M7 4 4 7m9-3h6l-6 6h6m-6.5 10 3.5-7 3.5 7M14 18h4"/>
              </svg>
              Metode Pembayaran
              <svg class="-me-0.5 ms-2 size-4" x-bind:class="{ 'rotate-180': isOpen }" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m6 9 6 6 6-6"/>
              </svg>
            </button>

            <div x-cloak x-show="isOpen || openedWithKeyboard" x-transition x-trap="openedWithKeyboard" @click.outside="isOpen = false, openedWithKeyboard = false" @keydown.down.prevent="$focus.wrap().next()" @keydown.up.prevent="$focus.wrap().previous()" class="absolute z-40 top-11 left-0 flex min-w-[12rem] flex-col overflow-hidden rounded-md border border-slate-300 bg-slate-50 p-1 dark:border-slate-700 dark:bg-slate-900" role="menu">
              @foreach($paymentMethodFilters as $paymentMethod)
                <label wire:key="payment-method-{{ $paymentMethod['value'] }}" class="relative cursor-pointer flex items-center py-2 px-3 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                  <div class="flex items-center h-5">
                    <input id="payment-method-{{ $paymentMethod['value'] }}" name="payment-method" wire:model.live="paymentMethod" value="{{ $paymentMethod['value'] }}" type="radio" class="shrink-0 border-slate-200 rounded-full text-primary-600 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-800 dark:border-slate-700 dark:checked:bg-primary-500 dark:checked:border-primary-500 dark:focus:ring-offset-slate-800" aria-describedby="payment-method-{{ $paymentMethod['value'] }}">
                  </div>
                  <div class="ms-3.5">
                    <span class="block text-sm font-semibold text-slate-800 dark:text-slate-300 cursor-pointer">{{ $paymentMethod['name'] }}</span>
                  </div>
                </label>
              @endforeach
            </div>
          </div>
          <div x-data="{ isOpen: false, openedWithKeyboard: false }" class="relative" @keydown.esc.window="isOpen = false, openedWithKeyboard = false">
            <button type="button" @click="isOpen = ! isOpen" class="transition-colors duration-300 flex w-full items-center justify-center rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-900 hover:bg-slate-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-slate-100 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-white dark:focus:ring-slate-700 sm:w-auto" aria-haspopup="true" @keydown.space.prevent="openedWithKeyboard = true" @keydown.enter.prevent="openedWithKeyboard = true" @keydown.down.prevent="openedWithKeyboard = true" :class="isOpen || openedWithKeyboard ? 'text-slate-900 dark:text-white' : 'text-slate-600 dark:text-slate-300'" :aria-expanded="isOpen || openedWithKeyboard">
              <svg class="-ms-0.5 me-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"/>
              </svg>
              Status Pembayaran
              <svg class="-me-0.5 ms-2 size-4" x-bind:class="{ 'rotate-180': isOpen }" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m6 9 6 6 6-6"/>
              </svg>
            </button>

            <div x-cloak x-show="isOpen || openedWithKeyboard" x-transition x-trap="openedWithKeyboard" @click.outside="isOpen = false, openedWithKeyboard = false" @keydown.down.prevent="$focus.wrap().next()" @keydown.up.prevent="$focus.wrap().previous()" class="absolute z-40 top-11 left-0 flex min-w-[12rem] flex-col overflow-hidden rounded-md border border-slate-300 bg-slate-50 p-1 dark:border-slate-700 dark:bg-slate-900" role="menu">
              @foreach($paymentStatusFilters as $paymentStatus)
                <label wire:key="payment-status-{{ $paymentStatus['value'] }}" class="relative cursor-pointer flex items-center py-2 px-3 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                  <div class="flex items-center h-5">
                    <input id="payment-status-{{ $paymentStatus['value'] }}" name="payment-status" wire:model.live="paymentStatus" value="{{ $paymentStatus['value'] }}" type="radio" class="shrink-0 border-slate-200 rounded-full text-primary-600 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-800 dark:border-slate-700 dark:checked:bg-primary-500 dark:checked:border-primary-500 dark:focus:ring-offset-slate-800" aria-describedby="payment-status-{{ $paymentStatus['value'] }}">
                  </div>
                  <div class="ms-3.5">
                    <span class="block text-sm font-semibold text-slate-800 dark:text-slate-300 cursor-pointer">{{ $paymentStatus['name'] }}</span>
                  </div>
                </label>
              @endforeach
            </div>
          </div>
          <div x-data="{ isOpen: false, openedWithKeyboard: false }" class="relative" @keydown.esc.window="isOpen = false, openedWithKeyboard = false">
            <button type="button" @click="isOpen = ! isOpen" class="transition-colors duration-300 flex w-full items-center justify-center rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-900 hover:bg-slate-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-slate-100 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-white dark:focus:ring-slate-700 sm:w-auto" aria-haspopup="true" @keydown.space.prevent="openedWithKeyboard = true" @keydown.enter.prevent="openedWithKeyboard = true" @keydown.down.prevent="openedWithKeyboard = true" :class="isOpen || openedWithKeyboard ? 'text-slate-900 dark:text-white' : 'text-slate-600 dark:text-slate-300'" :aria-expanded="isOpen || openedWithKeyboard">
              <svg class="-ms-0.5 me-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/>
              </svg>
              Status
              <svg class="-me-0.5 ms-2 size-4" x-bind:class="{ 'rotate-180': isOpen }" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m6 9 6 6 6-6"/>
              </svg>
            </button>

            <div x-cloak x-show="isOpen || openedWithKeyboard" x-transition x-trap="openedWithKeyboard" @click.outside="isOpen = false, openedWithKeyboard = false" @keydown.down.prevent="$focus.wrap().next()" @keydown.up.prevent="$focus.wrap().previous()" class="absolute z-40 top-11 left-0 flex min-w-[12rem] flex-col overflow-hidden rounded-md border border-slate-300 bg-slate-50 p-1 dark:border-slate-700 dark:bg-slate-900" role="menu">
              @foreach($cartStatusFilters as $cartStatus)
                <label wire:key="cart-status-{{ $cartStatus['value'] }}" class="relative cursor-pointer flex items-center py-2 px-3 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                  <div class="flex items-center h-5">
                    <input id="cart-status-{{ $cartStatus['value'] }}" name="cart-status" wire:model.live="cartStatus" value="{{ $cartStatus['value'] }}" type="radio" class="shrink-0 border-slate-200 rounded-full text-primary-600 focus:ring-primary-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-800 dark:border-slate-700 dark:checked:bg-primary-500 dark:checked:border-primary-500 dark:focus:ring-offset-slate-800" aria-describedby="cart-status-{{ $cartStatus['value'] }}">
                  </div>
                  <div class="ms-3.5">
                    <span class="block text-sm font-semibold text-slate-800 dark:text-slate-300 cursor-pointer">{{ $cartStatus['name'] }}</span>
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
      <div class="min-w-0 flex-1 border bg-white p-6 rounded-lg shadow-smooth">
        @if(!empty($carts) && count($carts) > 0)
          <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-slate-500 dark:text-slate-400">
              <thead class="text-xs text-slate-700 uppercase bg-slate-100 rounded-md dark:bg-slate-700 dark:text-slate-400">
              <tr>
                <th scope="col" class="px-6 py-3">
                  Cart ID
                </th>
                <th scope="col" class="px-6 py-3">
                  Total Produk
                </th>
                <th scope="col" class="px-6 py-3">
                  Total Harga
                </th>
                <th scope="col" class="px-6 py-3">
                  Methode Pembayaran
                </th>
                <th scope="col" class="px-6 py-3">
                  Status Pembayaran
                </th>
                <th scope="col" class="px-6 py-3">
                  Status
                </th>
                <th scope="col" class="px-6 py-3">
                  Aksi
                </th>
              </tr>
              </thead>
              <tbody>
              @foreach($carts as $cart)
                <tr wire:key="{{ $cart->id }}" class="bg-white dark:bg-slate-800">
                  <th scope="row" class="px-6 py-4">
                    {{ "CT".Str::of($cart->id)->padLeft(5, '0') }}
                  </th>
                  <th scope="row" class="px-6 py-4">
                    {{ $cart->total_product }} {{ Str::plural('item', $cart->total_product) }}
                  </th>
                  <td class="px-6 py-4">
                    {{ Number::currency($cart->total_price, 'IDR', 'id') }}
                  </td>
                  <td class="px-6 py-4">
                    @switch($cart->payment_method)
                      @case(\App\Constant::CART_PAYMENT_METHOD_CASH)
                        <div class="inline-flex bg-primary-100 text-primary-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-primary-400 border border-primary-400">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                          </svg>
                          <span>Bayar Langsung</span>
                        </div>
                        @break
                      @case(\App\Constant::CART_PAYMENT_METHOD_TRANSFER)
                        <div class="inline-flex bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/>
                          </svg>
                          <span>Transfer Bank</span>
                        </div>
                        @break
                    @endswitch
                  </td>
                  <td class="px-6 py-4">
                    @switch($cart->payment_state)
                      @case(\App\Constant::CART_PAYMENT_STATUS_PENDING)
                        <div class="inline-flex bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                          </svg>
                          <span>Tertunda</span>
                        </div>
                        @break
                      @case(\App\Constant::CART_PAYMENT_STATUS_SUCCESS)
                        <div class="inline-flex bg-emerald-100 text-emerald-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-emerald-400 border border-emerald-400">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"/>
                          </svg>
                          <span>Berhasil</span>
                        </div>
                        @break
                      @case(\App\Constant::CART_PAYMENT_STATUS_FAILED)
                        <div class="inline-flex bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                          </svg>
                          <span>Gagal</span>
                        </div>
                        @break
                    @endswitch
                  </td>
                  <td class="px-6 py-4">
                    @switch($cart->state)
                      @case(\App\Constant::CART_STATUS_NEW)
                        <div class="inline-flex bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/>
                          </svg>
                          <span>Pesanan Baru</span>
                        </div>
                        @break
                      @case(\App\Constant::CART_STATUS_PROCESSING)
                        <div class="inline-flex bg-primary-100 text-primary-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-primary-400 border border-primary-400">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                          </svg>
                          <span>Diproses</span>
                        </div>
                        @break
                      @case(\App\Constant::CART_STATUS_COMPLETED)
                        <div class="inline-flex bg-emerald-100 text-emerald-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-emerald-400 border border-emerald-400">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"/>
                          </svg>
                          <span>Berhasil</span>
                        </div>
                        @break
                      @case(\App\Constant::CART_STATUS_CANCELED)
                        <div class="inline-flex bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                          </svg>
                          <span>Gagal</span>
                        </div>
                        @break
                    @endswitch
                  </td>
                  <td class="px-6 py-4">
                    <button type="button" wire:click.prevent="remove({{ $cart->product_id }})" class="p-2 text-sm flex items-center justify-center font-medium text-slate-900 focus:outline-none bg-white rounded-lg border border-slate-200 hover:bg-slate-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-slate-100 dark:focus:ring-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:border-slate-600 dark:hover:text-white dark:hover:bg-slate-700 transition-colors duration-300">
                      <svg wire:loading.remove wire:target="remove({{ $cart->product_id }})" class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"></path>
                      </svg>
                      <span wire:loading wire:target="remove({{ $cart->product_id }})" class="animate-spin inline-block size-5 border-2 border-current border-t-transparent text-primary-600 rounded-full" role="status" aria-label="loading">
                          <span class="sr-only">Loading...</span>
                        </span>
                    </button>
                  </td>
                </tr>
              </tbody>
              @endforeach
            </table>
          </div>
        @else
          <x-empty-state message="Opps! Riwayat anda kosong."/>
        @endif
      </div>
      @if(!empty($carts) && count($carts) > 0)
        <div class="max-w-48 mt-10 mx-auto">
          {{ $carts->links() }}
        </div>
      @endif
    </div>
  </section>
</main>

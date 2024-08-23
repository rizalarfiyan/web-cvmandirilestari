<main class="w-full min-h-[calc(100dvh_-_228px)]">
  <section class="py-8 md:py-16">
    <x-heading-title title="Keranjang" description="Anda dapat membeli sesuai keranjang yang tersedia."/>
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <div class="lg:flex lg:items-start lg:gap-4">
        <div class="min-w-0 flex-1 border bg-white p-6 rounded-lg shadow-smooth">
          @if(!empty($carts) && count($carts) > 0)
            <div class="relative overflow-x-auto">
              <table class="w-full text-sm text-left rtl:text-right text-slate-500 dark:text-slate-400">
                <thead class="text-xs text-slate-700 uppercase bg-slate-100 rounded-md dark:bg-slate-700 dark:text-slate-400">
                <tr>
                  <th scope="col" class="px-6 py-3">
                    Gambar
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Produk
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Harga
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Jumlah
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Total
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Aksi
                  </th>
                </tr>
                </thead>
                <tbody>
                @foreach($carts as $cart)
                  <tr wire:key="{{ $cart->product_id }}" class="bg-white dark:bg-slate-800">
                    <th scope="row" class="px-6 py-4">
                      <div class="w-full h-auto aspect-[4/3] rounded-md overflow-hidden max-w-32">
                        <img class="w-full h-auto object-cover" src="{{ asset('/storage/'.$cart->image) }}" alt="{{ $cart->name }}">
                      </div>
                    </th>
                    <th scope="row" class="px-6 py-4 font-semibold text-slate-900 whitespace-nowrap dark:text-white underline decoration-primary-600 underline-offset-2">
                      <a wire:navigate href="/products/{{ $cart->slug }}">
                        {{ $cart->name }}
                      </a>
                    </th>
                    <td class="px-6 py-4">
                      {{ Number::currency($cart->unit_price, 'IDR', 'id') }}
                    </td>
                    <td class="px-6 py-4">
                      <div class="relative flex items-center max-w-[6rem]">
                        <button wire:loading.attr="disabled" wire:click.prevent="decrement({{ $cart->product_id }})" type="button" class="bg-slate-100 dark:bg-slate-700 dark:hover:bg-slate-600 dark:border-slate-600 hover:bg-slate-200 border border-slate-300 rounded-s-lg p-2 h-8 focus:ring-slate-100 dark:focus:ring-slate-700 focus:ring-2 focus:outline-none">
                          <svg class="w-3 h-3 text-slate-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                          </svg>
                        </button>
                        <input type="text" value="{{ $cart->quantity }}" class="bg-slate-50 border-x-0 border-slate-300 h-8 text-center text-slate-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled/>
                        <button wire:loading.attr="disabled" {{ $cart->quantity === \App\Constant::MAX_PRODUCT ? 'disabled' : '' }} wire:click.prevent="increment({{ $cart->product_id }})" type="button" class="bg-slate-100 dark:bg-slate-700 dark:hover:bg-slate-600 dark:border-slate-600 hover:bg-slate-200 border border-slate-300 rounded-e-lg p-2 h-8 focus:ring-slate-100 dark:focus:ring-slate-700 focus:ring-2 focus:outline-none">
                          <svg class="w-3 h-3 text-slate-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                          </svg>
                        </button>
                      </div>
                    </td>
                    <td class="px-6 py-4">
                      {{ Number::currency($cart->total_price, 'IDR', 'id') }}
                    </td>
                    <td class="px-6 py-4">
                      <button type="button" wire:click.prevent="remove({{ $cart->product_id }})" class="p-2 text-sm flex items-center justify-center font-medium text-slate-900 focus:outline-none bg-white rounded-lg border border-slate-200 hover:bg-slate-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-slate-100 dark:focus:ring-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:border-slate-600 dark:hover:text-white dark:hover:bg-slate-700 transition-colors duration-300">
                        <svg wire:loading.remove wire:target="remove({{ $cart->product_id }})" class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                          <path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"></path>
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
            <x-empty-state message="Opps! Keranjang anda kosong."/>
          @endif
        </div>

        <div class="mt-6 w-full space-y-6 sm:mt-8 lg:mt-0 lg:max-w-xs border bg-white p-6 rounded-lg shadow-smooth">
          <div class="flow-root">
            <div class="-my-3 divide-y divide-slate-200 dark:divide-slate-800">
              <dl class="flex items-center justify-between gap-4 py-3">
                <dt class="text-base font-normal text-slate-500 dark:text-slate-400">Subtotal</dt>
                <dd class="text-base font-medium text-slate-900 dark:text-white">
                  {{ Number::currency($totalPrice, 'IDR', 'id') }}
                </dd>
              </dl>
              <dl class="flex items-center justify-between gap-4 py-3">
                <dt class="text-base font-normal text-slate-500 dark:text-slate-400">Biaya Admin</dt>
                <dd class="text-base font-medium text-slate-900 dark:text-white">
                  {{ Number::currency(0, 'IDR', 'id') }}
                </dd>
              </dl>
              <dl class="flex items-center justify-between gap-4 py-3">
                <dt class="text-base font-bold text-slate-900 dark:text-white">Total</dt>
                <dd class="text-base font-bold text-slate-900 dark:text-white">
                  {{ Number::currency($totalPrice, 'IDR', 'id') }}
                </dd>
              </dl>
            </div>
          </div>
          @if(!empty($carts) && count($carts) > 0)
            <div class="space-y-3">
              <button type="button" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 transition-colors duration-300 disabled:cursor-not-allowed" {{ !(auth()->check() && auth()->user()->can('customer')) ? "disabled" : "" }}>
                Bayar
              </button>
              @if(!auth()->check())
                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">
                  <span>Jika anda ingin checkout, silahkan </span>
                  <a wire:navigate href="/login" title="" class="font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                    Masuk atau Daftar
                  </a>
                </p>
              @endif
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>
</main>

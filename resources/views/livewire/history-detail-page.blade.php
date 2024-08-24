<main class="w-full min-h-[calc(100dvh_-_228px)]">
  <section class="py-8 md:py-16">
    @php
      $headingTitle = "Riwayat CT".Str::of($cart->id)->padLeft(5, '0');
      $description = "Anda membeli seluruh produk pada ". $cart->created_at->format('d-m-Y H:i:s');
    @endphp
    <x-heading-title :title="$headingTitle" :description="$description"/>
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <div class="lg:flex lg:items-start lg:gap-4">
        <div class="min-w-0 flex-1 space-y-4">
          <div class="border bg-white p-6 rounded-lg shadow-smooth relative overflow-x-auto">
            <div class="relative overflow-x-auto">
              <table class="w-full text-left text-slate-900 dark:text-white">
                <tbody>
                <tr>
                  <th scope="row" class="whitespace-nowrap min-w-40">
                    Tanggal Pesanan
                  </th>
                  <td class="p-2 w-2">
                    :
                  </td>
                  <td class="p-2 w-full">
                    {{ $cart->created_at->format('d-m-Y H:i:s') }}
                  </td>
                </tr>
                <tr>
                  <th scope="row" class="whitespace-nowrap min-w-40">
                    Metode Pembayaran
                  </th>
                  <td class="p-2 w-2">
                    :
                  </td>
                  <td class="p-2 w-full">
                    @switch($cart->payment_method)
                      @case(\App\Constant::CART_PAYMENT_METHOD_CASH)
                        <div class="inline-flex bg-primary-100 text-primary-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-slate-700 dark:text-primary-400 border border-primary-400">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                          </svg>
                          <span>Bayar Langsung</span>
                        </div>
                        @break
                      @case(\App\Constant::CART_PAYMENT_METHOD_TRANSFER)
                        <div class="inline-flex bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-slate-700 dark:text-blue-400 border border-blue-400">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/>
                          </svg>
                          <span>Transfer Bank</span>
                        </div>
                        @break
                    @endswitch
                  </td>
                </tr>
                <tr>
                  <th scope="row" class="whitespace-nowrap min-w-40">
                    Status Pembayaran
                  </th>
                  <td class="p-2 w-2">
                    :
                  </td>
                  <td class="p-2 w-full">
                    @switch($cart->payment_state)
                      @case(\App\Constant::CART_PAYMENT_STATUS_PENDING)
                        <div class="inline-flex bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-slate-700 dark:text-blue-400 border border-blue-400">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                          </svg>
                          <span>Tertunda</span>
                        </div>
                        @break
                      @case(\App\Constant::CART_PAYMENT_STATUS_SUCCESS)
                        <div class="inline-flex bg-emerald-100 text-emerald-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-slate-700 dark:text-emerald-400 border border-emerald-400">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"/>
                          </svg>
                          <span>Berhasil</span>
                        </div>
                        @break
                      @case(\App\Constant::CART_PAYMENT_STATUS_FAILED)
                        <div class="inline-flex bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-slate-700 dark:text-red-400 border border-red-400">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                          </svg>
                          <span>Gagal</span>
                        </div>
                        @break
                    @endswitch
                  </td>
                </tr>
                <tr>
                  <th scope="row" class="whitespace-nowrap min-w-40">
                    Status
                  </th>
                  <td class="p-2 w-2">
                    :
                  </td>
                  <td class="p-2 w-full">
                    @switch($cart->state)
                      @case(\App\Constant::CART_STATUS_NEW)
                        <div class="inline-flex bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-slate-700 dark:text-blue-400 border border-blue-400">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/>
                          </svg>
                          <span>Pesanan Baru</span>
                        </div>
                        @break
                      @case(\App\Constant::CART_STATUS_PROCESSING)
                        <div class="inline-flex bg-primary-100 text-primary-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-slate-700 dark:text-primary-400 border border-primary-400">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                          </svg>
                          <span>Diproses</span>
                        </div>
                        @break
                      @case(\App\Constant::CART_STATUS_COMPLETED)
                        <div class="inline-flex bg-emerald-100 text-emerald-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-slate-700 dark:text-emerald-400 border border-emerald-400">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"/>
                          </svg>
                          <span>Berhasil</span>
                        </div>
                        @break
                      @case(\App\Constant::CART_STATUS_CANCELED)
                        <div class="inline-flex bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-slate-700 dark:text-red-400 border border-red-400">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                          </svg>
                          <span>Gagal</span>
                        </div>
                        @break
                    @endswitch
                  </td>
                </tr>
                <tr>
                  <th scope="row" class="whitespace-nowrap min-w-40">
                    Catatan
                  </th>
                  <td class="p-2 w-2">
                    :
                  </td>
                  <td class="p-2 w-full">
                    <div class="prose max-w-full">
                      {!! $cart->notes ?? '-' !!}
                    </div>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
          @if(!empty($cart->items) && count($cart->items) > 0)
            <div class="border bg-white p-6 rounded-lg shadow-smooth relative overflow-x-auto">
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
                </tr>
                </thead>
                <tbody>
                @foreach($cart->items as $item)
                  <tr wire:key="{{ $item->id }}" class="bg-white dark:bg-slate-800">
                    <th scope="row" class="px-6 py-4">
                      <div class="w-full h-auto aspect-[4/3] rounded-md overflow-hidden max-w-32">
                        @if(count($item->product->images) > 0)
                          <img class="w-full h-auto object-cover" src="{{ asset('/storage/'.$item->product->images[0]) }}" alt="{{ $item->product->name }}">
                        @endif
                      </div>
                    </th>
                    <th scope="row" class="px-6 py-4 font-semibold text-slate-900 whitespace-nowrap dark:text-white underline decoration-primary-600 underline-offset-2">
                      <a wire:navigate href="/products/{{ $item->product->slug }}">
                        {{ $item->product->name }}
                      </a>
                    </th>
                    <td class="px-6 py-4">
                      {{ Number::currency($item->unit_price, 'IDR', 'id') }}
                    </td>
                    <td class="px-6 py-4">
                      {{ $item->quantity }}
                    </td>
                    <td class="px-6 py-4">
                      {{ Number::currency($cart->total_price, 'IDR', 'id') }}
                    </td>
                  </tr>
                </tbody>
                @endforeach
              </table>
            </div>
          @endif
        </div>


        <div class="mt-6 w-full space-y-6 sm:mt-8 lg:mt-0 lg:max-w-xs border bg-white p-6 rounded-lg shadow-smooth">
          <div class="flow-root">
            <div class="-my-3 divide-y divide-slate-200 dark:divide-slate-800">
              <dl class="flex items-center justify-between gap-4 py-3">
                <dt class="text-base font-normal text-slate-500 dark:text-slate-400">Subtotal</dt>
                <dd class="text-base font-medium text-slate-900 dark:text-white">
                  {{ Number::currency($cart->total_price, 'IDR', 'id') }}
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
                  {{ Number::currency($cart->total_price, 'IDR', 'id') }}
                </dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<div wire:ignore.self x-data="{modalIsOpen: false}">
  <button @click="modalIsOpen = true" type="button" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 transition-colors duration-300 disabled:cursor-not-allowed" {{ !(auth()->check() && auth()->user()->can('customer')) ? "disabled" : "" }}>
    Bayar
  </button>

  <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen" class="fixed inset-0 z-[100] flex items-end justify-center bg-black/20 p-4 pb-8 sm:items-center lg:p-8" role="dialog" aria-modal="true" aria-labelledby="Modal Pembayaran">
    <div x-show="modalIsOpen" x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity" x-transition:enter-start="opacity-0 -translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-md border border-slate-300 bg-white text-slate-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300">
      <div class="flex justify-between items-center py-3 px-4 border-b dark:border-slate-700">
        <h3 class="font-bold text-slate-800 dark:text-white">
          Pembayaran
        </h3>
      </div>
      <form class="p-4 overflow-y-auto" x-on:close-modal.window="modalIsOpen = false" wire:submit.prevent="submit">
        <div class="space-y-4">
          <div class="space-y-1">
            <div class="block mb-2 text-sm font-bold text-slate-900 dark:text-white">Methode Pembayaran</div>
            <ul class="grid w-full gap-4 md:grid-cols-2">
              @foreach($paymentMethods as $method)
                <li wire:key="{{ $method['value'] }}">
                  <input wire:model="paymentMethod" type="radio" id="{{ $method['value'] }}" value="{{ $method['value'] }}" class="hidden peer" required/>
                  <label for="{{ $method['value'] }}" class="inline-flex flex-col space-y-1 w-full p-5 text-slate-500 bg-white border border-slate-200 rounded-lg cursor-pointer dark:hover:text-slate-300 dark:border-slate-700 dark:peer-checked:text-primary-500 peer-checked:border-primary-600 peer-checked:text-primary-600 hover:text-slate-600 hover:bg-slate-100 dark:text-slate-400 dark:bg-slate-800 dark:hover:bg-slate-700">
                    <div class="w-full text-lg font-semibold">{{ $method['name'] }}</div>
                    <div class="w-full text-sm">
                      {!! $method['description'] !!}
                    </div>
                  </label>
                </li>
              @endforeach
            </ul>
            @error('paymentMethod')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">
              {{ $message }}
            </p>
            @enderror
          </div>
          <div class="space-y-1">
            <label for="message" class="block mb-2 text-sm font-bold text-slate-900 dark:text-white">Catatan</label>
            <textarea id="message" wire:model="notes" rows="4" class="block p-2.5 w-full text-sm @error('notes') bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror text-slate-900 bg-slate-50 rounded-lg border border-slate-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pesan anda di sini..."></textarea>
            @error('notes')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">
              {{ $message }}
            </p>
            @enderror
            <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
              Anda bisa menambahkan catatan tambahan untuk pesanan ini. Jika anda menggunakan metode pembayaran transfer
              bank, mohon untuk menuliskan bukti transfer anda.
            </p>
          </div>
          <div class="flex items-center justify-end rounded-b space-x-2 border-t border-slate-200 pt-4">
            <button @click="modalIsOpen = false" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-slate-900 focus:outline-none bg-white rounded-lg border border-slate-200 hover:bg-slate-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-slate-100 dark:focus:ring-slate-700 dark:bg-slate-800 dark:text-slate-400 dark:border-slate-600 dark:hover:text-white dark:hover:bg-slate-700">
              Batal
            </button>
            <button wire:click.prevent="save" type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
              Proses
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

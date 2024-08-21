<main class="w-full min-h-[calc(100dvh_-_228px)]">
  <section class="max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <div class="mx-auto max-w-lg space-y-2 text-center mb-16">
        <h2 class="font-semibold text-4xl tracking-tight text-slate-900 dark:text-slate-50">
          Kategori
        </h2>
        <p class="leading-tight text-slate-600">
          Anda bisa memilih kategori yang sesuai dengan kebutuhan. Kategori ini akan membantu Anda menemukan produk yang
          Anda cari.
        </p>
      </div>
      <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-4">
        @foreach($categories as $category)
          <a wire:navigate href="/categories/{{ $category->slug }}" wire:key="{{ $category->id }}" class="group border-2 mt-24 border-slate-200 hover:border-primary-500 flex flex-col bg-white shadow-smooth rounded-xl transition duration-300 dark:bg-slate-900 dark:border-slate-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-slate-600">
            <div class="p-4 md:p-5 text-center">
              <div class="mx-auto -mt-24 w-32 flex items-center justify-center px-5 pt-6 mb-8 rounded-t-full bg-white border-2 border-b-0 border-slate-200 transition-colors duration-300 group-hover:border-primary-500">
                <div class="size-20 -mb-6">
                  <img class="object-cover" src="{{ asset('/storage/'.$category->image) }}" alt="{{ $category->name }}">
                </div>
              </div>
              <h3 class="group-hover:text-primary-600 text-2xl items-center flex justify-center font-semibold text-slate-800 dark:group-hover:text-slate-400 dark:text-slate-240">
                {{ $category->name }}
              </h3>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </section>
</main>

<main class="w-full min-h-[calc(100dvh_-_228px)]">
  <section class="relative flex h-full w-full items-center bg-white text-center">
    <div class="w-full my-28 space-y-14 md:space-y-20">
      <div class="mx-auto w-full md:w-3/4 xl:w-1/2">
        <div class="mx-auto mb-8 flex flex-col items-center gap-2">
          <p class="scroll-m-20 font-semibold text-xl tracking-tight text-slate-900 dark:text-slate-50">
            Apa yang kami terapkan?
          </p>
          <div class="h-1 w-10 rounded bg-primary-600"></div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-quote mb-8 inline-block size-8 text-muted-foreground">
          <path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"></path>
          <path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"></path>
        </svg>
        <h1 class="scroll-m-20 font-extrabold tracking-tight text-slate-900 dark:text-slate-50 text-4xl leading-normal lg:text-5xl">
          Cintailah produk dalam negeri!
        </h1>
        <div class="mt-8 mb-6 inline-block h-1 w-10 rounded bg-primary-600"></div>
        <p class="text-slate-600">
          Dukung industri lokal dengan memilih produk dalam negeri yang tidak kalah berkualitas dibandingkan produk
          impor. Dengan membeli produk buatan Indonesia, Anda turut membantu pertumbuhan ekonomi, menciptakan lapangan
          kerja, dan memperkuat kesejahteraan masyarakat. Produk lokal menawarkan keunikan, kualitas, dan nilai yang
          berakar pada budaya dan tradisi kita. Mari cintai dan bangga menggunakan produk dalam negeri, karena setiap
          pembelian Anda adalah dukungan untuk masa depan bangsa!
        </p>
      </div>
    </div>
  </section>
  <section class="pt-10 pb-20">
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <x-heading-title title="Produk Kami" description="Kami sediakan produk berkualitas dan nyaman untuk anda."/>
      <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        @if(!empty($products) && count($products) > 0)
          <div class="mb-16 grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($products as $product)
              <x-card-product wire:key="{{ $product->id }}" :product="$product"/>
            @endforeach
          </div>
          <div class="mx-auto w-full text-center">
            <a wire:navigate href="/products" class="rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-medium text-slate-900 hover:bg-slate-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-slate-100 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-white dark:focus:ring-slate-700 transition-colors duration-300">
              Lebih banyak
            </a>
          </div>
        @else
          <x-empty-state message="Belum ada produk yang tersedia."/>
        @endif
      </div>
    </div>
  </section>
  <section class="bg-white pt-10 pb-20">
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <x-heading-title title="Kategori Kami" description="Kategori yang dapat membantu untuk mencari sesuai yang anda inginkan."/>
      <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        @if(!empty($categories) && count($categories) > 0)
          <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-4">
            @foreach($categories as $category)
              <x-card-category wire:key="{{ $category->id }}" :name="$category->name" :slug="$category->slug" :image="$category->image"/>
            @endforeach
          </div>
          <div class="mx-auto w-full text-center pt-20">
            <a wire:navigate href="/categories" class="rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-medium text-slate-900 hover:bg-slate-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-slate-100 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-white dark:focus:ring-slate-700 transition-colors duration-300">
              Lebih banyak
            </a>
          </div>
        @else
          <x-empty-state message="Belum ada kategori yang tersedia."/>
        @endif
      </div>
    </div>
  </section>
  <section class="relative w-full z-10 overflow-hidden py-20 lg:py-32">
    <div class="container mx-auto">
      <div class="relative overflow-hidden">
        <div class="-mx-4 flex flex-wrap items-stretch">
          <div class="w-full px-4 py-8">
            <div class="mx-auto flex max-w-4xl flex-col items-center gap-8">
              <div class="mx-auto min-w-full max-w-md space-y-4 text-center">
                <h2 class="scroll-m-20 font-extrabold text-4xl tracking-tight lg:text-5xl text-primary-600">
                  Belanja Mudah dengan Kami!
                </h2>
                <p class="text-muted-foreground text-lg leading-snug">
                  Nikmati pengalaman belanja yang praktis dan nyaman dengan e-commerce kami! Temukan berbagai produk
                  yang berkualitas, kami siap memenuhi segala kebutuhan Anda.
                </p>
              </div>
              @auth
                @can('customer')
                  <a wire:navigate href="/login" class="transition-colors duration-300 px-8 py-3 text-lg inline-flex items-center gap-x-2 font-semibold rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-slate-600">
                    Riwayat
                  </a>
                @endcan
                @can('admin')
                  <a wire:navigate href="/dashboard" class="transition-colors duration-300 px-8 py-3 text-lg inline-flex items-center gap-x-2 font-semibold rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-slate-600">
                    Dashboard
                  </a>
                @endcan
              @else
                <a wire:navigate href="/register" class="transition-colors duration-300 px-8 py-3 text-lg inline-flex items-center gap-x-2 font-semibold rounded-lg border border-transparent bg-primary-600 text-white hover:bg-primary-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-slate-600">
                  Daftar Sekarang
                </a>
              @endauth
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="text-secondary-600 dark:text-secondary-100">
        <span class="absolute top-0 left-0 h-full">
            <svg class="h-full" width="495" height="470" viewBox="0 0 495 470" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="55" cy="442" r="138" stroke="currentColor" stroke-opacity="0.04" stroke-width="50"></circle>
                <circle cx="446" r="39" stroke="currentColor" stroke-opacity="0.04" stroke-width="20"></circle>
                <path d="M245.406 137.609L233.985 94.9852L276.609 106.406L245.406 137.609Z" stroke="currentColor" stroke-opacity="0.08" stroke-width="12"></path>
            </svg>
        </span>
      <span class="absolute right-0 bottom-0 h-full">
            <svg class="h-full" width="493" height="470" viewBox="0 0 493 470" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="462" cy="5" r="138" stroke="currentColor" stroke-opacity="0.04" stroke-width="50"></circle>
                <circle cx="49" cy="470" r="39" stroke="currentColor" stroke-opacity="0.04" stroke-width="20"></circle>
                <path d="M222.393 226.701L272.808 213.192L259.299 263.607L222.393 226.701Z" stroke="currentColor" stroke-opacity="0.06" stroke-width="13"></path>
            </svg>
        </span>
    </div>
  </section>

</main>

<main class="bg-white min-h-[calc(100dvh_-_228px)] w-full">
  <section class="py-8 bg-white md:py-16 dark:bg-slate-900 antialiased">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
      <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
        <div class="shrink-0">
          <div x-data="{
    autoplayIntervalTime: 4000,
    slides: {!! $images !!},
    currentSlideIndex: 1,
    isPaused: false,
    autoplayInterval: null,
    previous() {
      if (this.currentSlideIndex > 1) {
        this.currentSlideIndex = this.currentSlideIndex - 1
      } else {
        this.currentSlideIndex = this.slides.length
      }
    },
    next() {
      if (this.currentSlideIndex < this.slides.length) {
        this.currentSlideIndex = this.currentSlideIndex + 1
      } else {
        this.currentSlideIndex = 1
      }
    },
    autoplay() {
      this.autoplayInterval = setInterval(() => {
        if (! this.isPaused) {
          this.next()
        }
      }, this.autoplayIntervalTime)
    },
    setAutoplayInterval(newIntervalTime) {
      clearInterval(this.autoplayInterval)
      this.autoplayIntervalTime = newIntervalTime
      this.autoplay()
    },
}" x-init="autoplay" class="relative w-full overflow-hidden">
            <div class="relative w-full h-auto object-cover aspect-[4/3] rounded-md overflow-hidden mb-2">
              <template x-for="(slide, index) in slides">
                <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0" x-transition.opacity.duration.1000ms>
                  <img class="absolute w-full h-full inset-0 object-cover text-neutral-600 dark:text-neutral-300" x-bind:src="slide" alt="{{ $product->name }}"/>
                </div>
              </template>
            </div>

            <div class="flex items-center justify-center gap-2" role="group" aria-label="slides">
              <template x-for="(slide, index) in slides">
                <img class="w-full h-auto object-cover aspect-[4/3] max-w-20 border-4 rounded-lg" x-on:click="(currentSlideIndex = index + 1), setAutoplayInterval(autoplayIntervalTime)" x-bind:class="[currentSlideIndex === index + 1 ? 'border-primary-500 cursor-default' : 'border-slate-100 cursor-pointer']" x-bind:aria-label="'slide ' + (index + 1)""
                x-bind:src="slide" alt="{{ $product->name }}" />
              </template>
            </div>
          </div>
        </div>

        <div class="mt-6 sm:mt-8 lg:mt-0">
          <h1 class="text-xl font-semibold text-slate-900 sm:text-2xl dark:text-white">
            {{ $product->name }}
          </h1>
          <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
            <p class="text-2xl font-extrabold text-slate-900 sm:text-3xl dark:text-white">
              {{ Number::currency($product->price, 'IDR', 'id')  }}
            </p>
          </div>

          <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
            @if($quantity > 0)
              <div class="relative flex items-center max-w-[8rem]">
                <button wire:loading.attr="disabled" wire:click.prevent="decrement" type="button" class="bg-slate-100 dark:bg-slate-700 dark:hover:bg-slate-600 dark:border-slate-600 hover:bg-slate-200 border border-slate-300 rounded-s-lg p-3 h-11 focus:ring-slate-100 dark:focus:ring-slate-700 focus:ring-2 focus:outline-none">
                  <svg class="w-3 h-3 text-slate-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                  </svg>
                </button>
                <input type="text" value="{{ $quantity }}" class="bg-slate-50 border-x-0 border-slate-300 h-11 text-center text-slate-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-slate-700 dark:border-slate-600 dark:placeholder-slate-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled/>
                <button wire:loading.attr="disabled" wire:click.prevent="increment" type="button" class="bg-slate-100 dark:bg-slate-700 dark:hover:bg-slate-600 dark:border-slate-600 hover:bg-slate-200 border border-slate-300 rounded-e-lg p-3 h-11 focus:ring-slate-100 dark:focus:ring-slate-700 focus:ring-2 focus:outline-none">
                  <svg class="w-3 h-3 text-slate-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                  </svg>
                </button>
              </div>
            @else
              <button
                type="button"
                wire:click.prevent="addToCart"
                class="text-white mt-4 sm:mt-0 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 transition-colors duration-300"
              >
                <div wire:loading wire:target="addToCart" class="flex items-center justify-center gap-3">
                  <span class="animate-spin inline-block size-4 border-2 border-current border-t-transparent text-white rounded-full" role="status" aria-label="loading">
                    <span class="sr-only">Loading...</span>
                  </span>
                  <span>Loading...</span>
                </div>
                <div wire:loading.remove wire:target="addToCart" class="flex items-center justify-center">
                  <svg
                    class="w-5 h-5 -ms-2 me-2"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    fill="none"
                    viewBox="0 0 24 24"
                  >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"
                  />
                </svg>
                Add to cart
                </div>
              </button>
            @endif
          </div>
          <hr class="my-6 md:my-8 border-slate-200 dark:border-slate-800"/>
          <div class="prose max-w-full">
            {!! $product->description !!}
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

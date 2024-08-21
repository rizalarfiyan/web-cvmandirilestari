@props(['name' => '', 'slug' => '', 'image' => ''])

<a wire:navigate href="/categories/{{ $slug }}" class="group border-2 mt-24 border-slate-200 hover:border-primary-500 flex flex-col bg-white shadow-smooth rounded-xl transition duration-300 dark:bg-slate-900 dark:border-slate-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-slate-600">
  <div class="p-4 md:p-5 text-center">
    <div class="mx-auto -mt-24 w-32 flex items-center justify-center px-5 pt-6 mb-8 rounded-t-full bg-white border-2 border-b-0 border-slate-200 transition-colors duration-300 group-hover:border-primary-500">
      <div class="size-20 -mb-6">
        <img class="object-cover" src="{{ asset('/storage/'.$image) }}" alt="{{ $name }}">
      </div>
    </div>
    <h3 class="group-hover:text-primary-600 text-2xl items-center flex justify-center font-semibold text-slate-800 dark:group-hover:text-slate-400 dark:text-slate-240">
      {{ $name }}
    </h3>
  </div>
</a>

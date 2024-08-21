@props([
  'icon' => '<svg class="size-12 mb-4 rounded-full bg-slate-100 p-3 dark:bg-slate-500/20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"></path></svg>',
  'message' => 'Tidak ada data.',
])

<div {{ $attributes->merge(['class' => 'min-h-60 flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-slate-700 dark:shadow-slate-700/70']) }}>
  <div class="flex flex-auto flex-col justify-center items-center p-4 md:p-5">
    {!! $icon !!}
    <p class="mt-2 text-slate-600 dark:text-slate-200">
      {{ $message }}
    </p>
  </div>
</div>

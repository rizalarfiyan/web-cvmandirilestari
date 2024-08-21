@props(['title' => 'Title here', 'description'])

<div {{ $attributes->class(['mx-auto max-w-lg space-y-2 text-center mb-16' => !$attributes->has('class')]) }}>
  <h2 class="font-semibold text-4xl tracking-tight text-slate-900 dark:text-slate-50">
    {{ $title }}
  </h2>
  @isset($description)
    <p class="leading-tight text-slate-600">
      {{ $description }}
    </p>
  @endisset
</div>

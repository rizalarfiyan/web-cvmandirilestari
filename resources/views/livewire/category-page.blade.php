<main class="w-full min-h-[calc(100dvh_-_228px)]">
  <section class="max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <x-heading-title title="Kategori" description="Anda bisa memilih kategori yang sesuai dengan kebutuhan. Kategori ini akan membantu Anda menemukan produk yang
          Anda cari."/>
      @if(!empty($categories) && count($categories) > 0)
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-4">
          @foreach($categories as $category)
            <x-card-category wire:key="{{ $category->id }}" :name="$category->name" :slug="$category->slug" :image="$category->image"/>
          @endforeach
        </div>
      @else
        <x-empty-state message="Belum ada kategori yang tersedia."/>
      @endif
    </div>
  </section>
</main>


    <div class="w-[30rem] mx-auto lg:w-[95rem]">
        @forelse ($this->posts as $post)
      <livewire:Post :post="$post" :wire:key="'post_'.$post->id"/>
        @empty
            <div class="max-w-2xl gap-8 mx-auto">
                {{__('Start Follwing Your Frends and Enjoy.')}}
            </div>
        @endforelse
    </div>
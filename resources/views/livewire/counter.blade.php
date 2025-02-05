<div>
 <h1 class="text-3xl">{{ $count }}</h1>
<button wire:click=" increment"class="bg-black text-white w-20 h-8">+</button>
<input wire:model.lazy="message" type="text">
<p>القيمة الحالية: {{$message}}</p>
</div>
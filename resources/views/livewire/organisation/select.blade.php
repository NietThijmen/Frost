<div class="grid grid-cols-3">
    @foreach($organisations as $organisation)
        <div>
            <h1>{{$organisation->name}}</h1>
            <flux:button wire:click="selectOrganisation('{{$organisation->id}}')">Select</flux:button>
        </div>
    @endforeach
</div>

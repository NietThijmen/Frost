<div>
    <h1>Create Organisation</h1>

    <form wire:submit="create">
        <flux:input.group>
            <flux:input wire:model="name" type="text" placeholder="Name"/>
            <flux:button type="submit">Create</flux:button>
        </flux:input.group>
    </form>
</div>

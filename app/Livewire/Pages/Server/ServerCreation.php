<?php

namespace App\Livewire\Pages\Server;

use App\Helper\Modules\ServerProvider;
use Livewire\Component;

class ServerCreation extends Component
{
    public $providers = [];
    public $provider = null;

    public $formData = [];
    public $validationData = [];
    public $formValues = [];

    public function mount()
    {
        $this->providers = array_keys(ServerProvider::GetProviders());
    }

    public function selectProvider($name)
    {
        $this->provider = $name;
        $this->formData = $this->getFormFields();
        $this->validationData = $this->getValidationData();
        $this->setupFormValues();
    }

    public function getFormFields(): array
    {
        $defaultFields = [
            'name' => [
                'label' => 'Name',
                'type' => 'text',
                'placeholder' => 'Name',
                'required' => true,
            ],
        ];

        $formFields = ServerProvider::GetProviders()[$this->provider]['formFields'];
        if(is_callable($formFields)) {
            $formFields = $formFields();
        }


        $fields =  array_merge($defaultFields, $formFields);


        return $fields;
    }

    public function getValidationData(): array
    {
        $defaultFields = [
            'name' => 'required|string',
        ];

        $provider = ServerProvider::GetProviders()[$this->provider];

        return array_merge($defaultFields, $provider['formRules']);
    }

    public function setupFormValues(): void
    {
        $this->formValues = [
            'name' => '',
        ];

        foreach ($this->formData as $key => $value) {
            $this->formValues[$key] = '';
        }
    }

    public function createServer()
    {
        try {
            \Validator::make($this->formValues, $this->validationData)->validate();
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }

        // create the server
        $class =ServerProvider::GetProviders()[$this->provider]['provider'];
        $provider = new $class();

        $provider->createServer(
            $this->formValues
        );
    }

    public function render()
    {
        return view('livewire.pages.server.server-creation');
    }
}

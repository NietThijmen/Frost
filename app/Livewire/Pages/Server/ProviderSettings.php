<?php

namespace App\Livewire\Pages\Server;

use App\Helper\Modules\ServerProviderSettings;
use Livewire\Component;

class ProviderSettings extends Component
{
    public $providers = [];
    public $provider = null;

    public $formData = [];
    public $validationData = [];
    public $formValues = [];

    public function mount()
    {
        $this->providers = array_keys(ServerProviderSettings::GetProviders());
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



        $formFields = ServerProviderSettings::GetProviders()[$this->provider]['formFields'];
        if(is_callable($formFields)) {
            $formFields = $formFields();
        }


        return $formFields;
    }

    public function getValidationData(): array
    {
        $provider = ServerProviderSettings::GetProviders()[$this->provider];
        return $provider['formRules'];
    }

    public function setupFormValues(): void
    {
        $this->formValues = [];

        foreach ($this->formData as $key => $value) {
            $this->formValues[$key] = '';
        }
    }

    public function saveSettings()
    {
        try {
            \Validator::make($this->formValues, $this->validationData)->validate();
        } catch (\Throwable $e) {
            dd($e->getMessage());
        }

        // create the server
        $onSave =ServerProviderSettings::GetProviders()[$this->provider]['onSave'];
        $onSave($this->formValues);
    }

    public function render()
    {
        return view('livewire.pages.server.provider-settings');
    }
}

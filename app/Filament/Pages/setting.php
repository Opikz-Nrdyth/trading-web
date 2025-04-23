<?php

namespace App\Filament\Pages;

use App\Models\setting as ModelsSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;

class setting extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Website';
    protected static string $view = 'filament.pages.setting';

    public $company_name;
    public $company_logo;
    public $min_wd;
    public $min_tf;
    public $fee;
    public $telegram;

    public $images;

    public function mount(): void
    {
        $settings = ModelsSetting::first();

        $this->images = $settings->company_logo;

        $this->company_logo = array();
        $this->company_name = $settings->company_name ?? '';
        $this->min_wd = $settings->min_wd ?? '';
        $this->min_tf = $settings->min_tf ?? '';
        $this->fee = $settings->fee ?? '';
        $this->telegram = $settings->telegram ?? '';
    }

    protected function getFormSchema(): array
    {
        return [
            FileUpload::make('company_logo')
                ->acceptedFileTypes(['image/jpeg', 'image/png'])
                ->maxSize(1024)
                ->directory('logos')
                ->visibility('public'),

            TextInput::make('company_name')->required(),
            TextInput::make('min_wd')->numeric()->required(),
            TextInput::make('min_tf')->numeric()->required(),
            TextInput::make('fee')->numeric()->required(),
            TextInput::make('telegram')->required()->rules(['max:255']),
        ];
    }

    public function submit()
    {
        try {
            $data = $this->form->getState();

            // Pastikan file logo dihandle dengan tepat
            if ($this->company_logo instanceof \Illuminate\Http\UploadedFile) {
                $logoPath = $this->company_logo->store('logos', 'public');
                $data['company_logo'] = $logoPath;
            } elseif (isset($data['company_logo']) && is_string($data['company_logo'])) {
                // Gunakan path yang sudah ada jika tidak ada file baru
                $data['company_logo'] = $data['company_logo'];
            } else {
                // Jika tidak ada file, set ke string kosong atau null
                $data['company_logo'] = $this->images;
            }

            ModelsSetting::updateOrCreate(
                ['id' => 1],
                [
                    'company_name' => $data['company_name'],
                    'company_logo' => $data['company_logo'],
                    'min_wd' => $data['min_wd'],
                    'min_tf' => $data['min_tf'],
                    'fee' => $data['fee'],
                    'telegram' => $data['telegram'],
                ]
            );

            session()->flash('success', 'Pengaturan berhasil diperbarui!');

            // return redirect()->to('admin/setting');
        } catch (\Exception $e) {
            dd($e);
        }
    }
}

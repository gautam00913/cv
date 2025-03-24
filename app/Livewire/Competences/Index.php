<?php

namespace App\Livewire\Competences;

use Livewire\Component;
use Filament\Forms\Form;
use App\Models\Competence;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use App\Models\CompetenceTitle;
use Livewire\Attributes\Computed;
use App\Models\CompetenceSubTitle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class Index extends Component implements HasForms
{
    use InteractsWithForms;
    public Competence $competence;
    public bool $editMode = false;

    #[Url(as: 'cat')]
    public int $index = 0;

    public ?array $data = [];

    #[Computed(persist: true)]
    public function competences()
    {
        return Competence::with(['competenceTitle', 'competenceSubTitle'])
                        ->where('profile_id', auth()->user()->profile->id)
                        ->get()
                        ->groupBy(['competence_title_id']);
    }

    public function mount()
    {
        $this->competence = new Competence();
        $this->form->fill();
    }

    public function form(Form $form) : Form
    {
        return $form->schema([
            Select::make('competence_title_id')
            ->relationship('competenceTitle', 'name')
            ->label("Compétence en:")
            ->required(),
            Select::make('competence_sub_title_id')
                    ->relationship('competenceSubTitle', 'name')
                    ->label("Sous catégorie"),
            TextInput::make('tag')->required()->placeholder("PHP"),
            Toggle::make('other_competence')->label("Il s'agit d'une autre compétence")
        ])
        ->statePath('data')
        ->model($this->competence);
    }

    public function showCategory($category){
        $this->index = $category;
    }

    public function editCompetence($id){
        $competence = Competence::findOrFail($id);
        $this->competence = $competence;
        $this->editMode = true;
        $this->form->fill($this->competence->toArray());
    }

    #[On('delete-competence')]
    public function delete(string $what, int $id)
    {
        if($what == 'title')
        {
            $title = CompetenceTitle::find($id);
            $done = $title->delete();
            if($done)
            {
                $this->dispatch('close-delete-modal');
                Notification::make()
                            ->title("Catégorie de compétence suprimée avec succès")
                            ->success()
                            ->send();
            }
        }
        elseif($what == 'subtitle')
        {
            $subtitle = CompetenceSubTitle::find($id);
            $done = $subtitle->delete();
            if($done)
            {
                $this->dispatch('close-delete-modal');
                Notification::make()
                            ->title("Sous catégorie de compétence suprimée avec succès")
                            ->success()
                            ->send();
            }
        }
        elseif($what == 'competence')
        {
            $competence = Competence::find($id);
            $done = $competence->delete();
            if($done)
            {
                $this->dispatch('close-delete-modal');
                Notification::make()
                            ->title("Compétence suprimée avec succès")
                            ->success()
                            ->send();
            }
        }
        $this->refresh();
    }

    public function submit()
    {
        if($this->editMode)
        {
            $done = $this->competence->update($this->form->getState());
            if($done){
                $this->editMode = false;
                Notification::make()
                            ->title("Mise à jour éffectuée avec succès")
                            ->success()
                            ->send();
            }
        }else{
            $done = auth()->user()->profile->competences()->create($this->form->getState());
            if($done)
                Notification::make()
                            ->title("Compétence ajoutée avec succès")
                            ->success()
                            ->send();
        }
        
        $this->form->fill();
        $this->refresh();
    }

    public function render()
    {
        if($this->index && $this->competences->has($this->index))
            $group_competences = $this->competences->get($this->index);
        else
            $group_competences = $this->competences->first();

        return view('livewire.competences.index', [
            'group_competences' => $group_competences,
            'group' => $group_competences->first(),
        ]);
    }

    private function refresh()
    {
        unset($this->competences);
    }
}

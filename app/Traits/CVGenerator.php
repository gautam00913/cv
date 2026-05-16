<?php
namespace App\Traits;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

trait CVGenerator
{
    public function generateCV(int $user_id)
    {
        $profile = User::findOrFail($user_id)->profile()->with(['experiences.company', 'experiences.jobTitle', 'competences.competenceTitle', 'educations'])->first();
        $pdf = Pdf::loadView('pdf.cv_template', [
            'profile' => $profile,
            'portfolios_count' => $profile->portfolios->count(),
            'competences_count' => $profile->competences->count(),
            ])
            ->setPaper('a4', 'portrait');
        return [
            'pdf' => $pdf,
            'name' => 'cv-' . str_replace(' ', '_', $profile->user->name) . '.pdf'
        ];
    }
}
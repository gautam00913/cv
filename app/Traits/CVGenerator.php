<?php
namespace App\Traits;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

trait CVGenerator
{
    public function generateCV(int $user_id)
    {
        $profile = User::findOrFail($user_id)->profile()->with(['experiences', 'competences', 'educations'])->first();
        $pdf = Pdf::loadView('pdf.cv_template', ['profile' => $profile])
            ->setPaper('a4', 'portrait');
        return [
            'pdf' => $pdf,
            'name' => 'cv-' . str_replace(' ', '_', $profile->user->name) . '.pdf'
        ];
    }
}
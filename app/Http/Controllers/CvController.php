<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\CVGenerator;

class CvController extends Controller
{
    use CVGenerator;

    public function download()
    {
        $user = User::firstOrFail();

        ['pdf' => $pdf, 'name' => $name] = $this->generateCV($user->id);

        return $pdf->download($name);
    }
}
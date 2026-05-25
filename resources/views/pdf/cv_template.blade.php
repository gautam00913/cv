<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>CV - <?= $profile->user->name ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            margin: 0;
            size: A4;
            sheet-size: A4;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10pt;
            line-height: 1.3;
            color: #333;
            margin: 8mm;
            width: 190mm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
        }

        .text-primary { color: #009688; }
        .text-dark { color: #333; }
        .text-gray { color: #666; }

        /* Header */
        .header {
            margin-bottom: 15px;
        }

        .header h1 {
            font-size: 24pt;
            color: #009688;
            margin-bottom: 3px;
        }

        .header .job-title {
            font-size: 12pt;
            color: #666;
        }

        /* Layout */
        .sidebar {
            width: 62mm;
            padding-right: 12px;
            vertical-align: top;
        }

        .main-content {
            width: 113mm;
            padding-left: 12px;
            vertical-align: top;
        }

        /* Photo */
        .photo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 5px;
            background: #e0f2f1;
        }

        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Sections */
        .section {
            margin-bottom: 12px;
        }

        .section-title {
            font-size: 11pt;
            font-weight: bold;
            color: #009688;
            border-bottom: 2px solid #009688;
            padding-bottom: 3px;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        /* Contact */
        .contact-info {
            margin-bottom: 12px;
        }

        .contact-row {
            margin-bottom: 5px;
            font-size: 9pt;
        }

        .contact-label {
            color: #009688;
            font-weight: bold;
            width: 18mm;
            display: inline-block;
        }

        /* Skills */
        .skills-container {
            margin-bottom: 5px;
        }
        .skills-container h4 {
            text-decoration: underline;
            font-style: italic;
            color: #888888;
            font-weight: 700;
            font-size: 8pt;
            margin-bottom: 0.5rem;
        }

        .skills-item {
            display: inline-block;
            background: #e0f2f1;
            color: #00796b;
            padding: 4px 8px;
            margin: 0.25rem;
            border-radius: 3px;
            font-size: 8pt;
        }

        /* Experience */
        .experience-item {
            margin-bottom: 10px;
        }

        .experience-item h4 {
            font-size: 10pt;
            color: #333;
            margin-bottom: 2px;
        }

        .experience-item .company {
            font-size: 9pt;
            color: #009688;
            font-style: italic;
        }

        .experience-item .date {
            font-size: 8pt;
            color: #666;
        }

        .experience-item .description {
            font-size: 9pt;
            text-align: justify;
            margin-top: 3px;
        }

        /* Education */
        .education-item {
            margin-bottom: 8px;
        }

        .education-item h4 {
            font-size: 10pt;
            color: #333;
        }

        .education-item .school {
            font-size: 9pt;
            color: #666;
        }

        .education-item .year {
            font-size: 8pt;
            color: #009688;
        }

        /* Portfolio */
        .portfolio-item {
            margin-bottom: 1.3rem;
            padding: 6px;
            background: #f5f5f5;
            border-left: 3px solid #009688;
        }

        .portfolio-item h4 {
            font-size: 9pt;
            color: #333;
            margin-bottom: 2px;
        }

        .portfolio-item p {
            font-size: 8pt;
            color: #666;
        }

        .next-page {
            page-break-before: always;
        }

        /* Profile */
        .profile-text {
            font-size: 9pt;
            text-align: justify;
            line-height: 1.4;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8pt;
            color: #999;
            padding: 5mm;
        }
    </style>
</head>
<body>
    <div>
        <table>
            <tr>
                <!-- Left Column -->
                <td class="sidebar">
                    <!-- Photo -->
                    <div class="photo">
                        @if($profile->picture)
                            <img src="<?= storage_path('app/public/' . $profile->picture) ?>" alt="Photo">
                        @else
                            <img src="<?= public_path('images/avatar.png') ?>" alt="Photo">
                        @endif
                    </div>
                    <h3 style="text-align: center; margin-bottom: 8px;"><?= $profile->user->name ?></h3>
    
                    <!-- Contact -->
                    <div class="section">
                        <h3 class="section-title" style="font-size: 10pt;">Contact</h3>
                        <div class="contact-info">
                            @if($profile->user->email)
                                <div class="contact-row">
                                    <span class="contact-label">Email:</span>
                                    <a href="mailto:<?= $profile->user->email ?>" target="_blank" rel="noopener noreferrer" style="color: #333; text-decoration: none;"><?= $profile->user->email ?></a>
                                </div>
                            @endif
                            @if($profile->user->phone)
                                <div class="contact-row">
                                    <span class="contact-label">{{__('messages.cv_phone')}}:</span>
                                    <a href="tel:<?= $profile->user->phone ?>" target="_blank" rel="noopener noreferrer" style="color: #333; text-decoration: none;"><?= $profile->user->phone ?></a>
                                </div>
                            @endif
                        </div>
                    </div>
    
                    <!-- Skills -->
                    @if($competences_count > 0)
                        <div class="section">
                            <h3 class="section-title" style="font-size: 10pt;">{{ __('messages.competences') }}</h3>
                            @php
                                $competence_index = 0;
                            @endphp
                            @foreach($profile->competences->groupBy('competence_title_id') as $key => $competences)
                                @if ($competence_index < 50)
                                    <div class="skills-container">
                                        <h4><?= $competences->first()->competenceTitle->name ?></h4>
                                        <div>
                                            @foreach ($competences as $competence)
                                                @if ($competence_index < 50)
                                                    <p class="skills-item"><?= $competence->tag ?></p>
                                                @endif
                                                @php
                                                    $competence_index += 1;
                                                @endphp
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </td>
    
                <!-- Right Column -->
                <td class="main-content">
                    <!-- Profile -->
                    @if($profile->biography)
                        <div class="section">
                            <h3 class="section-title">{{ __('messages.profile') }}</h3>
                            <p class="profile-text"><?= Str::words($profile->biography, 50) ?></p>
                        </div>
                    @endif
    
                    <!-- Experience -->
                    @if($profile->experiences->count() > 0)
                        <div class="section">
                            <h3 class="section-title">{{ __('messages.experiences') }}</h3>
                            @foreach($profile->experiences->sortByDesc('started_at') as $experience)
                                @if ($loop->index < 6)
                                    <div class="experience-item">
                                        <h4><?= $experience->jobTitle->name ?></h4>
                                        <a class="company" @if($experience->company->website)href="<?= $experience->company->website ?>" target="_blank" rel="noopener noreferrer" @endif><?= $experience->company->name ?></a>
                                        <div class="date">
                                            <?= $experience->started_at->format('m/Y') ?> 
                                            @if($experience->current) {{ __('messages.to_today') }} @elseif($experience->finished_at) - <?= $experience->finished_at->format('m/Y') ?> @endif
                                        </div>
                                        @if($experience->description)
                                            <p class="description"><?= Str::words($experience->description, 100) ?></p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
    
                    <!-- Education -->
                    @if($profile->educations->count() > 0)
                        <div class="section">
                            <h3 class="section-title">{{ __('messages.education') }}</h3>
                            @foreach($profile->educations->sortByDesc('year') as $education)
                                @if ($loop->index < 4)
                                    <div class="education-item">
                                        <h4><?= $education->grade ?></h4>
                                        <div class="school"><?= Str::words($education->description, 50) ?></div>
                                        <div class="year"><?= $education->year ?></div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <!-- Page 2 -->
    @if($portfolios_count > 0 || $competences_count > 50)
        <div class="next-page">
            <table>
                <tr>
                    <!-- Left Column -->
                    @if($competences_count > 50)
                        <td class="sidebar">
                        <!-- Skills -->
                            <div class="section">
                                <h3 class="section-title" style="font-size: 10pt;">{{ __('messages.skills_continued') }}</h3>
                                @php
                                    $competence_index = 0;
                                @endphp
                                @foreach($profile->competences->slice(50)->groupBy('competence_title_id') as $key => $competences)
                                    @if ($competence_index < 50)
                                        <div class="skills-container">
                                            <h4><?= $competences->first()->competenceTitle->name ?></h4>
                                            <div>
                                                @foreach ($competences as $competence)
                                                    @if ($competence_index < 50)
                                                        <p class="skills-item"><?= $competence->tag ?></p>
                                                        @php
                                                            $competence_index += 1;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </td>
                    @endif
        
                    <!-- Right Column -->
                    <td class="main-content">
                        <!-- Portfolio -->
                        @if($portfolios_count > 0)
                            <div class="section">
                                <h3 class="section-title">{{ __('messages.portfolio') }}</h3>
                                @foreach($profile->portfolios as $key => $portfolio)
                                    @if ($key < 9)
                                        <table class="portfolio-item" cellpadding="0" cellspacing="0">
                                            <tr>
                                                @if($portfolio->picture)
                                                    <td valign="top" style="padding-right: 10px; padding-left: 10px;">
                                                        <img src="<?= storage_path('app/public/' . $portfolio->picture) ?>" alt="portfolio image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
                                                    </td>
                                                @endif
                                                <td valign="top">
                                                    <h4>
                                                        @if ($portfolio->link)
                                                            <a href="<?= $portfolio->link ?>" style="text-decoration: underline; color: #009688;" target="_blank" rel="noopener noreferrer"><?= $portfolio->title ?></a>
                                                        @else
                                                            <?= $portfolio->title ?>
                                                        @endif
                                                    </h4>
                                                    @if($portfolio->description)
                                                        <p><?= $portfolio->description ?></p>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        @if(app()->getLocale() == 'fr')
            CV généré le <?= now()->format('d/m/Y') ?> sur <a href="<?= route('home') ?>" style="text-decoration: underline; color: #009688;" target="_blank" rel="noopener noreferrer">mon portfolio en ligne</a>.
        @else
            CV generated on <?= now()->format('d/m/Y') ?> on <a href="<?= route('home') ?>" style="text-decoration: underline; color: #009688;" target="_blank" rel="noopener noreferrer">my online portfolio</a>.
        @endif
    </div>
</body>
</html>
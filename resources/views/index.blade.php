<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Portfolio') }} | Ryan Dhel S. Canja</title>
    <meta name="description" content="Ryan Dhel S. Canja portfolio: IT support, networking, and web development experience.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&family=Bebas+Neue&display=swap" rel="stylesheet">
    @viteReactRefresh
    @vite('resources/js/app.jsx')
</head>

<body>
    @php
        $cvFiles = glob(public_path('*.pdf')) ?: [];
        sort($cvFiles, SORT_NATURAL | SORT_FLAG_CASE);
        $cvPdf = !empty($cvFiles) ? basename($cvFiles[0]) : null;

        $portfolioProps = [
            'cvUrl' => $cvPdf ? asset($cvPdf) : null,
            'contactAction' => route('contact.store'),
            'csrfToken' => csrf_token(),
            'mailSuccess' => session('mail_success'),
            'mailError' => session('mail_error'),
            'validationError' => $errors->any() ? $errors->first() : null,
            'oldInput' => [
                'name' => old('name', ''),
                'email' => old('email', ''),
                'subject' => old('subject', ''),
                'message' => old('message', ''),
            ],
        ];
    @endphp

    <div id="app" data-props='@json($portfolioProps)'></div>

    <noscript>
        <div style="padding: 1rem; font-family: sans-serif;">
            This portfolio needs JavaScript enabled to load the React interface.
        </div>
    </noscript>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Vision & Mission | ThinQ Global School</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

<style>
body {
    background: #f0f4f8;
    font-family: 'Segoe UI', sans-serif;
    padding-top: 80px;
}
/* Hide Google Translate top banner */
body > .skiptranslate {
    display: none !important;
}


/* Header */
header {
    position: fixed;
    top: 0;
    width: 100%;
    background: #0d6efd;
    color: #fff;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 999;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

header h1 {
    margin: 0;
    font-size: 1.8rem;
}

/* Language dropdown */
.header-language select {
    border-radius: 50px;
    border: 1px solid #fff;
    padding: 5px 15px;
    background: #fff;
    color: #0d6efd;
    font-weight: 500;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    transition: all 0.3s;
}

.header-language select:hover {
    background-color: #0d6efd;
    color: #fff;
}

/* Page header */
.page-header {
    text-align: center;
    padding: 50px 20px 30px;
    background: linear-gradient(135deg, #0d6efd, #6610f2);
    color: #fff;
    border-radius: 10px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    margin-bottom: 40px;
}

.page-header h2 {
    font-size: 2.5rem;
    font-weight: bold;
}

.header-underline {
    width: 120px;
    height: 4px;
    background-color: #ffc107;
    margin: 15px auto 0;
    border-radius: 2px;
}

/* Content card */
#vision-mission-content {
    background: #fff;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    transition: transform 0.3s;
    margin-bottom: 50px;
}

#vision-mission-content:hover {
    transform: translateY(-5px);
}

#vision-mission-content h4 {
    color: #0d6efd;
    font-weight: 600;
    margin-bottom: 15px;
}

#vision-mission-content p {
    text-align: justify;
    color: #495057;
    line-height: 1.7;
}
</style>
</head>
<body>

<header>
    <h1>ThinQ Global School</h1>
    <div class="header-language">
        <select id="language-select">
            <option value="en" selected>English</option>
            <option value="fr">French</option>
            <option value="es">Spanish</option>
            <option value="de">German</option>
            <option value="hi">Hindi</option>
            <option value="it">Italian</option>
            <option value="ja">Japanese</option>
        </select>
    </div>
</header>

<!-- Google Translate hidden widget -->
<div id="google_translate_element" style="display:none;"></div>

<div class="container">

    <!-- Page Header -->
    <div class="page-header">
        <h2>Vision & Mission</h2>
        <div class="header-underline"></div>
    </div>

    <!-- Vision & Mission Content -->
    <div id="vision-mission-content">
        <h4>Vision</h4>
        <p>
            At ThinQ Global, we inspire and empower students to reach their fullest potential, equipping them with the knowledge, skills, and values to prepare them to face the challenges of the 21st century with confidence and strength of character.
        </p>
        <h4>Mission</h4>
        <p>
            The mission of ThinQ Global School is to create a nurturing learning environment that enables children to explore their full potential. To achieve this goal, we emphasize holistic development by offering multiple opportunities that foster academic, physical, emotional, social, and moral growth. ThinQ Global School celebrates diversity, encouraging students to embrace and accept the rich diversity while appreciating the common threads connecting individuals.
        </p>
    </div>

</div>

<!-- jQuery & Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Google Translate -->
<script>
function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'en,fr,es,de,it,hi,ja',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');
}

// Load Google Translate script
var gtScript = document.createElement('script');
gtScript.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
document.head.appendChild(gtScript);

// Function to set the language cookie and reload page
function setLanguage(lang) {
    document.cookie = "googtrans=/en/" + lang + ";path=/;domain=" + location.hostname;
    location.reload();
}

// Trigger when select changes
document.getElementById('language-select').addEventListener('change', function() {
    setLanguage(this.value);
});

// Optional: Set select dropdown based on cookie on load
function getCookie(name) {
    let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    if (match) return match[2];
    return null;
}

window.addEventListener('load', function() {
    let lang = getCookie('googtrans');
    if (lang) {
        let parts = lang.split('/');
        if (parts.length === 3) {
            let code = parts[2];
            let select = document.getElementById('language-select');
            for (let i=0; i<select.options.length; i++) {
                if (select.options[i].value === code) {
                    select.selectedIndex = i;
                    break;
                }
            }
        }
    }
});

window.addEventListener('load', function() {
    const skipBar = document.querySelector('.skiptranslate');
    if(skipBar) skipBar.style.display = 'none';
});

</script>

</body>
</html>
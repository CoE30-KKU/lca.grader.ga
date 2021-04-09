    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Webcustom -->
    <link rel="shortcut icon" href="../static/elements/logo/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../static/elements/logo/favicon.ico" type="image/x-icon">
    <link rel="icon" sizes="192x192" href="../static/elements/logo/logo_android192.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../static/elements/logo/logo_ios152.png">

    <?php $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
    <meta property="og:image" content="https://lca.grader.ga/static/elements/logo/logo.jpg" />
    <meta property="og:image:width" content="194" />
    <meta property="og:image:height" content="194" />
    <meta property="og:title" content="Grader.GA - LCA Edition" />
    <title>Grader.ga - LCA Edition</title>
    <meta property="og:description" content="The Computer Engineering of Khon Kaen University Student-Made grader." />
    <meta name="twitter:card" content="summary"></meta>
    <link rel="image_src" href="https://lca.grader.ga/static/elements/logo/logo.jpg" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo $current_url; ?>" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.p0nd.ga/bootstrap/bootstrap.min.css">
    <link href="https://cdn.p0nd.ga/mdbootstrap/mdb.min.css" rel="stylesheet">
    
    <!-- Custom Style -->
    <link href="../static/style.css" rel="stylesheet">
    <link href="../static/dark-mode.css" rel="stylesheet">
    <?php if (isDarkmode()) { ?>
        <link href="../static/dataTable-dark-mode.css" rel="stylesheet">
        <link href="../static/slider_darkmode.css" rel="stylesheet">
    <?php } else { ?>
        <link href="../static/slider.css" rel="stylesheet">
    <?php } ?>
    
    <!-- Bootstrap -->
    <script src="https://cdn.p0nd.ga/1.16.0-popper.min.js"></script>
    <script src="https://cdn.p0nd.ga/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.p0nd.ga/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.p0nd.ga/mdbootstrap/mdb.min.js"></script>

    <!-- Bootstrap-DateTimePicker-Table -->
    <link rel="stylesheet" href="https://cdn.p0nd.ga/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
    <script src="https://cdn.p0nd.ga/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>

    <!-- Bootstrap-Table -->
    <link href="https://cdn.p0nd.ga/dataTable/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.p0nd.ga/dataTable/jquery.dataTables.min.js"></script>

    <!-- Editor.MD -->
    <link rel="stylesheet" href="https://cdn.p0nd.ga/editor.md/css/editormd.css" />
    <script src="https://cdn.p0nd.ga/editor.md/editormd.min.js"></script>
    <script src="https://cdn.p0nd.ga/editor.md/languages/en.js"></script>

    <!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js) -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js"></script>
    
    <!-- SweetAlert -->
    <script src="https://cdn.p0nd.ga/sweetalert.min.js"></script>
    
    <!-- Croppie -->
    <link rel="stylesheet" href="https://cdn.p0nd.ga/croppie/croppie.css" />
    <script src="https://cdn.p0nd.ga/croppie/croppie.js"></script>

    <!-- Dropzone -->
    <link rel="stylesheet" href="https://cdn.p0nd.ga/dropzone/min/basic.min.css" />
    <link rel="stylesheet" href="https://cdn.p0nd.ga/dropzone/min/dropzone.min.css" />
    <script src="https://cdn.p0nd.ga/dropzone/dropzone.js"></script>
    
    <!-- Fontawesome -->
    <link href="https://cdn.p0nd.ga/fontawesome/css/all.min.css" rel="stylesheet" />

    <script src="https://tutsplus.github.io/syntax-highlighter-demos/highlighters/highlightjs/highlight.pack.js"></script>
    <link href="https://tutsplus.github.io/syntax-highlighter-demos/highlighters/highlightjs/styles/monokai_sublime.css" rel="stylesheet" type="text/css">

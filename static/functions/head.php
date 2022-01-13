    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Google Font -->
    <link rel="preconnect" href="//fonts.googleapis.com">
    <link rel="preconnect" href="//fonts.gstatic.com" crossorigin>
    <link href="//fonts.googleapis.com/css2?family=Kanit:wght@400;700&family=IBM+Plex+Sans+Thai:wght@500;700&family=Inter:wght@500;700&display=swap" rel="stylesheet">

    <!-- Webcustom -->
    <link rel="shortcut icon" href="../static/elements/logo/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../static/elements/logo/favicon.ico" type="image/x-icon">
    <link rel="icon" sizes="192x192" href="../static/elements/logo/logo_android192.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../static/elements/logo/logo_ios152.png">

    <?php $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
<meta property="og:image" content="//lca.pondja.com/static/elements/logo/logo.jpg" />
    <meta property="og:image:width" content="194" />
    <meta property="og:image:height" content="194" />
    <meta property="og:title" content="Grader.GA - LCA Edition" />
    <title>Grader.ga - LCA Edition</title>
    <meta property="og:description" content="The Computer Engineering of Khon Kaen University Student-Made grader." />
    <meta name="twitter:card" content="summary"></meta>
    <link rel="image_src" href="//lca.pondja.com/static/elements/logo/logo.jpg" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo $current_url; ?>" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="//cdn.p0nd.dev/mdbootstrap-4.19.1/css/mdb.min.css" rel="stylesheet">
    
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
    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.p0nd.dev/mdbootstrap-4.19.1/js/mdb.min.js"></script>

    <!-- Bootstrap-Table -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.3/af-2.3.7/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/cr-1.5.4/date-1.1.1/fc-4.0.0/fh-3.2.0/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.2/sp-1.4.0/sl-1.3.3/datatables.min.css"/>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.3/af-2.3.7/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/cr-1.5.4/date-1.1.1/fc-4.0.0/fh-3.2.0/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.2/sp-1.4.0/sl-1.3.3/datatables.min.js"></script>
 

    <!-- Editor.MD -->
    <link rel="stylesheet" href="//cdn.p0nd.dev/editor.md/css/editormd.css" />
    <script src="//cdn.p0nd.dev/editor.md/editormd.min.js"></script>
    <script src="//cdn.p0nd.dev/editor.md/languages/en.js"></script>

    <!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js) -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.css">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js"></script>
    
    <!-- SweetAlert -->
    <script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <!-- Croppie -->
    <link rel="stylesheet" href="//cdn.p0nd.dev/croppie/croppie.css" />
    <script src="//cdn.p0nd.dev/croppie/croppie.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" type="text/css">
    
    <!-- Fontawesome -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <script src="//tutsplus.github.io/syntax-highlighter-demos/highlighters/highlightjs/highlight.pack.js"></script>
    <link href="//tutsplus.github.io/syntax-highlighter-demos/highlighters/highlightjs/styles/monokai_sublime.css" rel="stylesheet" type="text/css">

    <script src='//www.hCaptcha.com/1/api.js' async defer></script>
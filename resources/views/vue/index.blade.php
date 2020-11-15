<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta property="og:title" content="Guia facetado de técnicas elicitação de requisitos"/>
    <meta property="og:type" content="article"/>
    <meta property="og:description" content="Obtenha informações sobre técnicas de elicitação de requisitos!" />
    <meta property="og:image" content="http://retraining.inf.ufsc.br/guia/images/logo.png" />
    <meta property="og:url" content="http://retraining.inf.ufsc.br/guia"/>
    <meta property="og:site_name" content="REtraining - Guia facetado de Técnicas de Elicitação de Requisitos" />

    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="http://retraining.inf.ufsc.br/guia">
    <meta name="twitter:title" content="Guia facetado de técnicas elicitação de requisitos">
    <meta name="twitter:description" content="Obtenha informações sobre técnicas de elicitação de requisitos!">
    <meta name="twitter:image" content="http://retraining.inf.ufsc.br/guia/images/logo.png">

    <base href="{{ config('app.base') }}">
    <title>REtraining - Guia facetado de Técnicas de Elicitação de Requisitos</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
</head>
<body>
    <div id="app">
        <loading :active.sync="this.$store.getters.isLoading" :can-cancel="false"></loading>

        <div class="columns">
            <sidebar></sidebar>
            <div class="column is-8 is-8-tablet is-9-desktop is-9-widescreen is-10-fullhd">
                <router-view ></router-view>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/vendor.js') }}"></script>

    <a class="typeform-share button" href="https://form.typeform.com/to/zBC5XxRW" data-mode="popup" style="display:inline-block;text-decoration:none;background-color:#3A7685;color:white;cursor:pointer;font-family:Helvetica,Arial,sans-serif;font-size:20px;line-height:50px;text-align:center;margin:0;height:50px;padding:0px 33px;border-radius:25px;max-width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:bold;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;position:fixed;box-shadow:0px 2px 12px rgba(0, 0, 0, 0.06), 0px 2px 4px rgba(0, 0, 0, 0.08);right:26px;bottom:26px;" target="_blank">Feedback </a>
    <script> (function() { var qs,js,q,s,d=document, gi=d.getElementById, ce=d.createElement, gt=d.getElementsByTagName, id="typef_orm_share", b="https://embed.typeform.com/"; if(!gi.call(d,id)){ js=ce.call(d,"script"); js.id=id; js.src=b+"embed.js"; q=gt.call(d,"script")[0]; q.parentNode.insertBefore(js,q) } })() </script>
</body>
</html>
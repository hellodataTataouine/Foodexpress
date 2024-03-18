@extends('client.layouts.top_menu_client')


<!--this cause the problem of Missing data $client -->
<!-- @include('client.layouts.header_menu') -->


@section('content')
<div class="container">
    <div class="mt-5">
		<br>
	<br>
	<br>
        <h1 class="mb-4">Politique de Cookies</h1>
        
        <p>Nous attachons une grande importance à la confidentialité et à la sécurité de vos données. Cette Politique de Cookies a été élaborée pour vous informer sur l'utilisation des cookies et des technologies similaires sur notre site web. En continuant à utiliser notre site, vous acceptez notre utilisation de ces cookies conformément à cette politique. Si vous ne consentez pas à l'utilisation de cookies, veuillez désactiver les cookies en suivant les instructions fournies ci-dessous.</p>

        <h2>Qu'est-ce qu'un cookie ?</h2>
        <p>Un cookie est un petit fichier texte stocké sur votre appareil lorsque vous visitez un site web. Il contient des informations lues par le site web lors de vos visites ultérieures. Les cookies sont largement utilisés pour améliorer les performances des sites web et personnaliser votre expérience.</p>

        <h2>Comment nous utilisons les cookies</h2>
        <p>Nous utilisons des cookies pour diverses finalités, notamment :</p>
        <ul>
            <li>Améliorer la fonctionnalité de notre site web en analysant son utilisation.</li>
            <li>Personnaliser votre expérience en mémorisant vos préférences.</li>
            <li>Analyser le trafic sur notre site web et améliorer son contenu.</li>
            <li>Vous fournir des publicités ciblées en fonction de vos intérêts.</li>
        </ul>

        <h2>Types de cookies que nous utilisons</h2>
        <p>Nous utilisons les types de cookies suivants :</p>
        <ul>
            <li>Cookies essentiels : Ils sont nécessaires au fonctionnement de base de notre site web, vous permettant de naviguer et d'utiliser ses fonctionnalités.</li>
            <li>Cookies de performance : Ils nous aident à comprendre comment vous interagissez avec notre site web, améliorant ainsi votre expérience utilisateur.</li>
            <li>Cookies de fonctionnalité : Ils permettent au site web de se souvenir de vos préférences antérieures et de personnaliser votre expérience.</li>
        </ul>

        <h2>Comment désactiver les cookies</h2>
        <p>La désactivation des cookies est possible en modifiant les paramètres de votre navigateur. Cependant, veuillez noter que cela peut affecter certaines parties de notre site web. Pour plus d'informations sur la gestion des cookies, consultez les instructions de votre navigateur.</p>

        <h2>Questions et commentaires</h2>
        <p>Si vous avez des questions ou des commentaires concernant notre Politique de Cookies, veuillez nous contacter à l'adresse e-mail suivante : <b>{{ $user->email }}.</p>
    </div>
	<br>
	<br>
</div>
@include('client.layouts.footer_client')

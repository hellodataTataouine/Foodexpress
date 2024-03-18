@include('client.layouts.top_menu_client')

<!--this cause the problem of Missing data $client -->
@include('client.layouts.header_menu')

@section('content')
<div class="container mt-5">
	<br>
	<br>
	<br>
    <h1 class="mb-4">Mentions Légales</h1>
    
    <p>Nous vous remercions de visiter notre site web. Les informations ci-dessous définissent les conditions d'utilisation de notre site web. En accédant à notre site, vous acceptez ces conditions.</p>
    
    <h2>Informations sur l'entreprise</h2>
    <p>Raison sociale : <b>{{ $client->name }} </b><br>
    Adresse du siège social : <b>{{ $client->localisation }} </b><br>
    Numéro de téléphone : <b>{{ $client->phoneNum1 }} </b><br>
    Adresse e-mail : <b>{{ $user->email }}</b><br>
    Numéro d'inscription au registre du commerce : <b>{{ $client->N_Siret }} </b> </p>

    <h2>Directeur de la publication</h2>
    <p>Nom du directeur de la publication : <b> Cipherlink Sarl# </b><br>
    Adresse e-mail du directeur de la publication : <b> commercial@Cipherlink.fr </b></p>

    <h2>Hébergement</h2>
    <p>Nom de l'hébergeur : <b> OVHcloud </b> <br>
    Adresse : <b> 2 Rue Kellermann, 59100 Roubaix, France </b> <br>
    Numéro de téléphone : <b> +33 9 72 10 10 07 </b> </p>

    <h2>Propriété intellectuelle</h2>
    <p>Tous les contenus de ce site web, tels que textes, images, logos, vidéos, etc., sont la propriété exclusive de <b>{{ $client->name }} </b> ou sont utilisés avec autorisation. Toute reproduction, distribution ou utilisation non autorisée de ces contenus est strictement interdite.</p>

    <h2>Protection des données personnelles</h2>
<p>Collecte des données : Nous collectons des données personnelles lorsque vous interagissez avec notre site web, notamment via des formulaires de contact, d'inscription ou de souscription à nos services. Les données personnelles que nous pouvons recueillir comprennent, entre autres, votre nom, votre adresse e-mail, votre numéro de téléphone, etc.</p>
<p>Finalités du traitement : Nous traitons vos données personnelles dans le but de répondre à vos demandes et questions, de vous envoyer des newsletters ou des informations promotionnelles si vous avez consenti à les recevoir, de gérer votre inscription et votre compte, d'améliorer nos services et de personnaliser votre expérience utilisateur, ainsi que de respecter nos obligations légales et réglementaires.</p>
<p>Droits des utilisateurs : Conformément aux lois sur la protection des données, vous disposez de certains droits en ce qui concerne vos données personnelles, tels que le droit d'accéder à vos données, de les rectifier si elles sont inexactes, de demander leur suppression dans certaines circonstances, de vous opposer au traitement dans certaines situations, de limiter le traitement dans certaines conditions, et d'exercer le droit à la portabilité des données. Pour exercer ces droits ou pour toute question concernant notre politique de protection des données personnelles, veuillez nous contacter à <b>{{ $user->email }}</b>. Nous nous engageons à répondre à vos demandes conformément à la loi applicable.</p>


    <h2>Cookies</h2>
<p>Nous utilisons des cookies sur notre site web pour améliorer votre expérience utilisateur. Les cookies sont de petits fichiers texte qui sont stockés sur votre appareil lorsque vous visitez notre site. Ils ont plusieurs finalités, notamment :</p>
<ul>
    <li>Améliorer la fonctionnalité de notre site web en analysant son utilisation.</li>
    <li>Personnaliser votre expérience en mémorisant vos préférences.</li>
    <li>Analyser le trafic sur notre site web et améliorer son contenu.</li>
    <li>Vous fournir des publicités ciblées en fonction de vos intérêts.</li>
</ul>
<p>Vous pouvez désactiver les cookies en modifiant les paramètres de votre navigateur. Cependant, veuillez noter que cela peut affecter certaines parties de notre site web. Pour en savoir plus sur la gestion des cookies, consultez les instructions de votre navigateur.</p>


    
</div>
<br>
<br>
@include('client.layouts.footer_client')

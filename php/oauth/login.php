<?php
/**
 * Author: Blue
 * Version : 0.1
 * Some parts of the code come from the example here : https://github.com/wohali/oauth2-discord-new
 */

require __DIR__ . '/vendor/autoload.php';

session_start();

$clientID = file_get_contents("config/appID.txt");
$clientSecret = file_get_contents("config/appSecret.txt");
$redirectUri = 'https://bluebot.pw/php/oauth/login.php';

$provider = new \Wohali\OAuth2\Client\Provider\Discord([
    'clientId' => $clientID,
    'clientSecret' => $clientSecret,
    'redirectUri' => $redirectUri
]);

if (!isset($_GET['code'])) {
	$options = [
		'state' => 'OPTIONAL_CUSTOM_CONFIGURED_STATE',
		'scope' => ['identify'] // array or string
	];

    // Step 1. Get authorization code
    $authUrl = $provider->getAuthorizationUrl($options);
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state');

} else {
    // Step 2. Get an access token using the provided authorization code
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    // Step 3. (Optional) Look up the user's profile with the provided token
    try {
        $user = $provider->getResourceOwner($token);
        $_SESSION['userID'] = $user->getId();

        //Building array of roles - each donator rank get a different reward : "roleID" => "reward"
        $rolesRewards = array(
            "474238853138350080" => "5", //Donator tier 1
            "474313731694788608" => "10", //Donator tier 2
            "448955168428392458" => "25", //Donator tier 3
            "474314324429766658" => "50" //Donator tier 4
        );


        $_SESSION['username'] = $user->getUsername();
        $_SESSION['discrim'] = $user->getDiscriminator();
        $_SESSION['avatar'] = "https://cdn.discordapp.com/avatars/" . $user->getId() . "/" . $user->getAvatarHash();

        //API call
        $domain = "https://discordapp.com/api";
        $membersEndpoint = $domain . "/guilds/268853008455041025/members/" . $user->getId();

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL            => $membersEndpoint,
            CURLOPT_HTTPHEADER     => array('Authorization: Bot ' . file_get_contents("config/bottoken.txt")), //access the API through the bot token, since the information needed is related to the BlueBot support server
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $output = json_decode(curl_exec($curl));
        curl_close($curl);

        //Getting roles of the user on the BlueBot support server
        $userRoles = $output->roles;

        $addSoundAmount = "402"; //402 HTTP Error code : Payment Required (cause i love memes UwU)
        //Checks donator roles
        foreach ($userRoles as $roleID) {
            if(array_key_exists($roleID, $rolesRewards)) {
                $addSoundAmount = $rolesRewards[$roleID];
            }
        }
        $_SESSION['addSoundAmount'] = $addSoundAmount;

    } catch (Exception $e) {
        // Failed to get user details
        exit('Failed to get user details. Try again later.');
    }

    header('Location: https://bluebot.pw');
    //header('Location: http://localhost/bluebot/');
}
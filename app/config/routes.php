<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2012, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

/**
 * The routes file is where you define your URL structure, which is an important part of the
 * [information architecture](http://en.wikipedia.org/wiki/Information_architecture) of your
 * application. Here, you can use _routes_ to match up URL pattern strings to a set of parameters,
 * usually including a controller and action to dispatch matching requests to. For more information,
 * see the `Router` and `Route` classes.
 *
 * @see lithium\net\http\Router
 * @see lithium\net\http\Route
 */
use lithium\net\http\Router;

// Registration routes for the GUI application...
Router::connect('/registration', 'Registration::create');
Router::connect('/registration/confirm/{:args}', 'Registration::confirm');
Router::connect('/registration/set_password/{:args}', 'Registration::set_password');
Router::connect('/get-started', 'Registration::create');

//MFA Routes
Router::connect('/mfa-login', 'Mfa::mfaLogin');
Router::connect('/mfa-disable', 'Mfa::mfaDisable');

// AWS Subscription route
Router::connect('/aws-subscription/{:args}', 'AwsSubscription::view');

// Email confirmation
Router::connect('/email/confirm/{:args}', 'User::confirmEmail');
// Reset password
Router::connect('/reset-password', 'ResetPassword::create');
Router::connect('/reset-password/confirm/{:args}', 'ResetPassword::confirm');
Router::connect('/reset-password/expired/{:args}', 'ResetPassword::expired');
// Invitation confirmation
Router::connect('/invitation/confirm/{:args}', 'User::confirmInvitation');
// User-Deleted Account
Router::connect('/user-account/{:args}', 'User::userAccount');
// Reactivate account
Router::connect('/reactivate-account/{:args}', 'User::reactivateAccount');

// Login / Logout routes for the GUI application...
Router::connect('/login', 'User::login');

// Captcha
Router::connect('/captcha', 'Captcha::index');

// Check system health
Router::connect('/health_check', array('Home::statusCheck'));
Router::connect('/download', array('Home::download'));

//Non-Authenticated api calls
Router::connect('/api/{:api_version:v\d+_\d+}/internal/{:args}', array('Internal::index', 'type' => 'json'));
Router::connect('/api/{:api_version:v\d+_\d+}/info/{:args}', array('Info::index', 'type' => 'json'));
Router::connect('/api/{:api_version:v\d+_\d+}/provider_info/{:args}', array('Info::providerInfo', 'type' => 'json'));
Router::connect('/api/{:api_version:v\d+_\d+}/aws/subscribe', array('Aws::index', 'type' => 'json'));
Router::connect('/api/{:api_version:v\d+_\d+}/aws/regions', array('Aws::regions', 'type' => 'json'));
Router::connect('/api/{:api_version:v\d+_\d+}/provider-login', array('ProviderLogin::login', 'type' => 'json'));

Router::connect('/bounce_email', array('Home::emailbounce', 'type' => 'json'));

// Unsubscribe
Router::connect('/unsubscribe/{:args}', 'Registration::unsubscribe');

Router::connect('/api/{:api_version:v\d+_\d+}/ping', array('Api::amIAlive', 'type' => 'json'));

//
Router::connect('/terms-and-conditions', 'Home::termsAndConditions');

//Router::connect('/test', 'Test::index');

// Routes for OAuth endpoints...
Router::connect('/oauth/authorize', 'OAuth::authorize');
Router::connect('/oauth/{:token}_token', array('OAuth::token',
    'token' => 'request', 'type' => 'text'
));
Router::connect('/oauth/consumer', array('OAuth::consumer', 'type' => 'json'));
Router::connect('/auth-service/login', array('OAuth::authServiceLogin', 'type' => 'json'));
Router::connect('/oauth/clear-cookies', array('OAuth::clearCookies', 'type' => 'json'));

//Route for access denied page
Router::connect('/access-denied', 'Error::accessdenied');

// API Routes...
Router::connect('/api/stub/{:args}', array('Api::stub', 'type' => 'json'));
Router::connect('/api/{:api_version:v\d+_\d+}/emailbounce', array('Api::emailbounce', 'type' => 'json'));
Router::connect('/api/{:api_version:v\d+_\d+}/logout', array('Api::logout', 'type' => 'json'));
Router::connect('/api/{:api_version:v\d+_\d+}/whoami', array('Api::whoami', 'type' => 'json'));
Router::connect('/api/{:api_version:v\d+_\d+}/whoisthis', array('Api::whoisthis', 'type' => 'json'));
Router::connect('/api/{:api_version:v\d+_\d+}/reportslogin', array('Api::reportslogin', 'type' => 'json'));
Router::connect('/api/{:api_version:v\d+_\d+}/{:args}', array('Api::index', 'type' => 'json'));

// "Static" pages for the GUI app, which are actually HTML generated by HAML files via Python.
Router::connect('/admin', 'Pages::viewSystem');
Router::connect('/admin/{:args}', 'Pages::viewSystem');

Router::connect('/', 'Pages::view');
Router::connect('/{:args}', 'Pages::view');



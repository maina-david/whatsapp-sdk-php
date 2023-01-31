# WhatsApp PHP SDK

[![Latest Stable Version](https://img.shields.io/packagist/v/maina-david/whatsapp-sdk)](https://packagist.org/packages/maina-david/whatsapp-sdk)

![](https://banners.beyondco.de/WhatsApp%20PHP%20SDK.png?theme=light&packageManager=composer+require&packageName=maina-david%2Fwhatsapp-sdk&pattern=bamboo&style=style_1&description=A+PHP+package+for+integrating+the+WhatsApp+business+APIs&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)

> This SDK provides convenient access to the WhatsApp API for applications written in PHP.

## Documentation

Take a look at the [WhatsApp Business Management API docs here](https://developers.facebook.com/docs/whatsapp/cloud-api/guides/).

## Install

You can install the PHP SDK via composer or by downloading the source

#### Via Composer

The recommended way to install the SDK is with [Composer](http://getcomposer.org/).

```bash
composer require maina-david/whatsapp-sdk
```

Optional: The service provider will automatically get registered. Or you may manually add the service provider in your config/app.php file:

```
'providers' => [
    // ...
    MainaDavid\WhatsappSdk\WhatsAppServiceProvider::class,
];
```

You should publish the config/whatsapp.php config file with:

```bash
php artisan vendor:publish --provider="MainaDavid\WhatsappSdk\WhatsAppServiceProvider"
```

Set up in the config/whatsapp.php: Phone Number ID, permanent access token and Graph API version you want to use(Default is V15.0) obtained from the [Developer's Dashboard](https://developers.facebook.com/).

## Usage

You will need to setup a phone number and a permanent access token in [Facebook Developer's Portal](https://developers.facebook.com/).

[Learn how to create a permanent token](https://developers.facebook.com/docs/whatsapp/business-management-api/get-started#1--acquire-an-access-token-using-a-system-user-or-facebook-login)

```php
use MainaDavid\WhatsappSdk\WhatsApp;

$phone = '254700123456'; //phone number in international format
$text = 'Hello World'; // string of message to be sent

$WA = new WhatsApp();

$message = $WA->message();

$response = $message->sendTextMessage([
    'to' => $phone,
    'message' => $text
]);

print_r($response);
```

## Instantiation

Instantiating the class will give you an object with available methods

- `$WA = new WhatsApp();`: Instantiate the class
- Get available service
  - [Message Service](#TextMessage): `$message = $WA->message();`

### TextMessage

- `sendTextMessage($options)`: Sends a text message

  - `message`: Message content. `REQUIRED`
  - `to`: phone number. `REQUIRED`

- `sendReplytoTextMessage($options)`: Reply to a message

  - `message_id`: whatsapp message ID of previous message. `REQUIRED`
  - `message`: Message content. `REQUIRED`
  - `to`: phone number. `REQUIRED`

- `sendMediaMessageByURL($options)`: Send a media message with url

  - `type`: media type. Only 'image', 'document', 'audio', 'sticker', 'video' `REQUIRED`
  - `url`: URL of the media to be sent. `REQUIRED`
  - `to`: phone number. `REQUIRED`
  - `caption`: Describes the specified image or video. Do not use it with audio, sticker, or document media. `OPTIONAL`
  - `filename`: Describes the filename for the specific document. Use only with document media. `OPTIONAL`

- `sendMediaMessageByID($options)`: Send a media message with media ID

  - `type`: media type. Only 'image', 'document', 'audio', 'sticker', 'video' `REQUIRED`
  - `media_id`: Media ID from WhatsApp. `REQUIRED`
  - `to`: phone number. `REQUIRED`
  - `caption`: Describes the specified image or video. Do not use it with audio, sticker, or document media. `OPTIONAL`
  - `filename`: Describes the filename for the specific document. Use only with document media. `OPTIONAL`

- `sendReplytoMediaMessageByURL($options)`: Send a reply to a media message by URL

  - `message_id`: whatsapp message ID of previous message. `REQUIRED`
  - `url`: URL of the media to be sent. `REQUIRED`
  - `to`: phone number. `REQUIRED`

- `sendReplytoMediaMessageByID($options)`: Send a reply to a media message by ID

  - `message_id`: whatsapp message ID of previous message. `REQUIRED`
  - `media_id`: Media ID from WhatsApp. `REQUIRED`
  - `to`: phone number. `REQUIRED`

- `sendLocationMessage($options)`: Send a location message to a recipient

  - `to`: phone number. `REQUIRED`
  - `latitude`: The longitude of the location. `REQUIRED`
  - `longitude`: The latitude of the location. `REQUIRED`
  - `name`: The name of the location. `OPTIONAL`
  - `address`: The address of the location. This field is only displayed if name is present.. `OPTIONAL`

- `sendReplytoLocationMessage($options)`: Send a location message to a recipient

  - `message_id`: whatsapp message ID of previous message. `REQUIRED`
  - `to`: phone number. `REQUIRED`
  - `latitude`: The longitude of the location. `REQUIRED`
  - `longitude`: The latitude of the location. `REQUIRED`
  - `name`: The name of the location. `OPTIONAL`
  - `address`: The address of the location. This field is only displayed if name is present.. `OPTIONAL`

- `markMessageAsRead($options)`: Mark a message as read

  - `message_id`: whatsapp message ID of previous message. `REQUIRED`

## Testing the SDK

The SDK uses [PHPUnit](https://phpunit.de/manual/current/en/index.html) as the test runner.

To run available tests, from the root of the project run:

```bash
# Run tests
phpunit
```

## Issues

If you find a bug, please file an issue on [the issue tracker on GitHub](https://github.com/maina-david/whatsapp-sdk-php/issues).

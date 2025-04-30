<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class FirebaseService
{
    protected $messaging;

    public function __construct()
    {
        $serviceAccount = base_path('storage/firebase.json');
        $factory = (new Factory)->withServiceAccount($serviceAccount);
        $this->messaging = $factory->createMessaging();
    }

   public function sendNotification($token, array $data = [])
    {
        if (!is_array($data)) {
            throw new \InvalidArgumentException('Data must be an associative array.');
        }
    
        try {
            // Create message with token, data payload, and high priority
            $message = CloudMessage::withTarget('token', $token)
                ->withData($data)
                ->withAndroidConfig([
                    'priority' => 'high',   // High priority for Android
                ])
                ->withApnsConfig([
                    'headers' => [
                        'apns-priority' => '10'  // High priority for iOS
                    ]
                ]);
    
            // Send the message
            return $this->messaging->send($message);
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

}


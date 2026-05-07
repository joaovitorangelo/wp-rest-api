<?php

namespace TokDigital\WpRestApi\Integrations\Firebase;

defined('ABSPATH') || exit;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Contract\Storage;
use Google\Cloud\Firestore\FirestoreClient;

class FirebaseClient
{
    private Factory $factory;

    public function __construct()
    {
        $this->factory = (new Factory)
            ->withServiceAccount(FIREBASE_CREDENTIALS);
    }

    public function auth(): Auth
    {
        return $this->factory->createAuth();
    }

    public function storage(): Storage
    {
        return $this->factory->createStorage();
    }

    public function firestore(): FirestoreClient
    {
        return $this->factory
            ->createFirestore()
            ->database();
    }
}
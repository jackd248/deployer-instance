<?php

namespace SourceBroker\DeployerInstance;

use Symfony\Component\Dotenv\Dotenv;

class Instance
{
    public function getLocalInstance()
    {
        if (getenv('INSTANCE') === false) {
            $configFile = getcwd() . '/.env';
            if (file_exists($configFile)) {
                $dotEnv = new Dotenv();
                if (method_exists($dotEnv, 'loadEnv')) {
                    $dotEnv->loadEnv($configFile);
                } else {
                    $dotEnv->load($configFile);
                }
            } else {
                throw new \Exception('Missing file "' . $configFile . '"', 1500717945887);
            }
            if (getenv('INSTANCE') === false) {
                throw new \Exception(
                    'INSTANCE var is no set. The name of INSTANCE should corresponds to host() name.',
                    1500717953824
                );
            }
        }
        return getenv('INSTANCE');
    }
}
